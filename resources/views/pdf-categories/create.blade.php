@extends('layouts.myapp')

@section('title', 'Add Category')

{{-- ================================================================================
    Breadcrumb - បន្ថែមប្រភេទសៀវភៅថ្មី
    ================================================================================ --}}
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-categories.index') }}" class="text-decoration-none">
            <i class="bi bi-folder-fill me-1 text-warning"></i>ប្រភេទសៀវភៅ
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-plus-circle-fill me-1 text-success"></i>បន្ថែមថ្មី
    </li>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pdf-categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="Enter category title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description"
                            class="form-control @error('description') is-invalid @enderror" rows="4"
                            placeholder="Enter category description (optional)">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pdf-categories.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
