@extends('layouts.myapp')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Card -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-2xl">Welcome to {{ config('app.name') }}</h2>
            <p class="text-base-content/70">Laravel {{ Illuminate\Foundation\Application::VERSION }} with Bootstrap 5</p>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    console.log('Run home')
    console.log('Home page loaded - Laravel {{ Illuminate\Foundation\Application::VERSION }}');
</script>
@endpush
