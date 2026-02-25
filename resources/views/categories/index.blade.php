@extends('layouts.myapp')
@section('title', 'categories')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add categories</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>title</th>
        </tr>
        @foreach ($categories as $s)
            <tr>
                <td>{{ $s->title }}</td>
                <td>
<form action="{{ route('categories.destroy', $s->id) }}" method="POST" class="delete-form" style="display:inline;">
    @csrf @method('DELETE')
    <a href="{{ route('categories.edit', $s->id) }}" class="btn btn-sm btn-warning">
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
