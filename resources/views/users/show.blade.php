{{-- ================================================================================
    ទំព័របង្ហាញព័ត៌មានអ្នកប្រើប្រាស់
    ================================================================================ --}}

@extends('layouts.myapp')

@section('title', 'ព័ត៌មានអ្នកប្រើប្រាស់')

@section('page-icon', 'person-circle')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}" class="text-decoration-none">
            <i class="bi bi-people-fill me-1"></i>អ្នកប្រើប្រាស់
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-info-circle me-1"></i>ព័ត៌មានលម្អិត
    </li>
@endsection

@section('actions')
    <a href="{{ route('users.index') }}" class="btn btn-gradient-info btn-lg px-4 py-2 rounded-pill shadow-sm hover-scale">
        <i class="bi bi-arrow-left-circle me-2"></i>
        <span>ត្រឡប់ក្រោយ</span>
    </a>
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-gradient-warning btn-lg px-4 py-2 rounded-pill shadow-sm hover-scale">
        <i class="bi bi-pencil-square me-2"></i>
        <span>កែប្រែ</span>
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            {{-- Profile Header Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="bg-gradient-primary p-5 text-white position-relative">
                    {{-- Background Pattern --}}
                    <div class="position-absolute top-0 end-0 opacity-10">
                        <i class="bi bi-person-circle" style="font-size: 15rem;"></i>
                    </div>

                    <div class="row align-items-center position-relative">
                        <div class="col-md-3 text-center">
                            @if ($user->photo)
                                <img src="{{ $user->photo }}"
                                     class="rounded-circle border border-4 border-white shadow-lg"
                                     style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center border border-4 border-white shadow-lg"
                                     style="width: 150px; height: 150px;">
                                    <i class="bi bi-person-circle text-primary" style="font-size: 5rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h1 class="display-5 fw-bold mb-2">{{ $user->name }}</h1>
                            <p class="lead mb-3">
                                <i class="bi bi-envelope-fill me-2"></i>{{ $user->email }}
                            </p>
                            <div class="d-flex gap-3 flex-wrap">
                                @if($user->level === 'admin')
                                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill">
                                        <i class="bi bi-shield-lock-fill me-2"></i>អ្នកគ្រប់គ្រង
                                    </span>
                                @else
                                    <span class="badge bg-info px-4 py-2 rounded-pill">
                                        <i class="bi bi-person-badge me-2"></i>អ្នកប្រើធម្មតា
                                    </span>
                                @endif

                                @if($user->email_verified_at)
                                    <span class="badge bg-success px-4 py-2 rounded-pill">
                                        <i class="bi bi-check-circle-fill me-2"></i>បានបញ្ជាក់
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill">
                                        <i class="bi bi-clock-history me-2"></i>មិនទាន់បញ្ជាក់
                                    </span>
                                @endif

                                @if($user->password_null)
                                    <span class="badge bg-danger px-4 py-2 rounded-pill">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>គ្មានពាក្យសម្ងាត់
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Information Cards --}}
            <div class="row g-4">
                {{-- Personal Information --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-person-vcard text-primary me-2"></i>
                                ព័ត៌មានផ្ទាល់ខ្លួន
                            </h5>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3 mb-3">
                                <div class="info-icon bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-hash text-primary fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">ID អ្នកប្រើប្រាស់</small>
                                    <strong class="fs-5">#{{ $user->id }}</strong>
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3 mb-3">
                                <div class="info-icon bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-person text-success fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">ឈ្មោះពេញ</small>
                                    <strong class="fs-5">{{ $user->name }}</strong>
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3 mb-3">
                                <div class="info-icon bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-envelope text-info fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">អ៊ីមែល</small>
                                    <strong class="fs-5">{{ $user->email }}</strong>
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3">
                                <div class="info-icon bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-shield text-warning fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">កម្រិត</small>
                                    <strong class="fs-5">
                                        @if($user->level === 'admin')
                                            <span class="text-warning">អ្នកគ្រប់គ្រង</span>
                                        @else
                                            <span class="text-info">អ្នកប្រើធម្មតា</span>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Account Information --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-gear text-warning me-2"></i>
                                ព័ត៌មានគណនី
                            </h5>
                        </div>
                        <div class="card-body p-4 pt-0">
                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3 mb-3">
                                <div class="info-icon bg-success bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">ស្ថានភាពបញ្ជាក់</small>
                                    @if($user->email_verified_at)
                                        <div>
                                            <strong class="text-success">បានបញ្ជាក់</strong>
                                            <small class="text-muted d-block">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                    @else
                                        <strong class="text-warning">មិនទាន់បញ្ជាក់</strong>
                                        <div class="mt-2">
                                            <button type="button"
                                                    class="btn btn-sm btn-primary verify-email"
                                                    data-user-id="{{ $user->id }}">
                                                <i class="bi bi-envelope-check me-1"></i>
                                                បញ្ជាក់អ៊ីមែល
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3 mb-3">
                                <div class="info-icon bg-info bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-calendar text-info fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">បង្កើតនៅ</small>
                                    <strong>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : 'N/A' }}</strong>
                                    <small class="text-muted d-block">
                                        {{ $user->created_at ? $user->created_at->diffForHumans() : '' }}
                                    </small>
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3 mb-3">
                                <div class="info-icon bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-arrow-repeat text-warning fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">ធ្វើបច្ចុប្បន្នភាពនៅ</small>
                                    <strong>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</strong>
                                    <small class="text-muted d-block">
                                        {{ $user->updated_at ? $user->updated_at->diffForHumans() : '' }}
                                    </small>
                                </div>
                            </div>

                            <div class="info-item d-flex align-items-center p-3 bg-light rounded-3">
                                <div class="info-icon bg-secondary bg-opacity-10 rounded-3 p-3 me-3">
                                    <i class="bi bi-key text-secondary fs-4"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">ពាក្យសម្ងាត់</small>
                                    @if($user->password_null)
                                        <strong class="text-danger">គ្មានពាក្យសម្ងាត់</strong>
                                    @else
                                        <strong class="text-success">
                                            <i class="bi bi-check-circle-fill me-1"></i>
                                            មានពាក្យសម្ងាត់
                                        </strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Activity Summary --}}
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-0 p-4">
                            <h5 class="fw-bold mb-0">
                                <i class="bi bi-activity text-success me-2"></i>
                                សកម្មភាពសង្ខេប
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <div class="stat-card-small bg-light p-4 rounded-4 text-center">
                                        <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                                            <i class="bi bi-chat-dots text-primary fs-2"></i>
                                        </div>
                                        <h4 class="fw-bold mb-1">0</h4>
                                        <small class="text-muted">សារ</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card-small bg-light p-4 rounded-4 text-center">
                                        <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                                            <i class="bi bi-people text-success fs-2"></i>
                                        </div>
                                        <h4 class="fw-bold mb-1">0</h4>
                                        <small class="text-muted">ក្រុម</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card-small bg-light p-4 rounded-4 text-center">
                                        <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                                            <i class="bi bi-file-text text-warning fs-2"></i>
                                        </div>
                                        <h4 class="fw-bold mb-1">0</h4>
                                        <small class="text-muted">ឯកសារ</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="stat-card-small bg-light p-4 rounded-4 text-center">
                                        <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-3 p-3 d-inline-block mb-3">
                                            <i class="bi bi-calendar-check text-info fs-2"></i>
                                        </div>
                                        <h4 class="fw-bold mb-1">{{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}</h4>
                                        <small class="text-muted">សមាជិកតាំងពី</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================================================================
            // VERIFY EMAIL
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
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់',
                        showLoaderOnConfirm: true,
                        preConfirm: () => {
                            return fetch(`/users/${userId}/verify-email`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.json().then(data => {
                                        throw new Error(data.message || 'បរាជ័យក្នុងការបញ្ជាក់អ៊ីមែល');
                                    });
                                }
                                return response.json();
                            })
                            .catch(error => {
                                Swal.showValidationMessage(error.message);
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'ជោគជ័យ!',
                                text: result.value.message || 'អ៊ីមែលត្រូវបានបញ្ជាក់ដោយជោគជ័យ',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection

@section('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        position: relative;
        overflow: hidden;
    }

    .stat-card-small {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card-small:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }

    .stat-icon-wrapper {
        transition: transform 0.3s ease;
    }

    .stat-card-small:hover .stat-icon-wrapper {
        transform: scale(1.1);
    }

    .info-item {
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateX(5px);
        background: #e9ecef !important;
    }

    .info-icon {
        transition: all 0.3s ease;
    }

    .info-item:hover .info-icon {
        transform: scale(1.1);
    }

    .opacity-10 {
        opacity: 0.1;
    }
</style>
@endsection
