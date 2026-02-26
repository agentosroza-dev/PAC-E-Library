@extends('layouts.myapp')

@section('title', 'Edit Category')

{{-- ================================================================================
    Breadcrumb - កែប្រែប្រភេទសៀវភៅ
    ================================================================================ --}}
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-categories.index') }}" class="text-decoration-none">
            <i class="bi bi-folder-fill me-1 text-warning"></i>ប្រភេទសៀវភៅ
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-categories.edit', $category->id) }}" class="text-decoration-none">
            <i class="bi bi-pencil-fill me-1 text-info"></i>{{ $category->title }}
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-gear-fill me-1"></i>កែប្រែ
    </li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">


                <div class="card-body">
                    <!-- Display validation errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Fixed Form -->
                    <form action="{{ route('pdf-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')  <!-- Use PUT for update (or PATCH if you prefer) -->

                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $category->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">Description</label>
                            <textarea name="description"
                                      id="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{ old('description', $category->description) }}</textarea>  <!-- FIXED: using value between tags -->
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pdf-categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Update Category
                            </button>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
