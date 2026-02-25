<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        try {
            $currentUser = Auth::user();

            // Get filter parameters
            $search = $request->get('search');
            $verified = $request->get('verified'); // Changed from 'status' to 'verified'
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');
            $perPage = $request->get('per_page', 15);

            // Build query - exclude current user
            $query = User::where('id', '!=', $currentUser->id);

            // Apply search
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            }

            // Apply verified filter
            if ($verified === 'verified') {
                $query->whereNotNull('email_verified_at');
            } elseif ($verified === 'unverified') {
                $query->whereNull('email_verified_at');
            }

            // Apply sorting
            $query->orderBy($sortBy, $sortOrder);

            // Get paginated results
            $users = $query->paginate($perPage);

            // Calculate statistics
            $statistics = [
                'total_users' => User::count(),
                'new_users_today' => User::whereDate('created_at', today())->count(),
                'verified_users' => User::whereNotNull('email_verified_at')->count(),
                'unverified_users' => User::whereNull('email_verified_at')->count(),
            ];

            return view('users.index', compact('users', 'statistics'));

        } catch (Exception $e) {
            return redirect()->back()->with('error', 'មានបញ្ហាក្នុងការទាញយកទិន្នន័យអ្នកប្រើប្រាស់: ' . $e->getMessage());
        }
    }

    /**
     * Show form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $userData = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(), // Auto verify on creation
            ];

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('profile', 'public');
                $userData['photo'] = $photoPath;
            }

            User::create($userData);

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'អ្នកប្រើប្រាស់ត្រូវបានបង្កើតដោយជោគជ័យ');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'បរាជ័យក្នុងការបង្កើតអ្នកប្រើប្រាស់: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified user.
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('users.show', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'រកមិនឃើញអ្នកប្រើប្រាស់');
        }
    }

    /**
     * Show form for editing the specified user.
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $currentUser = Auth::user();

            // Prevent editing self
            if ($user->id === $currentUser->id) {
                return redirect()->route('users.index')
                    ->with('error', 'អ្នកមិនអាចកែប្រែគណនីផ្ទាល់ខ្លួនបានទេ');
            }

            return view('users.edit', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'រកមិនឃើញអ្នកប្រើប្រាស់');
        }
    }

    /**
     * Update the specified user.
     */
  /**
 * Update the specified user.
 */
public function update(Request $request, $id)
{
    try {
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        // Prevent editing self
        if ($user->id === $currentUser->id) {
            return redirect()->route('users.index')
                ->with('error', 'អ្នកមិនអាចកែប្រែគណនីផ្ទាល់ខ្លួនបានទេ');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Verify email if checkbox is checked and email is not already verified
        if ($request->has('verify_email') && !$user->email_verified_at) {
            $userData['email_verified_at'] = now();
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $photoPath = $request->file('photo')->store('profile', 'public');
            $userData['photo'] = $photoPath;
        }

        $user->update($userData);

        DB::commit();

        return redirect()->route('users.index')
            ->with('success', 'អ្នកប្រើប្រាស់ត្រូវបានកែប្រែដោយជោគជ័យ');

    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()
            ->withInput()
            ->with('error', 'បរាជ័យក្នុងការកែប្រែអ្នកប្រើប្រាស់: ' . $e->getMessage());
    }
}
    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $currentUser = Auth::user();

            // Prevent deleting self
            if ($user->id === $currentUser->id) {
                return redirect()->route('users.index')
                    ->with('error', 'អ្នកមិនអាចលុបគណនីផ្ទាល់ខ្លួនបានទេ');
            }

            DB::beginTransaction();

            // Delete user photo
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            // Delete user
            $user->delete();

            DB::commit();

            return redirect()->route('users.index')
                ->with('success', 'អ្នកប្រើប្រាស់ត្រូវបានលុបដោយជោគជ័យ');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')
                ->with('error', 'បរាជ័យក្នុងការលុបអ្នកប្រើប្រាស់');
        }
    }

    /**
     * Verify user email manually
     */
    public function verifyEmail($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->email_verified_at) {
                return response()->json([
                    'message' => 'អ៊ីមែលនេះត្រូវបានបញ្ជាក់រួចហើយ'
                ], 400);
            }

            $user->email_verified_at = now();
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'អ៊ីមែលត្រូវបានបញ្ជាក់ដោយជោគជ័យ'
            ], 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'បរាជ័យក្នុងការបញ្ជាក់អ៊ីមែល'], 500);
        }
    }

    /**
     * Resend verification email
     */




    public function resendVerification($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->email_verified_at) {
                return response()->json([
                    'message' => 'អ៊ីមែលនេះត្រូវបានបញ្ជាក់រួចហើយ'
                ], 400);
            }

            $user->sendEmailVerificationNotification();

            return response()->json([
                'success' => true,
                'message' => 'បានផ្ញើអ៊ីមែលបញ្ជាក់ឡើងវិញដោយជោគជ័យ'
            ], 200);

        } catch (Exception $e) {
            return response()->json(['error' => 'បរាជ័យក្នុងការផ្ញើអ៊ីមែល'], 500);
        }
    }
}
