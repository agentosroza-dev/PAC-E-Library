<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    private $disk;
    private $backupName;

    public function __construct()
    {
        $this->disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $this->backupName = config('backup.backup.name');
    }

    /**
     * Display the backup management page
     */
    public function index()
    {
        try {
            $files = $this->disk->files($this->backupName);

            $backups = collect($files)->map(function ($file) {
                return [
                    'name' => basename($file),
                    'size' => $this->disk->size($file),
                    'date' => $this->disk->lastModified($file),
                    'size_human' => $this->formatBytes($this->disk->size($file)),
                    'date_human' => date('Y-m-d H:i:s', $this->disk->lastModified($file)),
                ];
            })->sortByDesc('date')->values();

            // Calculate statistics
            $totalSize = '0 B';
            $latestBackup = null;
            $oldestBackup = null;

            if ($backups->count() > 0) {
                $totalSize = $this->formatBytes($backups->sum('size'));
                $latestBackup = $backups->first();
                $oldestBackup = $backups->last();
            }

            return view('backup.index', compact('backups', 'totalSize', 'latestBackup', 'oldestBackup'));

        } catch (\Exception $e) {
            return view('backup.index', [
                'backups' => collect([]),
                'totalSize' => '0 B',
                'latestBackup' => null,
                'oldestBackup' => null,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function createBackup(Request $request)
    {
        $request->validate([
            'flag' => 'required|string|in:full,db,files',
        ]);

        try {
            $flag = $request->input('flag');

            if ($flag === 'db') {
                Artisan::call('backup:run', ['--only-db' => true]);
            } elseif ($flag === 'files') {
                Artisan::call('backup:run', ['--only-files' => true]);
            } else {
                Artisan::call('backup:run');
            }

            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'ដំណើរការបម្រុងទុកបានចាប់ផ្តើមដោយជោគជ័យ'
                ], 202);
            }

            return redirect()->route('backup.index')
                ->with('success', 'ដំណើរការបម្រុងទុកបានចាប់ផ្តើមដោយជោគជ័យ');

        } catch (\Exception $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('backup.index')
                ->with('error', 'បរាជ័យក្នុងការបង្កើតការបម្រុងទុក: ' . $e->getMessage());
        }
    }


    public function downloadBackup($filename)
    {
        try {
            $path = $this->backupName . '/' . $filename;

            if (!$this->disk->exists($path)) {
                return redirect()->route('backup.index')
                    ->with('error', 'រកមិនឃើញឯកសារបម្រុងទុក');
            }

            return $this->disk->download($path);

        } catch (\Exception $e) {
            return redirect()->route('backup.index')
                ->with('error', 'បរាជ័យក្នុងការទាញយក: ' . $e->getMessage());
        }
    }

    public function deleteBackup($filename)
    {
        try {
            $path = $this->backupName . '/' . $filename;

            // if (!$this->disk->exists($path)) {
            //     if (request()->wantsJson()) {
            //         return response()->json(['error' => 'រកមិនឃើញឯកសារបម្រុងទុក'], 404);
            //     }
            //     return redirect()->route('backup.index')
            //         ->with('error', 'រកមិនឃើញឯកសារបម្រុងទុក');
            // }

            $this->disk->delete($path);

            if (request()->wantsJson()) {
                return response()->json(['message' => 'បានលុបឯកសារបម្រុងទុកដោយជោគជ័យ'], 200);
            }

            return redirect()->route('backup.index')
                ->with('success', 'បានលុបឯកសារបម្រុងទុកដោយជោគជ័យ');

        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return redirect()->route('backup.index')
                ->with('error', 'បរាជ័យក្នុងការលុប: ' . $e->getMessage());
        }
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
