@extends('layouts.myapp')

@section('title', 'សៀវភៅ PDF មើលច្រើនជាងគេ')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-books.index') }}" class="text-decoration-none">
            <i class="bi bi-file-pdf-fill me-1"></i>សៀវភៅ PDF
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-eye-fill me-1"></i>មើលច្រើន
    </li>
@endsection

@section('page-icon', 'eye')

@section('content')
<div class="container-fluid py-4">
    <!-- Hero Section ជាមួយ gradient ទំនើប -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-section bg-gradient-primary p-4 rounded-4 shadow-lg position-relative overflow-hidden">
                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-4 position-relative">
                    <div class="text-center text-md-start">
                        <h2 class="fw-bold text-white mb-2">
                            <i class="bi bi-eye-fill me-2"></i> សៀវភៅ PDF មើលច្រើនជាងគេ
                        </h2>
                        <p class="text-white opacity-75 fs-5 mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            សៀវភៅដែលត្រូវបានមើលច្រើនជាងគេទាំង ១០
                        </p>
                    </div>

                    <!-- ប៊ូតុងត្រឡប់ក្រោយ -->
                    <div class="d-flex gap-2">
                        <a href="{{ route('pdf-books.index') }}"
                            class="btn btn-gradient-info btn-lg px-4 py-3 rounded-pill shadow-lg hover-scale">
                            <i class="bi bi-arrow-left me-2"></i>
                            <span>ត្រឡប់ក្រោយ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Summary -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-primary border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-eye-fill text-primary fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">សៀវភៅសរុប</span>
                        <h3 class="fw-bold mb-0 display-6">{{ $mostViewed->count() }}</h3>
                        <small class="text-primary">
                            <i class="bi bi-trophy me-1"></i>ក្នុងចំណាត់ថ្នាក់
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-success border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-eye-fill text-success fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">មើលសរុប</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($mostViewed->sum('userview')) }}</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up me-1"></i>ដង
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-warning border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-trophy-fill text-warning fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">មធ្យមភាគ</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format(round($mostViewed->avg('userview'))) }}
                        </h3>
                        <small class="text-warning">
                            <i class="bi bi-bar-chart me-1"></i>ដង/ក្បាល
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Most Viewed Books List -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="table-icon bg-primary bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-eye-fill text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">កំពូលតារាងមើលច្រើន</h5>
                </div>
                <span class="badge bg-primary rounded-pill px-3 py-2">
                    <i class="bi bi-trophy me-1"></i>
                    កំពូលទាំង ១០
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3" width="80">ចំណាត់ថ្នាក់</th>
                            <th class="py-3" width="100">រូបភាព</th>
                            <th class="py-3">ចំណងជើង</th>
                            <th class="py-3">ប្រភេទ</th>
                            <th class="py-3">កំណែ</th>
                            <th class="py-3">ចំនួនមើល</th>
                            <th class="py-3">ស្ថានភាព</th>
                            <th class="py-3 text-center" width="200">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mostViewed as $index => $pdfBook)
                            <tr class="border-bottom">
                                <td class="px-4 py-3">
                                    @if ($index == 0)
                                        <div class="position-relative">
                                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fs-6">
                                                <i class="bi bi-trophy-fill me-1"></i> #1
                                            </span>
                                        </div>
                                    @elseif($index == 1)
                                        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">
                                            <i class="bi bi-trophy me-1"></i> #2
                                        </span>
                                    @elseif($index == 2)
                                        <span class="badge bg-danger text-white px-3 py-2 rounded-pill">
                                            <i class="bi bi-trophy me-1"></i> #3
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                            #{{ $index + 1 }}
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="position-relative">
                                        @if ($pdfBook->image)
                                            <img src="{{ asset('storage/' . $pdfBook->image) }}"
                                                alt="{{ $pdfBook->title }}" class="rounded-3 object-fit-cover border"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="avatar-placeholder bg-soft-primary rounded-3 d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                <i class="bi bi-file-pdf text-primary fs-4"></i>
                                            </div>
                                        @endif
                                        @if ($pdfBook->status)
                                            <span
                                                class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                                                style="width: 12px; height: 12px;"></span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3">
                                    <div>
                                        <strong class="d-block">{{ $pdfBook->title }}</strong>
                                        @if ($pdfBook->description)
                                            <small
                                                class="text-muted">{{ Str::limit($pdfBook->description, 40) }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3">
                                    @if ($pdfBook->category)
                                        <span class="badge-soft badge-soft-info px-3 py-2 rounded-3">
                                            <i class="bi bi-tag me-1"></i>
                                            {{ $pdfBook->category->title }}
                                        </span>
                                    @else
                                        <span class="badge-soft badge-soft-secondary px-3 py-2 rounded-3">
                                            <i class="bi bi-tag me-1"></i>
                                            គ្មានប្រភេទ
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    @if ($pdfBook->version)
                                        <span class="badge-soft badge-soft-secondary px-3 py-2 rounded-3">
                                            <i class="bi bi-tag me-1"></i>
                                            v{{ $pdfBook->version }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge-soft badge-soft-primary px-3 py-2 rounded-3">
                                            <i class="bi bi-eye me-1"></i>
                                            {{ number_format($pdfBook->userview ?? 0) }}
                                        </span>
                                        @php
                                            $maxViews = $mostViewed->max('userview');
                                            $percentage =
                                                $maxViews > 0
                                                    ? round(($pdfBook->userview / $maxViews) * 100)
                                                    : 0;
                                        @endphp
                                        <div class="progress" style="width: 80px; height: 6px;">
                                            <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                style="width: {{ $percentage }}%;"
                                                aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3">
                                    @if ($pdfBook->status)
                                        <span class="badge-soft badge-soft-success px-3 py-2 rounded-3">
                                            <i class="bi bi-check-circle me-1"></i>
                                            សកម្ម
                                        </span>
                                    @else
                                        <span class="badge-soft badge-soft-danger px-3 py-2 rounded-3">
                                            <i class="bi bi-x-circle me-1"></i>
                                            អសកម្ម
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('pdf-books.show', $pdfBook) }}"
                                            class="btn btn-sm btn-icon btn-info" title="មើលលម្អិត"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if ($pdfBook->file)
                                            <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                                class="btn btn-sm btn-icon btn-success" title="ទាញយក PDF"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon mb-4">
                                            <i class="bi bi-eye-slash text-muted" style="font-size: 5rem;"></i>
                                        </div>
                                        <h4 class="text-muted mb-3">មិនទាន់មានទិន្នន័យមើលនៅឡើយទេ</h4>
                                        <p class="text-muted mb-4">សូមត្រឡប់ទៅកាន់ទំព័រគ្រប់គ្រងវិញ</p>
                                        <a href="{{ route('pdf-books.index') }}"
                                            class="btn btn-primary px-4 py-2 rounded-pill">
                                            <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Category Statistics -->
    @if ($mostViewed->count() > 0)
        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="filter-icon bg-primary bg-opacity-10 rounded-3 p-2">
                                <i class="bi bi-pie-chart-fill text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-0">ស្ថិតិតាមប្រភេទ</h5>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-0">
                        @php
                            $categoryStats = $mostViewed
                                ->groupBy(function ($item) {
                                    return $item->category->title ?? 'គ្មានប្រភេទ';
                                })
                                ->map(function ($group) {
                                    return [
                                        'count' => $group->count(),
                                        'views' => $group->sum('userview'),
                                    ];
                                })
                                ->sortByDesc('views');
                        @endphp

                        @foreach ($categoryStats as $categoryName => $stats)
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-medium">{{ $categoryName }}</span>
                                    <span class="text-muted small">
                                        {{ $stats['count'] }} ក្បាល | {{ number_format($stats['views']) }} ដង
                                    </span>
                                </div>
                                @php
                                    $maxCategoryViews = $categoryStats->max('views');
                                    $categoryPercentage =
                                        $maxCategoryViews > 0
                                            ? round(($stats['views'] / $maxCategoryViews) * 100)
                                            : 0;
                                @endphp
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                        style="width: {{ $categoryPercentage }}%;"
                                        aria-valuenow="{{ $categoryPercentage }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-0 p-4">
                        <div class="d-flex align-items-center gap-2">
                            <div class="filter-icon bg-primary bg-opacity-10 rounded-3 p-2">
                                <i class="bi bi-graph-up-arrow text-primary"></i>
                            </div>
                            <h5 class="fw-bold mb-0">ការវិភាគ</h5>
                        </div>
                    </div>
                    <div class="card-body p-4 pt-0">
                        @php
                            $totalViews = $mostViewed->sum('userview');
                            $avgViews = round($mostViewed->avg('userview'));
                            $maxBook = $mostViewed->sortByDesc('userview')->first();
                            $minBook = $mostViewed->sortBy('userview')->first();
                            $topCategory = $categoryStats->sortByDesc('views')->keys()->first();
                        @endphp

                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>
                                    <i class="bi bi-eye-fill text-primary me-2"></i>
                                    មើលសរុប
                                </span>
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    {{ number_format($totalViews) }} ដង
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>
                                    <i class="bi bi-bar-chart text-success me-2"></i>
                                    មធ្យមភាគ/ក្បាល
                                </span>
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    {{ number_format($avgViews) }} ដង
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>
                                    <i class="bi bi-trophy-fill text-warning me-2"></i>
                                    កំពូលមើលច្រើន
                                </span>
                                <span class="text-truncate" style="max-width: 200px;">
                                    <strong>{{ Str::limit($maxBook->title, 20) }}</strong>
                                    <span
                                        class="badge bg-warning text-dark ms-2">{{ number_format($maxBook->userview) }}</span>
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>
                                    <i class="bi bi-graph-down-arrow text-danger me-2"></i>
                                    ទាបបំផុត
                                </span>
                                <span class="text-truncate" style="max-width: 200px;">
                                    <strong>{{ Str::limit($minBook->title, 20) }}</strong>
                                    <span
                                        class="badge bg-secondary ms-2">{{ number_format($minBook->userview) }}</span>
                                </span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span>
                                    <i class="bi bi-tags-fill text-info me-2"></i>
                                    ប្រភេទពេញនិយម
                                </span>
                                <span class="badge bg-info rounded-pill px-3 py-2">
                                    {{ $topCategory }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Trends -->
        <div class="card border-0 shadow-sm rounded-4 mt-4">
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="filter-icon bg-primary bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-graph-up-arrow text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">ការប្រៀបធៀបចំនួនមើល</h5>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-modern table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3">ចំណាត់ថ្នាក់</th>
                                <th class="py-3">ចំណងជើង</th>
                                <th class="py-3">ចំនួនមើល</th>
                                <th class="py-3">ភាគរយ</th>
                                <th class="py-3">ការប្រៀបធៀប</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mostViewed as $index => $pdfBook)
                                @php
                                    $percentage =
                                        $maxViews > 0 ? round(($pdfBook->userview / $maxViews) * 100) : 0;
                                    $barColor =
                                        $index == 0
                                            ? 'bg-gradient-primary'
                                            : ($index == 1
                                                ? 'bg-gradient-success'
                                                : ($index == 2
                                                    ? 'bg-gradient-warning'
                                                    : 'bg-gradient-info'));
                                @endphp
                                <tr>
                                    <td>
                                        <span
                                            class="badge {{ $index == 0 ? 'bg-warning' : ($index == 1 ? 'bg-secondary' : ($index == 2 ? 'bg-danger' : 'bg-light text-dark')) }} px-3 py-2">
                                            #{{ $index + 1 }}
                                        </span>
                                    </td>
                                    <td>
                                        <strong>{{ $pdfBook->title }}</strong>
                                    </td>
                                    <td>
                                        <span class="badge-soft badge-soft-primary px-3 py-2">
                                            {{ number_format($pdfBook->userview) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-primary">{{ $percentage }}%</span>
                                    </td>
                                    <td style="width: 300px;">
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar {{ $barColor }}" role="progressbar"
                                                style="width: {{ $percentage }}%;"
                                                aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ $percentage }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

<!-- Custom Styles -->
<style>
    /* Gradient Backgrounds */
    .bg-gradient-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .bg-gradient-warning {
        background: linear-gradient(45deg, #f093fb, #f5576c);
    }

    .bg-gradient-secondary {
        background: linear-gradient(45deg, #6c757d, #495057);
    }

    .bg-gradient-success {
        background: linear-gradient(45deg, #11998e, #38ef7d);
    }

    .bg-gradient-info {
        background: linear-gradient(45deg, #17a2b8, #138496);
    }
</style>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add animation to progress bars
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 100);
            });
        });
    </script>
@endsection
