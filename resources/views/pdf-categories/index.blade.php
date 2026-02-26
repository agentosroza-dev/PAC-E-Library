@extends('layouts.myapp')
@section('title', 'categories')
{{-- ================================================================================
    Breadcrumb - បញ្ជីប្រភេទសៀវភៅ PDF
    ================================================================================ --}}
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-categories.index') }}" class="text-decoration-none">
            <i class="bi bi-folder-fill me-1 text-warning"></i>ប្រភេទសៀវភៅ
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-list-ul me-1"></i>បញ្ជីប្រភេទ
    </li>
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('pdf-categories.create') }}" class="btn btn-primary">Add categories</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>title</th>
            <th>description</th>
            <th>Action</th>
        </tr>
        @foreach ($categories as $s)
            <tr>
                <td>{{ $s->title }}</td>
                <td>{{ $s->description }}</td>
                <td>
<form action="{{ route('pdf-categories.destroy', $s->id) }}" method="POST" class="delete-form" style="display:inline;">
    @csrf @method('DELETE')
    <a href="{{ route('pdf-categories.edit', $s->id) }}" class="btn btn-sm btn-warning">
        <i class="bi bi-pencil"></i> Edit
    </a>
    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $s->id }}" data-name="{{ $s->name }}">
        <i class="bi bi-trash me-1"></i> Delete
    </button>
</form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="mt-3">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const categoryName = this.getAttribute('data-name') || 'this category';

            Swal.fire({
                title: 'Are you sure?',
                text: `You want to delete "${categoryName}"? This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
