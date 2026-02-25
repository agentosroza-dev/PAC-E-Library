@extends('layouts.myapp')

@section('title', 'View PDF Book')

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

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">PDF Book Details: {{ $pdfBook->title }}</h5>
                    <div>
                        <a href="{{ route('pdf-books.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('pdf-books.edit', $pdfBook) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if($pdfBook->image)
                                <img src="{{ asset('storage/' . $pdfBook->image) }}"
                                     alt="{{ $pdfBook->title }}"
                                     class="img-fluid img-thumbnail">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
                                     style="width: 100%; height: 300px;">
                                    <h4>No Image</h4>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 150px;">Title</th>
                                    <td>{{ $pdfBook->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $pdfBook->description ?? 'No description' }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>
                                        @if($pdfBook->category)
                                            <span class="badge bg-info">{{ $pdfBook->category->title }}</span>
                                        @else
                                            <span class="badge bg-secondary">Uncategorized</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Version</th>
                                    <td>
                                        @if($pdfBook->version)
                                            <span class="badge bg-secondary">v{{ $pdfBook->version }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($pdfBook->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>PDF File</th>
                                    <td>
                                        @if($pdfBook->file)
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-pdf text-danger me-2 fs-1"></i>
                                                <div>
                                                    <strong>{{ basename($pdfBook->file) }}</strong>
                                                    <br>
                                                    <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                                       class="btn btn-sm btn-success mt-2">
                                                        <i class="bi bi-download"></i> Download PDF
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge bg-secondary">No File</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $pdfBook->created_at->format('F d, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Updated</th>
                                    <td>{{ $pdfBook->updated_at->format('F d, Y h:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
