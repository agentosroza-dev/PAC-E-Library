{{-- ================================================================================
    ទំព័របង្កើតអ្នកប្រើប្រាស់ថ្មី
    ================================================================================ --}}

@extends('layouts.myapp')

@section('title', 'បង្កើតអ្នកប្រើប្រាស់ថ្មី')

@section('page-icon', 'person-plus')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('users.index') }}" class="text-decoration-none">
            <i class="bi bi-people-fill me-1"></i>អ្នកប្រើប្រាស់
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-plus-circle me-1"></i>បង្កើតថ្មី
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
                        <i class="bi bi-person-plus-fill text-primary me-2"></i>
                        បង្កើតអ្នកប្រើប្រាស់ថ្មី
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Profile Photo Upload --}}
                        <div class="row mb-4">
                            <div class="col-md-4 text-center">
                                <div class="avatar-upload">
                                    <div class="avatar-preview mb-3">
                                        <div class="bg-soft-primary rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                            style="width: 150px; height: 150px; cursor: pointer; border: 3px dashed #667eea;"
                                            onclick="document.getElementById('photoInput').click();">
                                            <i class="bi bi-camera-fill text-primary" style="font-size: 3rem;"></i>
                                        </div>
                                        <small class="text-muted d-block mt-2">ចុចដើម្បីបន្ថែមរូបភាព</small>
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
                                           value="{{ old('name') }}"
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
                                           value="{{ old('email') }}"
                                           placeholder="user@example.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password Field --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">
                                        ពាក្យសម្ងាត់ <span class="text-danger">*</span>
                                    </label>
                                    <input type="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           id="password"
                                           name="password"
                                           placeholder="យ៉ាងតិច 6 តួអក្សរ"
                                           required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">ពាក្យសម្ងាត់ត្រូវមានយ៉ាងតិច 6 តួអក្សរ</small>
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
                                    <option value="user" {{ old('level') == 'user' ? 'selected' : '' }}>អ្នកប្រើធម្មតា (User)</option>
                                    <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>អ្នកគ្រប់គ្រង (Admin)</option>
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
                                       value="{{ old('scope') }}"
                                       placeholder="ឧ. user, admin, manager">
                                @error('scope')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">ដែនកំណត់សិទ្ធិប្រើប្រាស់ (ទុកទទេបាន)</small>
                            </div>
                        </div>

                        {{-- Status Switches --}}
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card bg-light border-0 p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <label class="fw-bold mb-1">ស្ថានភាពសកម្ម</label>
                                            <p class="text-muted small mb-0">អនុញ្ញាតឱ្យអ្នកប្រើប្រាស់ចូលប្រើប្រព័ន្ធ</p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="actived"
                                                   name="actived"
                                                   value="1"
                                                   style="width: 50px; height: 25px;"
                                                   {{ old('actived', true) ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card bg-light border-0 p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <label class="fw-bold mb-1">បញ្ជាក់អ៊ីមែល</label>
                                            <p class="text-muted small mb-0">បញ្ជាក់ថាអ៊ីមែលត្រឹមត្រូវ</p>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="email_verified"
                                                   name="email_verified"
                                                   value="1"
                                                   style="width: 50px; height: 25px;"
                                                   {{ old('email_verified', true) ? 'checked' : '' }}>
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
                            <button type="submit" class="btn btn-gradient-success btn-lg px-5 py-3 rounded-pill">
                                <i class="bi bi-save me-2"></i>រក្សាទុក
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
</style>
@endsection
