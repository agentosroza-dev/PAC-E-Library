@extends('layouts.myapp')

@section('title', 'ព័ត៌មានសៀវភៅ PDF')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-books.index') }}" class="text-decoration-none">
            <i class="bi bi-file-pdf-fill me-1"></i>សៀវភៅ PDF
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-info-circle me-1"></i>ព័ត៌មានលម្អិត
    </li>
@endsection

@section('actions')
    <div class="d-flex gap-2">
        <a href="{{ route('pdf-books.edit', $pdfBook) }}" class="btn btn-warning btn-lg px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-pencil me-2"></i>
            <span>កែប្រែ</span>
        </a>
        <a href="{{ route('pdf-books.index') }}" class="btn btn-secondary btn-lg px-4 py-2 rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-2"></i>
            <span>ត្រឡប់ក្រោយ</span>
        </a>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            {{-- Book Cover Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body text-center p-4">
                    @if($pdfBook->image)
                        <img src="{{ asset('storage/' . $pdfBook->image) }}"
                             alt="{{ $pdfBook->title }}"
                             class="img-fluid rounded-3 mb-3"
                             style="max-height: 300px; object-fit: contain;">
                    @else
                        <div class="bg-soft-primary d-flex align-items-center justify-content-center rounded-3 mb-3"
                             style="height: 300px;">
                            <i class="bi bi-file-pdf text-primary" style="font-size: 5rem;"></i>
                        </div>
                    @endif

                    <h4 class="fw-bold">{{ $pdfBook->title }}</h4>
                    @if($pdfBook->category)
                        <span class="badge bg-info px-3 py-2 mb-3">
                            <i class="bi bi-tag me-1"></i>{{ $pdfBook->category->title }}
                        </span>
                    @endif

                    <div class="d-flex justify-content-center gap-3 mb-3">
                        <div class="text-center">
                            <div class="fw-bold fs-4 text-primary">{{ number_format($pdfBook->downloads ?? 0) }}</div>
                            <small class="text-muted">ទាញយក</small>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold fs-4 text-success">{{ number_format($pdfBook->userview ?? 0) }}</div>
                            <small class="text-muted">មើល</small>
                        </div>
                        <div class="text-center">
                            <div class="fw-bold fs-4 text-warning">{{ $pdfBook->version ?? '1.0' }}</div>
                            <small class="text-muted">កំណែ</small>
                        </div>
                    </div>

                    @if($pdfBook->file)
                        <a href="{{ route('pdf-books.download', $pdfBook) }}"
                           class="btn btn-success btn-lg w-100 rounded-pill">
                            <i class="bi bi-download me-2"></i>ទាញយក PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            {{-- Book Details Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-info-circle me-2 text-primary"></i>
                        ព័ត៌មានលម្អិត
                    </h5>
                </div>
                <div class="card-body p-4">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 150px;" class="text-muted">ចំណងជើង:</th>
                            <td class="fw-bold">{{ $pdfBook->title }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">ការពិពណ៌នា:</th>
                            <td>{{ $pdfBook->description ?? 'គ្មានការពិពណ៌នា' }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">ប្រភេទ:</th>
                            <td>
                                @if($pdfBook->category)
                                    <span class="badge bg-info">{{ $pdfBook->category->title }}</span>
                                @else
                                    <span class="badge bg-secondary">គ្មានប្រភេទ</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted">កំណែ:</th>
                            <td><span class="badge bg-secondary">v{{ $pdfBook->version ?? '1.0' }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-muted">ស្ថានភាព:</th>
                            <td>
                                @if($pdfBook->status)
                                    <span class="badge bg-success">សកម្ម</span>
                                @else
                                    <span class="badge bg-danger">អសកម្ម</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Uploader Information Card --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 p-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person-circle me-2 text-primary"></i>
                        អ្នកផ្ទុកឡើង
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if($pdfBook->uploader)
                        <div class="d-flex align-items-center">
                            @if($pdfBook->uploader->photo)
                                <img src="{{ asset('storage/' . $pdfBook->uploader->photo) }}"
                                     alt="{{ $pdfBook->uploader->name }}"
                                     class="rounded-circle me-4"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            @else
                                <div class="bg-soft-primary rounded-circle d-flex align-items-center justify-content-center me-4"
                                     style="width: 80px; height: 80px;">
                                    <i class="bi bi-person text-primary" style="font-size: 2.5rem;"></i>
                                </div>
                            @endif
                            <div>
                                <h4 class="fw-bold mb-1">{{ $pdfBook->uploader->name }}</h4>
                                <p class="text-muted mb-2">
                                    <i class="bi bi-envelope me-2"></i>{{ $pdfBook->uploader->email }}
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-calendar me-2"></i>
                                    បានផ្ទុកឡើងនៅថ្ងៃទី {{ $pdfBook->created_at->format('d/m/Y ម៉ោង h:i A') }}
                                </p>
                                @if($pdfBook->uploader->level === 'admin')
                                    <span class="badge bg-danger mt-2">
                                        <i class="bi bi-shield-fill me-1"></i>អ្នកគ្រប់គ្រង
                                    </span>
                                @else
                                    <span class="badge bg-info mt-2">
                                        <i class="bi bi-person me-1"></i>អ្នកប្រើប្រាស់
                                    </span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-person-x text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">មិនមានព័ត៌មានអ្នកផ្ទុកឡើង</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style scoped>
.bg-soft-primary {
    background-color: rgba(102, 126, 234, 0.1);
}

.table-borderless th,
.table-borderless td {
    padding: 1rem 0;
    border: none;
}

.table-borderless tr {
    border-bottom: 1px solid #e9ecef;
}

.table-borderless tr:last-child {
    border-bottom: none;
}
</style>

