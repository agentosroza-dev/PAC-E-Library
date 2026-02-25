@extends('layouts.myapp')
@section('title', 'Edit Category')
@section('content')
<form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <input type="text" name="title" class="form-control mb-2" value="{{ old('title', $category->title) }}">
<button class="btn btn-success">Update category</button>
</form>
@endsection
