@extends('layouts.myapp')
@section('title', 'Add Category')
@section('content')
<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="text" name="title" class="form-control mb-2" placeholder="title" required>
  <button type="submit" class="btn btn-primary">Save Category</button>
</form>
@endsection
