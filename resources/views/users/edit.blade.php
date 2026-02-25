{{-- ================================================================================
    ទំព័រកែប្រែអ្នកប្រើប្រាស់
    ================================================================================ --}}

@extends('layouts.myapp')

@section('title', 'កែប្រែអ្នកប្រើប្រាស់')

@section('page-icon', 'pencil-square')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}" class="text-decoration-none">
            <i class="bi bi-people-fill me-1"></i>អ្នកប្រើប្រាស់
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-pencil-square me-1"></i>កែប្រែ
    </li>
@endsection

@section('actions')
    <a href="{{ route('users.index') }}" class="btn btn-gradient-info btn-lg px-4 py-2 rounded-pill shadow-sm hover-scale">
        <i class="bi bi-arrow-left-circle me-2"></i>
        <span>ត្រឡប់ក្រោយ</span>
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-pencil-square text-warning me-2"></i>
                        កែប្រែអ្នកប្រើប្រាស់: {{ $user->name }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Profile Photo Upload --}}
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="avatar-upload">
                                    <div class="avatar-preview mb-3">
                                        @if ($user->photo)
                                            <img src="{{ $user->photo }}"
                                                 class="rounded-circle border border-4 border-primary mb-2"
                                                 style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                                                 onclick="document.getElementById('photoInput').click();">
                                            <small class="text-muted d-block">ចុចដើម្បីផ្លាស់ប្តូររូបភាព</small>
                                        @else
                                            <div class="bg-soft-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                                style="width: 150px; height: 150px; cursor: pointer; border: 3px dashed #667eea;"
                                                onclick="document.getElementById('photoInput').click();">
                                                <i class="bi bi-camera-fill text-primary" style="font-size: 3rem;"></i>
                                            </div>
                                            <small class="text-muted d-block mt-2">ចុចដើម្បីបន្ថែមរូបភាព</small>
                                        @endif
                                    </div>
                                    <input type="file" name="photo" id="photoInput" class="d-none" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-8">
                                {{-- Name Field --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">
                                        ឈ្មោះ <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                                           id="name"
                                           name="name"
                                           value="{{ old('name', $user->name) }}"
                                           placeholder="សូមបញ្ចូលឈ្មោះ"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email Field --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">
                                        អ៊ីមែល <span class="text-danger">*</span>
                                    </label>
                                    <input type="email"
                                           class="form-control form-control-lg @error('email') is-invalid @enderror"
                                           id="email"
                                           name="email"
                                           value="{{ old('email', $user->email) }}"
                                           placeholder="user@example.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password Field --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">
                                        ពាក្យសម្ងាត់ថ្មី
                                    </label>
                                    <input type="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="ទុកទទេប្រសិនបើមិនចង់ផ្លាស់ប្តូរ">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        <i class="bi bi-info-circle me-1"></i>
                                        ទុកឲ្យនៅទទេ ប្រសិនបើមិនចង់ផ្លាស់ប្តូរពាក្យសម្ងាត់
                                    </small>
                                </div>
                            </div>
                        </div>

                        {{-- Account Settings --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="level" class="form-label fw-bold">
                                    កម្រិត <span class="text-danger">*</span>
                                </label>
                                <select class="form-select form-select-lg @error('level') is-invalid @enderror"
                                        id="level"
                                        name="level"
                                        required>
                                    <option value="user" {{ old('level', $user->level) == 'user' ? 'selected' : '' }}>អ្នកប្រើធម្មតា (User)</option>
                                    <option value="admin" {{ old('level', $user->level) == 'admin' ? 'selected' : '' }}>អ្នកគ្រប់គ្រង (Admin)</option>
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="scope" class="form-label fw-bold">
                                    ដែនកំណត់ (Scope)
                                </label>
                                <input type="text"
                                       class="form-control form-control-lg @error('scope') is-invalid @enderror"
                                       id="scope"
                                       name="scope"
                                       value="{{ old('scope', $user->scope) }}"
                                       placeholder="ឧ. user, admin, manager">
                                @error('scope')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">ដែនកំណត់សិទ្ធិប្រើប្រាស់</small>
                            </div>
                        </div>

                        {{-- Status Switches --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <label class="fw-bold mb-1">ស្ថានភាពសកម្ម</label>
                                            <p class="text-muted small mb-0">
                                                @if($user->actived)
                                                    <span class="text-success">បច្ចុប្បន្នកំពុងសកម្ម</span>
                                                @else
                                                    <span class="text-danger">បច្ចុប្បន្នអសកម្ម</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="actived"
                                                   name="actived"
                                                   value="1"
                                                   style="width: 50px; height: 25px;"
                                                   {{ old('actived', $user->actived) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card bg-light border-0 p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <label class="fw-bold mb-1">បញ្ជាក់អ៊ីមែល</label>
                                            <p class="text-muted small mb-0">
                                                @if($user->email_verified_at)
                                                    <span class="text-success">
                                                        <i class="bi bi-check-circle me-1"></i>
                                                        បានបញ្ជាក់នៅ {{ $user->email_verified_at->format('d/m/Y') }}
                                                    </span>
                                                @else
                                                    <span class="text-warning">មិនទាន់បានបញ្ជាក់</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="email_verified"
                                                   name="email_verified"
                                                   value="1"
                                                   style="width: 50px; height: 25px;"
                                                   {{ old('email_verified', $user->email_verified_at) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Account Metadata --}}
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="bg-light p-3 rounded-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">បង្កើតនៅ</small>
                                            <strong>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i:s') : 'N/A' }}</strong>
                                        </div>
                                        <div class="col-md-6">
                                            <small class="text-muted d-block">ធ្វើបច្ចុប្បន្នភាពចុងក្រោយ</small>
                                            <strong>{{ $user->updated_at ? $user->updated_at->format('d/m/Y H:i:s') : 'N/A' }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg px-5 py-3 rounded-pill">
                                <i class="bi bi-x-circle me-2"></i>បោះបង់
                            </a>
                            <button type="submit" class="btn btn-gradient-warning btn-lg px-5 py-3 rounded-pill">
                                <i class="bi bi-save me-2"></i>ធ្វើបច្ចុប្បន្នភាព
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Preview Script --}}
    <script>
        document.getElementById('photoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector('.avatar-preview');
                    preview.innerHTML = `
                        <div class="mb-3">
                            <img src="${e.target.result}"
                                 class="rounded-circle border border-4 border-primary"
                                 style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('photoInput').click();">
                            <small class="text-muted d-block mt-2">ចុចដើម្បីផ្លាស់ប្តូររូបភាព</small>
                        </div>
                    `;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

@section('styles')
<style>
    .form-check-input:checked {
        background-color: #28a745;
        border-color: #28a745;
    }
    .form-check-input:focus {
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
    }
    .bg-soft-primary {
        background: rgba(102, 126, 234, 0.1);
    }
</style>
@endsection
