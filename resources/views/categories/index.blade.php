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
                    <form action="{{ route('categories.destroy', $s->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <a href="{{ route('categories.edit', $s->id) }}" class="btn btn-sm btn-warning"><i
                                class="bi bi-pencil"></i> Edit</a>

                        <button type="button" class="btn btn-sm btn-danger btn-delete"> <i class="bi bi-trash me-1"></i>
                            Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="mt-3">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
@endsection
