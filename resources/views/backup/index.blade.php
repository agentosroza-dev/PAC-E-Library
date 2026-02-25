{{-- ================================================================================
    ទំព័រគ្រប់គ្រងការបម្រុងទុក (Backup Management Page)
    ================================================================================ --}}

@extends('layouts.myapp')

{{-- ================================================================================
    កំណត់ចំណងជើងទំព័រ
    ================================================================================ --}}
@section('title', 'គ្រប់គ្រងការបម្រុងទុក')

{{-- ================================================================================
    Breadcrumb - បង្ហាញទីតាំងបច្ចុប្បន្ន
    ================================================================================ --}}
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('backup.index') }}" class="text-decoration-none">
            <i class="bi bi-shield-lock-fill me-1"></i>ការបម្រុងទុក
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-hdd-stack-fill me-1"></i>គ្រប់គ្រង
    </li>
@endsection

@section('content')
    {{-- ================================================================================
        SECTION 1: STATS CARDS
        ================================================================================ --}}
    <div class="row g-4 mb-4">
        {{-- Card 1: ឯកសារសរុប --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-primary border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-hdd-stack-fill text-primary fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ឯកសារសរុប</span>
                        <h3 class="fw-bold mb-0 display-6" id="totalBackups">{{ $backups->count() ?? 0 }}</h3>
                        <small class="text-success">
                            <i class="bi bi-database me-1"></i>ឯកសារបម្រុងទុក
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: ទំហំសរុប --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-success border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-hdd-fill text-success fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ទំហំសរុប</span>
                        <h3 class="fw-bold mb-0 display-6" id="totalSize">{{ $totalSize ?? '0 B' }}</h3>
                        <small class="text-info">
                            <i class="bi bi-arrow-up-short me-1"></i>ទំហំផ្ទុក
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: ការបម្រុងទុកថ្មីបំផុត --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-warning border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-clock-history text-warning fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ថ្មីបំផុត</span>
                        <h3 class="fw-bold mb-0 fs-4" id="latestBackup">
                            {{ $latestBackup ? \Carbon\Carbon::createFromTimestamp($latestBackup['date'])->diffForHumans() : 'គ្មានទិន្នន័យ' }}
                        </h3>
                        <small class="text-primary">
                            <i class="bi bi-calendar me-1"></i>{{ $latestBackup ? date('Y-m-d H:i', $latestBackup['date']) : '' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: ការបម្រុងទុកចាស់បំផុត --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-info border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-calendar-check text-info fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ចាស់បំផុត</span>
                        <h3 class="fw-bold mb-0 fs-4" id="oldestBackup">
                            {{ $oldestBackup ? \Carbon\Carbon::createFromTimestamp($oldestBackup['date'])->diffForHumans() : 'គ្មានទិន្នន័យ' }}
                        </h3>
                        <small class="text-secondary">
                            <i class="bi bi-calendar me-1"></i>{{ $oldestBackup ? date('Y-m-d H:i', $oldestBackup['date']) : '' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================================
        SECTION 2: HERO SECTION - ប៊ូតុងបង្កើតការបម្រុងទុក
        ================================================================================ --}}
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-gradient-primary p-4 rounded-4 shadow-lg">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="">
                            <h2 class="fw-bold text-white mb-2">
                                <i class="bi bi-database-up me-2"></i>បង្កើតការបម្រុងទុក
                            </h2>
                            <p class="text-white opacity-75 mb-0">បង្កើតការបម្រុងទុកថ្មីសម្រាប់ប្រព័ន្ធ</p>
                        </div>

                        {{-- ប៊ូតុងបង្កើតការបម្រុងទុក --}}
                        <div class="d-flex gap-3">
                            <button type="button"
                                class="btn btn-gradient-info btn-lg px-4 py-3 rounded-pill shadow-lg hover-scale create-backup-btn"
                                data-flag="full"
                                title="បម្រុងទុកពេញ (ទិន្នន័យ និងឯកសារ)">
                                <i class="bi bi-database-fill me-2"></i>
                                <span class="d-none d-sm-inline">បម្រុងទុកពេញ</span>
                                <span class="d-sm-none">ពេញ</span>
                            </button>
                            <button type="button"
                                class="btn btn-gradient-success btn-lg px-4 py-3 rounded-pill shadow-lg hover-scale create-backup-btn"
                                data-flag="db"
                                title="បម្រុងទុកតែទិន្នន័យ">
                                <i class="bi bi-database me-2"></i>
                                <span class="d-none d-sm-inline">តែទិន្នន័យ</span>
                                <span class="d-sm-none">DB</span>
                            </button>
                            <button type="button"
                                class="btn btn-gradient-warning btn-lg px-4 py-3 rounded-pill shadow-lg hover-scale create-backup-btn"
                                data-flag="files"
                                title="បម្រុងទុកតែឯកសារ">
                                <i class="bi bi-folder-fill me-2"></i>
                                <span class="d-none d-sm-inline">តែឯកសារ</span>
                                <span class="d-sm-none">Files</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================================
        SECTION 3: ALERT MESSAGES
        ================================================================================ --}}
    @if (session('success'))
        <div class="alert-modern alert-success-modern alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon-wrapper bg-success bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                </div>
                <div class="flex-grow-1">
                    <strong class="d-block text-success">ជោគជ័យ!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-modern alert-error-modern alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon-wrapper bg-danger bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                </div>
                <div class="flex-grow-1">
                    <strong class="d-block text-danger">កំហុស!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- ================================================================================
        SECTION 4: BACKUP LIST
        ================================================================================ --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="table-icon bg-primary bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-hdd-stack text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">បញ្ជីឯកសារបម្រុងទុក</h5>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="bi bi-database me-1"></i>
                    {{ $backups->count() ?? 0 }} ឯកសារ
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="50">#</th>
                            <th class="py-3">
                                <i class="bi bi-file-earmark-text me-2"></i>ឈ្មោះឯកសារ
                            </th>
                            <th class="py-3">
                                <i class="bi bi-hdd me-2"></i>ទំហំ
                            </th>
                            <th class="py-3">
                                <i class="bi bi-calendar me-2"></i>កាលបរិច្ឆេទ
                            </th>
                            <th class="py-3 text-center" width="200">
                                <i class="bi bi-gear me-2"></i>សកម្មភាព
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($backups as $index => $backup)
                            <tr class="border-bottom">
                                <td class="px-4 py-3 fw-medium">{{ $index + 1 }}</td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="file-icon-wrapper bg-soft-primary rounded-3 p-2">
                                            <i class="bi bi-file-earmark-zip text-primary fs-5"></i>
                                        </div>
                                        <div>
                                            <span class="fw-medium d-block">{{ $backup['name'] }}</span>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ \Carbon\Carbon::createFromTimestamp($backup['date'])->format('Y-m-d H:i:s') }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    <span class="badge-soft badge-soft-info px-3 py-2 rounded-3">
                                        <i class="bi bi-database me-1"></i>
                                        {{ $backup['size_human'] }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="badge-soft badge-soft-secondary px-3 py-2 rounded-3">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ \Carbon\Carbon::createFromTimestamp($backup['date'])->format('d/m/Y H:i') }}
                                    </span>
                                    <small class="text-muted d-block mt-1">
                                        {{ \Carbon\Carbon::createFromTimestamp($backup['date'])->diffForHumans() }}
                                    </small>
                                </td>
                                <td class="py-3 text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        {{-- Download button --}}
                                        <a href="{{ route('backup.download', $backup['name']) }}"
                                           class="btn btn-sm btn-icon btn-success"
                                           title="ទាញយក"
                                           data-bs-toggle="tooltip">
                                            <i class="bi bi-download"></i>
                                        </a>

                                        {{-- Delete button with form --}}
                                        <form action="{{ route('backup.delete', $backup['name']) }}"
                                              method="POST"
                                              class="d-inline delete-form"
                                              id="delete-form-{{ $index }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="btn btn-sm btn-icon btn-danger btn-delete-backup"
                                                    title="លុប"
                                                    data-bs-toggle="tooltip"
                                                    data-form-id="delete-form-{{ $index }}"
                                                    data-name="{{ $backup['name'] }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon mb-4">
                                            <i class="bi bi-database-slash text-muted" style="font-size: 5rem;"></i>
                                        </div>
                                        <h4 class="text-muted mb-3">មិនមានឯកសារបម្រុងទុកទេ</h4>
                                        <p class="text-muted mb-4">ចាប់ផ្តើមបង្កើតការបម្រុងទុកដំបូង</p>
                                        <button type="button"
                                                class="btn btn-gradient-primary px-4 py-2 rounded-pill create-backup-btn"
                                                data-flag="full">
                                            <i class="bi bi-plus-circle me-2"></i>បង្កើតការបម្រុងទុក
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- បើមានទិន្នន័យ បង្ហាញចំនួនសរុប --}}
        @if($backups->count() > 0)
            <div class="card-footer bg-white border-0 py-3 px-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        <i class="bi bi-info-circle me-2"></i>
                        សរុប {{ $backups->count() }} ឯកសារ ទំហំ {{ $totalSize ?? '0 B' }}
                    </div>
                    <div>
                        <small class="text-muted">
                            <i class="bi bi-clock-history me-1"></i>
                            ធ្វើបច្ចុប្បន្នភាពចុងក្រោយ: {{ now()->format('H:i:s') }}
                        </small>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

{{-- ================================================================================
    CUSTOM STYLES
    ================================================================================ --}}
<style>
    /* Gradient Backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .bg-gradient-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    .bg-gradient-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    }

    /* Badge Soft */
    .badge-soft-primary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }
    .badge-soft-info {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }
    .badge-soft-secondary {
        background: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    .badge-soft-success {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    .badge-soft-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    /* Background Soft */
    .bg-soft-primary {
        background: rgba(102, 126, 234, 0.1);
    }

    /* Hover Scale */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }

    /* File Icon Wrapper */
    .file-icon-wrapper {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .file-icon-wrapper:hover {
        transform: scale(1.1);
        background: rgba(102, 126, 234, 0.2) !important;
    }

    /* Stat Cards */
    .stat-card-modern {
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
    }
    .stat-card-modern::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1));
        border-radius: 50%;
        transform: translate(30px, -30px);
    }
    .stat-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }
    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Tracking Wider */
    .tracking-wider {
        letter-spacing: 0.05em;
    }

    /* Alert Modern */
    .alert-modern {
        padding: 1rem 1.5rem;
        border: none;
        border-radius: 1rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .alert-success-modern {
        background: linear-gradient(45deg, #d4edda, #c3e6cb);
        color: #155724;
    }
    .alert-error-modern {
        background: linear-gradient(45deg, #f8d7da, #f5c6cb);
        color: #721c24;
    }

    /* Empty State */
    .empty-state {
        padding: 3rem;
        text-align: center;
    }
    .empty-state-icon {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Button Icon */
    .btn-icon {
        width: 35px;
        height: 35px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .btn-icon i {
        font-size: 1rem;
    }
</style>

{{-- ================================================================================
    SCRIPTS - កូដ JavaScript
    ================================================================================ --}}
@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================================================================
            // TOOLTIP INITIALIZATION
            // ============================================================================
            if (typeof bootstrap !== 'undefined') {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // ============================================================================
            // CREATE BACKUP - With Loading Indicator
            // ============================================================================
            const createButtons = document.querySelectorAll('.create-backup-btn');

            createButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const flag = this.dataset.flag;
                    let backupType = '';
                    let backupIcon = '';

                    switch(flag) {
                        case 'full':
                            backupType = 'បម្រុងទុកពេញ';
                            backupIcon = 'database-fill';
                            break;
                        case 'db':
                            backupType = 'បម្រុងទុកតែទិន្នន័យ';
                            backupIcon = 'database';
                            break;
                        case 'files':
                            backupType = 'បម្រុងទុកតែឯកសារ';
                            backupIcon = 'folder-fill';
                            break;
                    }

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'បង្កើតការបម្រុងទុក?',
                        html: `
                            <div class="mb-3">
                                <i class="bi bi-${backupIcon} text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <strong>${backupType}</strong> នឹងត្រូវបានបង្កើត
                            <div class="mt-3 text-muted small">
                                <i class="bi bi-info-circle me-1"></i>
                                សូមរង់ចាំបន្តិច ដំណើរការនេះអាចចំណាយពេលប៉ុន្មាននាទី
                            </div>
                        `,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="bi bi-check-circle me-2"></i>បាទ/ចាស',
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading dialog
                            Swal.fire({
                                title: 'កំពុងដំណើរការ...',
                                html: `
                                    <div class="text-center">
                                        <div class="spinner-border text-primary mb-3" role="status" style="width: 3rem; height: 3rem;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mb-0">កំពុងបង្កើត ${backupType}...</p>
                                        <small class="text-muted">សូមរង់ចាំបន្តិច</small>
                                    </div>
                                `,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    // Make the API call
                                    fetch('{{ route("backup.create") }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({ flag: flag })
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            return response.json().then(data => {
                                                throw new Error(data.message || data.error || 'បរាជ័យក្នុងការបង្កើតការបម្រុងទុក');
                                            });
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        // Show success message
                                        Swal.fire({
                                            title: 'ជោគជ័យ!',
                                            html: `
                                                <div class="mb-3">
                                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                                                </div>
                                                <strong>${backupType}</strong> ត្រូវបានបង្កើតដោយជោគជ័យ
                                                <div class="mt-3">
                                                    <small class="text-muted">ទំព័រនឹងផ្ទុកឡើងវិញដោយស្វ័យប្រវត្តិ</small>
                                                </div>
                                            `,
                                            icon: 'success',
                                            timer: 2000,
                                            showConfirmButton: false
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    })
                                    .catch(error => {
                                        // Show error message
                                        Swal.fire({
                                            title: 'បរាជ័យ!',
                                            html: `
                                                <div class="mb-3">
                                                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                                                </div>
                                                <strong class="text-danger">${error.message}</strong>
                                            `,
                                            icon: 'error',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: '<i class="bi bi-check-circle me-2"></i>យល់ព្រម'
                                        });
                                    });
                                }
                            });
                        }
                    });
                });
            });

            // ============================================================================
            // DELETE BACKUP CONFIRMATION
            // ============================================================================
            const deleteButtons = document.querySelectorAll('.btn-delete-backup');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const formId = this.dataset.formId;
                    const form = document.getElementById(formId);
                    const name = this.dataset.name;

                    if (!form) {
                        console.error('Form not found:', formId);
                        return;
                    }

                    // Show confirmation dialog
                    Swal.fire({
                        title: 'តើអ្នកពិតជាចង់លុប?',
                        html: `
                            <div class="mb-3">
                                <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <strong>${name}</strong> នឹងត្រូវបានលុបចោលជារៀងរហូត!
                            <div class="alert alert-warning mt-3 small">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                សកម្មភាពនេះមិនអាចត្រឡប់វិញបានទេ
                            </div>
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: '<i class="bi bi-trash me-2"></i>បាទ/ចាស លុប',
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading dialog
                            Swal.fire({
                                title: 'កំពុងដំណើរការ...',
                                html: `
                                    <div class="text-center">
                                        <div class="spinner-border text-danger mb-3" role="status" style="width: 3rem; height: 3rem;">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <p class="mb-0">កំពុងលុប ${name}...</p>
                                        <small class="text-muted">សូមរង់ចាំបន្តិច</small>
                                    </div>
                                `,
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false
                            });

                            // Submit the form after a short delay to show loading
                            setTimeout(() => {
                                form.submit();
                            }, 500);
                        }
                    });
                });
            });

            // ============================================================================
            // AUTO-HIDE ALERTS
            // ============================================================================
            setTimeout(() => {
                document.querySelectorAll('.alert-modern, .alert-custom, .alert').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
@endsection
