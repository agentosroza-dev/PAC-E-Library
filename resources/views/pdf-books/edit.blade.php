@extends('layouts.myapp')

@section('title', 'Edit PDF Book')


@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-books.index') }}" class="text-decoration-none">
            <i class="bi bi-file-pdf-fill me-1"></i>សៀវភៅ PDF
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-pencil-square me-1"></i>កែប្រែ
    </li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit PDF Book: {{ $pdfBook->title }}</h5>
                    <a href="{{ route('pdf-books.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to List
                    </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('pdf-books.update', $pdfBook) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $pdfBook->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="3">{{ old('description', $pdfBook->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id"
                                    name="category_id"
                                    required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $pdfBook->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="version" class="form-label">Version</label>
                            <input type="text"
                                   class="form-control @error('version') is-invalid @enderror"
                                   id="version"
                                   name="version"
                                   value="{{ old('version', $pdfBook->version) }}"
                                   placeholder="e.g., 1.0.0">
                            @error('version')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Cover Image</label>
                            @if($pdfBook->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pdfBook->image) }}"
                                         alt="{{ $pdfBook->title }}"
                                         style="width: 100px; height: 100px; object-fit: cover;"
                                         class="img-thumbnail">
                                    <small class="text-muted d-block">Current image</small>
                                </div>
                            @endif
                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            <small class="text-muted">Leave empty to keep current image. Max size: 2MB. Allowed: jpeg, png, jpg, gif</small>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">PDF File</label>
                            @if($pdfBook->file)
                                <div class="mb-2">
                                    <span class="badge bg-info">Current file: {{ basename($pdfBook->file) }}</span>
                                </div>
                            @endif
                            <input type="file"
                                   class="form-control @error('file') is-invalid @enderror"
                                   id="file"
                                   name="file"
                                   accept=".pdf">
                            <small class="text-muted">Leave empty to keep current file. Max size: 10MB. Allowed: PDF only</small>
                            @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="status"
                                       name="status"
                                       value="1"
                                       {{ old('status', $pdfBook->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update PDF Book
                        </button>
                        <a href="{{ route('pdf-books.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
