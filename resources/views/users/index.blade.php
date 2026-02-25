{{-- ================================================================================
    ទំព័រគ្រប់គ្រងអ្នកប្រើប្រាស់
    ================================================================================ --}}

@extends('layouts.myapp')

@section('title', 'គ្រប់គ្រងអ្នកប្រើប្រាស់')

@section('page-icon', 'people')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}" class="text-decoration-none">
            <i class="bi bi-people-fill me-1"></i>អ្នកប្រើប្រាស់
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-list-ul me-1"></i>បញ្ជីអ្នកប្រើប្រាស់
    </li>
@endsection

@section('actions')
    <a href="{{ route('users.create') }}" class="btn btn-gradient-success btn-lg px-4 py-2 rounded-pill shadow-sm hover-scale">
        <i class="bi bi-plus-circle-fill me-2"></i>
        <span>បន្ថែមអ្នកប្រើប្រាស់ថ្មី</span>
    </a>
@endsection

@section('content')
    {{-- ================================================================================
        STATS CARDS
        ================================================================================ --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-primary border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-people-fill text-primary fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">អ្នកប្រើសរុប</span>
                        <h3 class="fw-bold mb-0 display-6" id="totalBackups">{{ number_format($statistics['total_users']) }}</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up-short"></i> សរុបទាំងអស់
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-success border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-check-circle-fill text-success fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">បានបញ្ជាក់</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['verified_users']) }}</h3>
                        <small class="text-success">
                            <i class="bi bi-envelope-check me-1"></i>Verified
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-warning border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-clock-history text-warning fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">មិនទាន់បញ្ជាក់</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['unverified_users']) }}</h3>
                        <small class="text-warning">
                            <i class="bi bi-envelope me-1"></i>Unverified
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-info border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-calendar-check text-info fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ថ្មីថ្ងៃនេះ</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['new_users_today']) }}</h3>
                        <small class="text-info">
                            <i class="bi bi-arrow-up-short me-1"></i>New
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================================
        FILTER CARD
        ================================================================================ --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="filter-icon bg-primary bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-funnel text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">តម្រង និងស្វែងរក</h5>
                </div>

                <div class="d-flex gap-2">
                    <select id="sort_by_select" class="form-select form-select-sm" style="width: auto;">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>ថ្មីបំផុត</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>ឈ្មោះ</option>
                        <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>អ៊ីមែល</option>
                    </select>
                    <select id="sort_order_select" class="form-select form-select-sm" style="width: auto;">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>ចុះ</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>ឡើង</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="card-body p-4 pt-0">
            <form action="{{ route('users.index') }}" method="GET" class="row g-3" id="filterForm">
                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by', 'created_at') }}">
                <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'desc') }}">

                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search"
                            class="form-control form-control-lg border-0 shadow-none"
                            placeholder="ស្វែងរកតាមឈ្មោះ ឬអ៊ីមែល..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary px-4">ស្វែងរក</button>
                        @if(request()->has('search') && request('search') != '')
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-3">
                    <select name="verified" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="">ការបញ្ជាក់ទាំងអស់</option>
                        <option value="verified" {{ request('verified') == 'verified' ? 'selected' : '' }}>បានបញ្ជាក់</option>
                        <option value="unverified" {{ request('verified') == 'unverified' ? 'selected' : '' }}>មិនទាន់បញ្ជាក់</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <select name="per_page" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>១០ នាក់</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>២០ នាក់</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>៥០ នាក់</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>១០០ នាក់</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    {{-- ================================================================================
        ALERT MESSAGES
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
        USERS TABLE
        ================================================================================ --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="table-icon bg-primary bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-people text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">បញ្ជីអ្នកប្រើប្រាស់</h5>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="bi bi-people me-1"></i>
                    {{ $users->total() }} នាក់
                </span>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="50">#</th>
                            <th class="py-3" width="80">រូបភាព</th>
                            <th class="py-3">ឈ្មោះ</th>
                            <th class="py-3">អ៊ីមែល</th>
                            <th class="py-3">ស្ថានភាពបញ្ជាក់</th>
                            <th class="py-3">កាលបរិច្ឆេទ</th>
                            <th class="py-3 text-center" width="250">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-bottom">
                                <td class="px-4 py-3 fw-medium">{{ $users->firstItem() + $loop->index }}</td>
                                <td class="py-3">
                                    @if ($user->photo)
                                        <img src="{{ $user->photo }}"
                                             class="rounded-3 object-fit-cover border"
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-soft-primary rounded-3 d-flex align-items-center justify-content-center"
                                             style="width: 50px; height: 50px;">
                                            <i class="bi bi-person-circle text-primary fs-4"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <strong>{{ $user->name }}</strong>
                                    @if($user->password_null)
                                        <span class="badge bg-warning text-dark ms-2">គ្មានពាក្យសម្ងាត់</span>
                                    @endif
                                </td>
                                <td class="py-3">{{ $user->email }}</td>
                                <td class="py-3">
                                    @if ($user->email_verified_at)
                                        <span class="badge-soft badge-soft-success px-3 py-2 rounded-3">
                                            <i class="bi bi-check-circle me-1"></i>
                                            បានបញ្ជាក់
                                        </span>
                                        <small class="text-muted d-block mt-1">
                                            {{ $user->email_verified_at->format('d/m/Y') }}
                                        </small>
                                    @else
                                        <span class="badge-soft badge-soft-warning px-3 py-2 rounded-3">
                                            <i class="bi bi-clock me-1"></i>
                                            មិនទាន់បញ្ជាក់
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <span class="badge-soft badge-soft-secondary px-3 py-2 rounded-3">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="btn btn-sm btn-icon btn-info" title="មើលលម្អិត"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-sm btn-icon btn-warning" title="កែប្រែ"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        @if(!$user->email_verified_at)
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-primary verify-email"
                                                title="បញ្ជាក់អ៊ីមែល"
                                                data-bs-toggle="tooltip"
                                                data-user-id="{{ $user->id }}">
                                                <i class="bi bi-check-circle-fill"></i>
                                            </button>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-success resend-verification-email"
                                                title="បញ្ជាក់អ៊ីមែល"
                                                data-bs-toggle="tooltip"
                                                data-user-id="{{ $user->id }}">
                                               <i class="bi bi-envelope-check"></i>
                                            </button>
                                        @endif



                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="d-inline delete-form" id="delete-form-{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-danger btn-delete-user"
                                                title="លុប"
                                                data-bs-toggle="tooltip"
                                                data-form-id="delete-form-{{ $user->id }}"
                                                data-name="{{ $user->name }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon mb-4">
                                            <i class="bi bi-people text-muted" style="font-size: 5rem;"></i>
                                        </div>
                                        <h4 class="text-muted mb-3">មិនមានទិន្នន័យអ្នកប្រើប្រាស់ទេ</h4>
                                        @if (request()->has('search'))
                                            <p class="text-muted mb-4">មិនឃើញអ្នកប្រើប្រាស់ដែលត្រូវនឹងការស្វែងរកទេ</p>
                                            <a href="{{ route('users.index') }}"
                                                class="btn btn-primary px-4 py-2 rounded-pill">
                                                <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                                            </a>
                                        @else
                                            <a href="{{ route('users.create') }}"
                                                class="btn btn-gradient-success px-4 py-2 rounded-pill">
                                                <i class="bi bi-plus-circle me-2"></i>បន្ថែមអ្នកប្រើប្រាស់ដំបូង
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($users->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                    <div class="pagination-info text-muted">
                        <i class="bi bi-layout-text-window me-2"></i>
                        បង្ហាញពី {{ $users->firstItem() }} ដល់ {{ $users->lastItem() }}
                        នៃ {{ $users->total() }} នាក់
                    </div>
                    <div class="pagination-modern">
                        {{ $users->onEachSide(1)->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            // SORTING FUNCTIONALITY
            // ============================================================================
            const sortBySelect = document.getElementById('sort_by_select');
            const sortOrderSelect = document.getElementById('sort_order_select');
            const sortByHidden = document.getElementById('sort_by');
            const sortOrderHidden = document.getElementById('sort_order');
            const filterForm = document.getElementById('filterForm');

            if (sortBySelect && sortOrderSelect && filterForm) {
                sortBySelect.addEventListener('change', function() {
                    sortByHidden.value = this.value;
                    filterForm.submit();
                });

                sortOrderSelect.addEventListener('change', function() {
                    sortOrderHidden.value = this.value;
                    filterForm.submit();
                });
            }

            // ============================================================================
            // DELETE USER CONFIRMATION
            // ============================================================================
            const deleteButtons = document.querySelectorAll('.btn-delete-user');
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
                            form.submit();
                        }
                    });
                });
            });

            // ============================================================================
            // VERIFY EMAIL (Direct verification)
            // ============================================================================
            const verifyButtons = document.querySelectorAll('.verify-email');
            verifyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;

                    Swal.fire({
                        title: 'បញ្ជាក់អ៊ីមែល?',
                        text: 'តើអ្នកចង់បញ្ជាក់អ៊ីមែលរបស់អ្នកប្រើប្រាស់នេះទេ?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="bi bi-check-circle me-2"></i>បាទ/ចាស',
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/users/${userId}/verify-email`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'ជោគជ័យ!',
                                        text: data.message,
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('កំហុស!', data.message || 'មានបញ្ហា', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('កំហុស!', 'បរាជ័យក្នុងការបញ្ជាក់អ៊ីមែល', 'error');
                            });
                        }
                    });
                });
            });

            // ============================================================================
            // RESEND VERIFICATION EMAIL (Send new verification email)
            // ============================================================================
            const resendVerifyButtons = document.querySelectorAll('.resend-verification-email'); // ✅ Fixed variable name
            resendVerifyButtons.forEach(button => { // ✅ Using correct variable
                button.addEventListener('click', function() {
                    const userId = this.dataset.userId;

                    Swal.fire({
                        title: 'ផ្ញើអ៊ីមែលបញ្ជាក់ថ្មី?',
                        text: 'តើអ្នកចង់ផ្ញើអ៊ីមែលបញ្ជាក់ថ្មីទៅកាន់អ្នកប្រើប្រាស់នេះទេ?',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745', // Success green
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="bi bi-envelope-send me-2"></i>ផ្ញើ', // Using bi-envelope-send
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/users/${userId}/resend-verification`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: 'ជោគជ័យ!',
                                        text: data.message,
                                        icon: 'success',
                                        timer: 1500,
                                        showConfirmButton: false
                                    }).then(() => {
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire('កំហុស!', data.message || 'មានបញ្ហាក្នុងការផ្ញើអ៊ីមែល', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                Swal.fire('កំហុស!', 'បរាជ័យក្នុងការផ្ញើអ៊ីមែល', 'error');
                            });
                        }
                    });
                });
            });

            // ============================================================================
            // AUTO-HIDE ALERTS
            // ============================================================================
            setTimeout(() => {
                document.querySelectorAll('.alert-modern').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
@endsection
