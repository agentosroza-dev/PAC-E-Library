{{-- ================================================================================
    ទំព័រគ្រប់គ្រងសៀវភៅ PDF - Main Index Page
    ================================================================================
    - បង្ហាញបញ្ជីសៀវភៅ PDF ទាំងអស់
    - មានស្ថិតិសង្ខេប (Stats Cards)
    - មានតម្រង និងស្វែងរក
    - មានការតម្រៀបតាមវាលផ្សេងៗ
    - មាន View Toggle (Table, Grid, List, Card)
    ================================================================================ --}}

@extends('layouts.myapp')

{{-- ================================================================================
    កំណត់ចំណងជើងទំព័រ
    ================================================================================ --}}
@section('title', 'គ្រប់គ្រងសៀវភៅ PDF')

{{-- ================================================================================
    Breadcrumb - បង្ហាញទីតាំងបច្ចុប្បន្ន
    ================================================================================ --}}
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('pdf-books.index') }}" class="text-decoration-none">
            <i class="bi bi-file-pdf-fill me-1"></i>សៀវភៅ PDF
        </a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        <i class="bi bi-list-ul me-1"></i>បញ្ជីសៀវភៅ
    </li>
@endsection

@section('content')
    {{-- ================================================================================
        SECTION 1: STATS CARDS - បង្ហាញស្ថិតិសង្ខេប
        ================================================================================ --}}
    <div class="row g-4 mb-4">
        {{-- Card 1: សៀវភៅសរុប --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-primary border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-file-pdf-fill text-primary fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">សៀវភៅសរុប</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['total_books']) }}</h3>
                        <small class="text-success">
                            <i class="bi bi-arrow-up-short"></i> សរុបទាំងអស់
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: សៀវភៅសកម្ម --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-success border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-check-circle-fill text-success fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">សកម្ម</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['active_books']) }}</h3>
                        <small class="text-success">
                            <i class="bi bi-check-circle me-1"></i>អាចប្រើបាន
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: ប្រភេទសរុប --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-warning border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-warning bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-tags-fill text-warning fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ប្រភេទ</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['categories_count']) }}</h3>
                        <small class="text-info">
                            <i class="bi bi-book me-1"></i>ច្រើនប្រភេទ
                        </small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: ទាញយកសរុប --}}
        <div class="col-sm-6 col-lg-3">
            <div class="stat-card-modern bg-white p-4 rounded-4 shadow-sm border-start border-info border-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon-wrapper bg-info bg-opacity-10 rounded-3 p-3">
                        <i class="bi bi-download text-info fs-2"></i>
                    </div>
                    <div>
                        <span class="text-muted small text-uppercase tracking-wider">ទាញយកសរុប</span>
                        <h3 class="fw-bold mb-0 display-6">{{ number_format($statistics['total_downloads']) }}</h3>
                        <small class="text-primary">
                            <i class="bi bi-arrow-up-short me-1"></i>ដង
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================================
        SECTION 2: HERO SECTION - ផ្នែកក្បាលទំព័រជាមួយប៊ូតុងសកម្មភាព
        ================================================================================ --}}
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="bg-gradient-primary p-4 rounded-4 shadow-lg">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="">
                            <h2 class="fw-bold text-white mb-2">
                                <i class="bi bi-pencil-square me-2"></i>ព័ត៌មានសៀវភៅ
                            </h2>
                            <p class="text-white opacity-75 mb-0">ព័ត៌មានលម្អិតរបស់សៀវភៅ</p>
                        </div>

                        {{-- ប៊ូតុងសកម្មភាព --}}
                        <div class="d-flex gap-2">
                            <a href="{{ route('pdf-books.most-downloaded') }}"
                                class="btn btn-gradient-info btn-lg px-4 py-3 rounded-pill shadow-lg hover-scale"
                                title="មើលសៀវភៅដែលពេញនិយម">
                                <i class="bi bi-bar-chart-fill me-2"></i>
                                <span class="d-none d-sm-inline">ពេញនិយម</span>
                            </a>
                            <a href="{{ route('pdf-books.most-viewed') }}"
                                class="btn btn-gradient-warning btn-lg px-4 py-3 rounded-pill shadow-lg hover-scale"
                                title="មើលសៀវភៅដែលមើលច្រើន">
                                <i class="bi bi-eye-fill me-2"></i>
                                <span class="d-none d-sm-inline">មើលច្រើន</span>
                            </a>
                            <a href="{{ route('pdf-books.create') }}"
                                class="btn btn-gradient-success btn-lg px-5 py-3 rounded-pill shadow-lg hover-scale">
                                <i class="bi bi-plus-circle-fill me-2"></i>
                                <span class="d-none d-sm-inline">បន្ថែមសៀវភៅថ្មី</span>
                                <span class="d-sm-none">បន្ថែម</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ================================================================================
        SECTION 3: FILTER CARD - តម្រង និងស្វែងរក ជាមួយ View Toggle
        ================================================================================ --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-header bg-white border-0 p-4">
            <div class="d-flex align-items-center justify-content-between">
                {{-- ចំណងជើងតម្រង --}}
                <div class="d-flex align-items-center gap-2">
                    <div class="filter-icon bg-primary bg-opacity-10 rounded-3 p-2">
                        <i class="bi bi-funnel text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-0">តម្រង និងស្វែងរក</h5>
                </div>

                <div class="d-flex align-items-center gap-3">
                    {{-- ================================================================================
                        VIEW TOGGLE BUTTONS - ប៊ូតុងប្តូររបៀបបង្ហាញ
                        ================================================================================ --}}
                    <div class="btn-group btn-group-sm" role="group" aria-label="View Toggle">
                        <button type="button" class="btn btn-outline-primary view-toggle active" data-view="table" title="បង្ហាញជាតារាង">
                            <i class="bi bi-table"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary view-toggle" data-view="grid" title="បង្ហាញជាក្រឡាចត្រង្គ">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary view-toggle" data-view="list" title="បង្ហាញជាបញ្ជី">
                            <i class="bi bi-list-ul"></i>
                        </button>
                        <button type="button" class="btn btn-outline-primary view-toggle" data-view="card" title="បង្ហាញជាកាត">
                            <i class="bi bi-card-list"></i>
                        </button>
                    </div>

                    {{-- ការតម្រៀប --}}
                    <div class="d-flex gap-2">
                        <select id="sort_by_select" class="form-select form-select-sm" style="width: auto;">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>ថ្មីបំផុត</option>
                            <option value="downloads" {{ request('sort_by') == 'downloads' ? 'selected' : '' }}>ទាញយកច្រើន</option>
                            <option value="userview" {{ request('sort_by') == 'userview' ? 'selected' : '' }}>មើលច្រើន</option>
                            <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>ចំណងជើង</option>
                            <option value="category_id" {{ request('sort_by') == 'category_id' ? 'selected' : '' }}>ប្រភេទ</option>
                            <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>ស្ថានភាព</option>
                            <option value="version" {{ request('sort_by') == 'version' ? 'selected' : '' }}>កំណែ</option>
                        </select>
                        <select id="sort_order_select" class="form-select form-select-sm" style="width: auto;">
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>ចុះ</option>
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>ឡើង</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- ទម្រង់តម្រង --}}
        <div class="card-body p-4 pt-0">
            <form action="{{ route('pdf-books.index') }}" method="GET" class="row g-3" id="filterForm">
                {{-- រក្សាតម្លៃតម្រៀប --}}
                <input type="hidden" name="sort_by" id="sort_by" value="{{ request('sort_by', 'created_at') }}">
                <input type="hidden" name="sort_order" id="sort_order" value="{{ request('sort_order', 'desc') }}">

                {{-- ប្រអប់ស្វែងរក --}}
                <div class="col-lg-5">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white border-0">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search"
                                class="form-control form-control-lg border-0 shadow-none"
                                placeholder="ស្វែងរកតាមចំណងជើង ឬការពិពណ៌នា..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary px-4">ស្វែងរក</button>
                            @if (request()->has('search') && request('search') != '')
                                <a href="{{ route('pdf-books.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- តម្រងតាមប្រភេទ --}}
                <div class="col-lg-3">
                    <select name="category_id" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="">ប្រភេទទាំងអស់</option>
                        @if (isset($categories) && $categories->count() > 0)
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                {{-- តម្រងតាមស្ថានភាព --}}
                <div class="col-lg-2">
                    <select name="status" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="">ស្ថានភាពទាំងអស់</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>សកម្ម</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>អសកម្ម</option>
                    </select>
                </div>

                {{-- ជម្រើសបង្ហាញចំនួនក្នុងមួយទំព័រ --}}
                <div class="col-lg-2">
                    <select name="per_page" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>១០ ក្បាល</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>២០ ក្បាល</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>៥០ ក្បាល</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>១០០ ក្បាល</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    {{-- ================================================================================
        SECTION 4: SORT INFO - បង្ហាញព័ត៌មានអំពីការតម្រៀបបច្ចុប្បន្ន
        ================================================================================ --}}
    @if (request()->has('sort_by') || request()->has('sort_order'))
        <div class="alert alert-info mb-4">
            <i class="bi bi-info-circle-fill me-2"></i>
            តម្រៀបតាម:
            @if (request('sort_by') == 'created_at')
                ថ្មីបំផុត
            @elseif(request('sort_by') == 'downloads')
                ទាញយកច្រើន
            @elseif(request('sort_by') == 'userview')
                មើលច្រើន
            @elseif(request('sort_by') == 'title')
                ចំណងជើង
            @elseif(request('sort_by') == 'category_id')
                ប្រភេទ
            @elseif(request('sort_by') == 'status')
                ស្ថានភាព
            @elseif(request('sort_by') == 'version')
                កំណែ
            @endif
            ({{ request('sort_order') == 'asc' ? 'ឡើង' : 'ចុះ' }})
        </div>
    @endif

    {{-- ================================================================================
        SCRIPT: ការតម្រៀបដោយស្វ័យប្រវត្តិ
        ================================================================================ --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortBySelect = document.getElementById('sort_by_select');
            const sortOrderSelect = document.getElementById('sort_order_select');
            const sortByHidden = document.getElementById('sort_by');
            const sortOrderHidden = document.getElementById('sort_order');
            const filterForm = document.getElementById('filterForm');

            function updateSort() {
                sortByHidden.value = sortBySelect.value;
                sortOrderHidden.value = sortOrderSelect.value;
            }

            sortBySelect.addEventListener('change', function() {
                updateSort();
                filterForm.submit();
            });

            sortOrderSelect.addEventListener('change', function() {
                updateSort();
                filterForm.submit();
            });
        });
    </script>

    {{-- ================================================================================
        SECTION 5: ALERT MESSAGES - បង្ហាញសារជោគជ័យ/កំហុស
        ================================================================================ --}}
    @if (session('success'))
        <div class="alert-modern alert-success-modern alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon-wrapper bg-success bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-check-circle-fill text-success fs-4"></i>
                </div>
                <div class="flex-grow-1">
                    <strong class="d-block text-success">ជោគជ័យ!</strong>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-modern alert-error-modern alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="alert-icon-wrapper bg-danger bg-opacity-25 rounded-3 p-2 me-3">
                    <i class="bi bi-exclamation-triangle-fill text-danger fs-4"></i>
                </div>
                <div class="flex-grow-1">
                    <strong class="d-block text-danger">កំហុស!</strong>
                    <span>{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- ================================================================================
        SECTION 6: SEARCH RESULT INFO - បង្ហាញព័ត៌មានលទ្ធផលស្វែងរក
        ================================================================================ --}}
    @if (request()->has('search') && request('search') != '')
        <div class="search-result-info bg-white p-3 rounded-3 shadow-sm mb-4">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-info-circle-fill text-primary fs-4"></i>
                <div>
                    <strong>លទ្ធផលស្វែងរកសម្រាប់:</strong> "{{ request('search') }}"
                    <span class="badge bg-primary ms-2 rounded-pill">{{ $pdfBooks->total() }} ក្បាល</span>
                </div>
                <a href="{{ route('pdf-books.index', array_merge(request()->except(['search', 'page']))) }}"
                    class="btn btn-sm btn-outline-secondary ms-auto">
                    <i class="bi bi-x-circle me-1"></i>សម្អាត
                </a>
            </div>
        </div>
    @endif

    {{-- ================================================================================
        SECTION 7: VIEW CONTAINERS - តំបន់បង្ហាញទិន្នន័យតាមរបៀបផ្សេងៗ
        ================================================================================ --}}

    {{-- --------------------------------------------------------------------------------
        VIEW 1: TABLE VIEW - បង្ហាញជាតារាង (របៀបដើម)
        -------------------------------------------------------------------------------- --}}
    <div id="table-view" class="view-container">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white border-0 p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div class="table-icon bg-primary bg-opacity-10 rounded-3 p-2">
                            <i class="bi bi-table text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-0">បញ្ជីសៀវភៅ PDF</h5>
                    </div>
                    <span class="badge bg-primary rounded-pill px-3 py-2">
                        <i class="bi bi-file-pdf me-1"></i>
                        {{ $pdfBooks->total() }} ក្បាល
                    </span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-modern table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="px-4 py-3" width="50">#</th>
                                <th class="py-3" width="100">រូបភាព</th>
                                <th class="py-3">
                                    <a href="{{ route('pdf-books.index', array_merge(request()->query(), ['sort_by' => 'title', 'sort_order' => request('sort_by') == 'title' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                        ចំណងជើង
                                        @if (request('sort_by') == 'title')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} text-primary"></i>
                                        @else
                                            <i class="bi bi-arrow-down-up text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="py-3">
                                    <a href="{{ route('pdf-books.index', array_merge(request()->query(), ['sort_by' => 'category_id', 'sort_order' => request('sort_by') == 'category_id' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                        ប្រភេទ
                                        @if (request('sort_by') == 'category_id')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} text-primary"></i>
                                        @else
                                            <i class="bi bi-arrow-down-up text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="py-3">
                                    <a href="{{ route('pdf-books.index', array_merge(request()->query(), ['sort_by' => 'version', 'sort_order' => request('sort_by') == 'version' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                        កំណែ
                                        @if (request('sort_by') == 'version')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} text-primary"></i>
                                        @else
                                            <i class="bi bi-arrow-down-up text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="py-3">
                                    <a href="{{ route('pdf-books.index', array_merge(request()->query(), ['sort_by' => 'downloads', 'sort_order' => request('sort_by') == 'downloads' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                        ទាញយក
                                        @if (request('sort_by') == 'downloads')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} text-primary"></i>
                                        @else
                                            <i class="bi bi-arrow-down-up text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="py-3">
                                    <a href="{{ route('pdf-books.index', array_merge(request()->query(), ['sort_by' => 'userview', 'sort_order' => request('sort_by') == 'userview' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                        អ្នកមើល
                                        @if (request('sort_by') == 'userview')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} text-primary"></i>
                                        @else
                                            <i class="bi bi-arrow-down-up text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="py-3" width="100">
                                    <a href="{{ route('pdf-books.index', array_merge(request()->query(), ['sort_by' => 'status', 'sort_order' => request('sort_by') == 'status' && request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}"
                                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                                        ស្ថានភាព
                                        @if (request('sort_by') == 'status')
                                            <i class="bi bi-arrow-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} text-primary"></i>
                                        @else
                                            <i class="bi bi-arrow-down-up text-muted"></i>
                                        @endif
                                    </a>
                                </th>
                                <th class="py-3">ឯកសារ</th>
                                <th class="py-3 text-center" width="300">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pdfBooks as $index => $pdfBook)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3 fw-medium">{{ $pdfBooks->firstItem() + $index }}</td>
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
                                                <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                                                    style="width: 12px; height: 12px;"></span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div>
                                            <strong class="d-block">{{ $pdfBook->title }}</strong>
                                            @if ($pdfBook->description)
                                                <small class="text-muted">{{ Str::limit($pdfBook->description, 40) }}</small>
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
                                        <span class="badge-soft badge-soft-info px-3 py-2 rounded-3">
                                            <i class="bi bi-download me-1"></i>
                                            {{ number_format($pdfBook->downloads ?? 0) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge-soft badge-soft-primary px-3 py-2 rounded-3">
                                            {{ number_format($pdfBook->userview ?? 0) }}
                                        </span>
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
                                    <td class="py-3">
                                        @if ($pdfBook->file)
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-pdf text-danger me-2 fs-5"></i>
                                                <span class="badge-soft badge-soft-success px-3 py-2 rounded-3">
                                                    មានឯកសារ
                                                </span>
                                                <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                                    class="btn btn-sm btn-link text-success p-0 ms-2 hover-scale"
                                                    title="ទាញយក PDF">
                                                    <i class="bi bi-download fs-5"></i>
                                                </a>
                                            </div>
                                            <small class="text-muted d-block mt-1">
                                                {{ Str::limit(basename($pdfBook->file), 20) }}
                                            </small>
                                        @else
                                            <span class="badge-soft badge-soft-secondary px-3 py-2 rounded-3">
                                                <i class="bi bi-x-circle me-1"></i>
                                                គ្មានឯកសារ
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-1 col-sm-1 text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                                            <a href="{{ route('pdf-books.show', $pdfBook) }}"
                                                class="btn btn-sm btn-icon btn-info" title="មើលលម្អិត"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('pdf-books.edit', $pdfBook) }}"
                                                class="btn btn-sm btn-icon btn-warning" title="កែប្រែ"
                                                data-bs-toggle="tooltip">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            @if ($pdfBook->file)
                                                <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                                    class="btn btn-sm btn-icon btn-success" title="ទាញយក PDF"
                                                    data-bs-toggle="tooltip">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @endif

                                            <form action="{{ route('pdf-books.destroy', $pdfBook->id) }}" method="POST"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-icon btn-danger btn-delete"
                                                    title="លុប" data-bs-toggle="tooltip" data-id="{{ $pdfBook->id }}"
                                                    data-name="{{ $pdfBook->title }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @auth
                                                @if (Auth::check() && Auth::user()->level === 'admin')
                                                    <form action="{{ route('pdf-books.reset-downloads', $pdfBook->id) }}"
                                                        method="POST" class="d-inline reset-downloads-form">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-secondary btn-reset-downloads"
                                                            title="កំណត់ចំនួនទាញយកឡើងវិញ" data-id="{{ $pdfBook->id }}"
                                                            data-name="{{ $pdfBook->title }}">
                                                            <i class="bi bi-arrow-counterclockwise"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('pdf-books.reset-userviews', $pdfBook->id) }}"
                                                        method="POST" class="d-inline reset-views-form">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-secondary btn-reset-views"
                                                            title="កំណត់ចំនួនអ្នកមើលឡើងវិញ" data-id="{{ $pdfBook->id }}"
                                                            data-name="{{ $pdfBook->title }}">
                                                            <i class="bi bi-eye-slash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-5">
                                        <div class="empty-state">
                                            <div class="empty-state-icon mb-4">
                                                <i class="bi bi-file-pdf text-muted" style="font-size: 5rem;"></i>
                                            </div>
                                            <h4 class="text-muted mb-3">មិនមានទិន្នន័យសៀវភៅ PDF ទេ</h4>
                                            @if (request()->has('search') || request()->has('category_id') || request()->has('status'))
                                                <p class="text-muted mb-4">មិនឃើញសៀវភៅដែលត្រូវនឹងការស្វែងរកទេ</p>
                                                <a href="{{ route('pdf-books.index') }}"
                                                    class="btn btn-primary px-4 py-2 rounded-pill">
                                                    <i class="bi bi-arrow-left me-2"></i>ត្រឡប់ក្រោយ
                                                </a>
                                            @else
                                                <a href="{{ route('pdf-books.create') }}"
                                                    class="btn btn-gradient-success px-4 py-2 rounded-pill">
                                                    <i class="bi bi-plus-circle me-2"></i>បន្ថែមសៀវភៅដំបូង
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- --------------------------------------------------------------------------------
        VIEW 2: GRID VIEW - បង្ហាញជាក្រឡាចត្រង្គ
        -------------------------------------------------------------------------------- --}}
    <div id="grid-view" class="view-container" style="display: none;">
        <div class="row g-4">
            @forelse($pdfBooks as $pdfBook)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-scale">
                    <div class="position-relative">
                        @if($pdfBook->image)
                            <img src="{{ asset('storage/' . $pdfBook->image) }}"
                                 class="card-img-top"
                                 alt="{{ $pdfBook->title }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-soft-primary d-flex align-items-center justify-content-center"
                                 style="height: 200px;">
                                <i class="bi bi-file-pdf text-primary" style="font-size: 4rem;"></i>
                            </div>
                        @endif

                        @if($pdfBook->status)
                            <span class="position-absolute top-0 end-0 badge bg-success m-2">
                                <i class="bi bi-check-circle me-1"></i>សកម្ម
                            </span>
                        @else
                            <span class="position-absolute top-0 end-0 badge bg-danger m-2">
                                <i class="bi bi-x-circle me-1"></i>អសកម្ម
                            </span>
                        @endif

                        @if($pdfBook->file)
                            <a href="{{ route('pdf-books.download', $pdfBook) }}"
                               class="position-absolute bottom-0 end-0 btn btn-sm btn-success m-2 rounded-circle"
                               title="ទាញយក PDF">
                                <i class="bi bi-download"></i>
                            </a>
                        @endif
                    </div>

                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">{{ Str::limit($pdfBook->title, 30) }}</h5>

                        @if($pdfBook->description)
                            <p class="card-text text-muted small mb-3">
                                {{ Str::limit($pdfBook->description, 60) }}
                            </p>
                        @endif

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            @if($pdfBook->category)
                                <span class="badge-soft badge-soft-info px-2 py-1 rounded-3 small">
                                    <i class="bi bi-tag me-1"></i>{{ $pdfBook->category->title }}
                                </span>
                            @endif

                            @if($pdfBook->version)
                                <span class="badge-soft badge-soft-secondary px-2 py-1 rounded-3 small">
                                    <i class="bi bi-tag me-1"></i>v{{ $pdfBook->version }}
                                </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <span class="badge-soft badge-soft-info px-2 py-1 rounded-3 small">
                                    <i class="bi bi-download me-1"></i>{{ number_format($pdfBook->downloads ?? 0) }}
                                </span>
                                <span class="badge-soft badge-soft-primary px-2 py-1 rounded-3 small">
                                    <i class="bi bi-eye me-1"></i>{{ number_format($pdfBook->userview ?? 0) }}
                                </span>
                            </div>

                            <div class="btn-group">
                                <a href="{{ route('pdf-books.show', $pdfBook) }}"
                                   class="btn btn-sm btn-icon btn-info"
                                   title="មើលលម្អិត">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('pdf-books.edit', $pdfBook) }}"
                                   class="btn btn-sm btn-icon btn-warning"
                                   title="កែប្រែ">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state py-5">
                    <i class="bi bi-file-pdf text-muted" style="font-size: 5rem;"></i>
                    <h4 class="text-muted mt-3">មិនមានទិន្នន័យសៀវភៅ PDF ទេ</h4>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- --------------------------------------------------------------------------------
        VIEW 3: LIST VIEW - បង្ហាញជាបញ្ជី
        -------------------------------------------------------------------------------- --}}
    <div id="list-view" class="view-container" style="display: none;">
        <div class="list-group list-group-flush">
            @forelse($pdfBooks as $pdfBook)
            <div class="list-group-item border-0 border-bottom py-3 px-0">
                <div class="row align-items-center">
                    <div class="col-auto">
                        @if($pdfBook->image)
                            <img src="{{ asset('storage/' . $pdfBook->image) }}"
                                 alt="{{ $pdfBook->title }}"
                                 style="width: 50px; height: 50px; object-fit: cover;"
                                 class="rounded-3">
                        @else
                            <div class="bg-soft-primary rounded-3 d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px;">
                                <i class="bi bi-file-pdf text-primary fs-4"></i>
                            </div>
                        @endif
                    </div>

                    <div class="col">
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            <h6 class="mb-0 fw-bold">{{ $pdfBook->title }}</h6>
                            @if($pdfBook->category)
                                <span class="badge-soft badge-soft-info px-2 py-1 rounded-3 small">
                                    {{ $pdfBook->category->title }}
                                </span>
                            @endif
                            <span class="badge-soft badge-soft-secondary px-2 py-1 rounded-3 small">
                                v{{ $pdfBook->version ?? '1.0' }}
                            </span>
                        </div>

                        @if($pdfBook->description)
                            <small class="text-muted d-block mt-1">{{ Str::limit($pdfBook->description, 60) }}</small>
                        @endif
                    </div>

                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex gap-2">
                                <span class="badge-soft badge-soft-info px-2 py-1 rounded-3 small">
                                    <i class="bi bi-download"></i> {{ number_format($pdfBook->downloads ?? 0) }}
                                </span>
                                <span class="badge-soft badge-soft-primary px-2 py-1 rounded-3 small">
                                    <i class="bi bi-eye"></i> {{ number_format($pdfBook->userview ?? 0) }}
                                </span>
                                @if($pdfBook->status)
                                    <span class="badge-soft badge-soft-success px-2 py-1 rounded-3 small">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                @else
                                    <span class="badge-soft badge-soft-danger px-2 py-1 rounded-3 small">
                                        <i class="bi bi-x-circle"></i>
                                    </span>
                                @endif
                            </div>

                            <div class="btn-group">
                                <a href="{{ route('pdf-books.show', $pdfBook) }}"
                                   class="btn btn-sm btn-icon btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('pdf-books.edit', $pdfBook) }}"
                                   class="btn btn-sm btn-icon btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @if($pdfBook->file)
                                    <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                       class="btn btn-sm btn-icon btn-success">
                                        <i class="bi bi-download"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="bi bi-file-pdf text-muted" style="font-size: 5rem;"></i>
                <h4 class="text-muted mt-3">មិនមានទិន្នន័យសៀវភៅ PDF ទេ</h4>
            </div>
            @endforelse
        </div>
    </div>

    {{-- --------------------------------------------------------------------------------
        VIEW 4: CARD VIEW - បង្ហាញជាកាត
        -------------------------------------------------------------------------------- --}}
    <div id="card-view" class="view-container" style="display: none;">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
            @forelse($pdfBooks as $pdfBook)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-scale">
                    <div class="card-header bg-transparent border-0 pt-3 px-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <span class="badge {{ $pdfBook->status ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                {{ $pdfBook->status ? 'សកម្ម' : 'អសកម្ម' }}
                            </span>
                            <small class="text-muted">#{{ $pdfBook->id }}</small>
                        </div>
                    </div>

                    <div class="card-body text-center pt-0">
                        @if($pdfBook->image)
                            <img src="{{ asset('storage/' . $pdfBook->image) }}"
                                 alt="{{ $pdfBook->title }}"
                                 class="rounded-circle mb-3 border"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="bg-soft-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                 style="width: 80px; height: 80px;">
                                <i class="bi bi-file-pdf text-primary fs-1"></i>
                            </div>
                        @endif

                        <h5 class="card-title fw-bold">{{ Str::limit($pdfBook->title, 25) }}</h5>

                        @if($pdfBook->category)
                            <p class="text-muted small mb-2">
                                <i class="bi bi-tag me-1"></i>{{ $pdfBook->category->title }}
                            </p>
                        @endif

                        <div class="d-flex justify-content-center gap-3 mb-3">
                            <div class="text-center">
                                <div class="fw-bold">{{ number_format($pdfBook->downloads ?? 0) }}</div>
                                <small class="text-muted">ទាញយក</small>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold">{{ number_format($pdfBook->userview ?? 0) }}</div>
                                <small class="text-muted">មើល</small>
                            </div>
                            <div class="text-center">
                                <div class="fw-bold">{{ $pdfBook->version ?? '1.0' }}</div>
                                <small class="text-muted">កំណែ</small>
                            </div>
                        </div>

                        @if($pdfBook->description)
                            <p class="card-text text-muted small">
                                {{ Str::limit($pdfBook->description, 50) }}
                            </p>
                        @endif
                    </div>

                    <div class="card-footer bg-transparent border-0 pb-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('pdf-books.show', $pdfBook) }}"
                               class="btn btn-sm btn-outline-info rounded-pill px-3">
                                <i class="bi bi-eye me-1"></i>មើល
                            </a>
                            <a href="{{ route('pdf-books.edit', $pdfBook) }}"
                               class="btn btn-sm btn-outline-warning rounded-pill px-3">
                                <i class="bi bi-pencil me-1"></i>កែ
                            </a>
                            @if($pdfBook->file)
                                <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                   class="btn btn-sm btn-outline-success rounded-pill px-3">
                                    <i class="bi bi-download"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state py-5">
                    <i class="bi bi-file-pdf text-muted" style="font-size: 5rem;"></i>
                    <h4 class="text-muted mt-3">មិនមានទិន្នន័យសៀវភៅ PDF ទេ</h4>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ================================================================================
        SECTION 8: PAGINATION - ការបែងចែកទំព័រ
        ================================================================================ --}}
    @if ($pdfBooks->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4 mt-4">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="pagination-info text-muted">
                    <i class="bi bi-layout-text-window me-2"></i>
                    បង្ហាញពី {{ $pdfBooks->firstItem() }} ដល់ {{ $pdfBooks->lastItem() }}
                    នៃ {{ $pdfBooks->total() }} ក្បាល
                </div>
                <div class="pagination-modern">
                    {{ $pdfBooks->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    @endif
@endsection

{{-- ================================================================================
    CUSTOM STYLES - រចនាប័ទ្មផ្ទាល់ខ្លួន
    ================================================================================ --}}
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

    /* Badge Soft Primary */
    .badge-soft-primary {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
    }

    /* View Toggle */
    .view-toggle {
        transition: all 0.3s ease;
    }
    .view-toggle.active {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-color: transparent;
    }
    .view-toggle.active i {
        color: white;
    }

    /* Hover Scale */
    .hover-scale {
        transition: transform 0.3s ease;
    }
    .hover-scale:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
    }
</style>

{{-- ================================================================================
    SCRIPTS - កូដ JavaScript
    ================================================================================ --}}
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ============================================================================
            // VIEW TOGGLE FUNCTIONALITY - ប្តូររបៀបបង្ហាញ
            // ============================================================================
            const viewToggles = document.querySelectorAll('.view-toggle');
            const viewContainers = document.querySelectorAll('.view-container');

            // ផ្ទុកការកំណត់ view ដែលបានរក្សាទុក
            const savedView = localStorage.getItem('pdfBooksView') || 'table';

            // កំណត់ view សកម្មដំបូង
            viewToggles.forEach(toggle => {
                toggle.classList.remove('active');
                if (toggle.dataset.view === savedView) {
                    toggle.classList.add('active');
                }
            });

            viewContainers.forEach(container => {
                container.style.display = 'none';
            });
            document.getElementById(`${savedView}-view`).style.display = 'block';

            // ចាប់ព្រឹត្តិការណ៍ចុចលើប៊ូតុង view toggle
            viewToggles.forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const view = this.dataset.view;

                    // ធ្វើបច្ចុប្បន្នភាពស្ថានភាពសកម្ម
                    viewToggles.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // បង្ហាញ view ដែលបានជ្រើសរើស
                    viewContainers.forEach(container => {
                        container.style.display = 'none';
                    });
                    document.getElementById(`${view}-view`).style.display = 'block';

                    // រក្សាទុកការកំណត់
                    localStorage.setItem('pdfBooksView', view);
                });
            });

            // ============================================================================
            // TOOLTIP INITIALIZATION - ដំឡើង Tooltips
            // ============================================================================
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // ============================================================================
            // DELETE CONFIRMATION - បញ្ជាក់ការលុប
            // ============================================================================
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const bookName = this.getAttribute('data-name') || 'សៀវភៅនេះ';

                    Swal.fire({
                        title: 'តើអ្នកពិតជាចង់លុប?',
                        html: `<strong>${bookName}</strong> នឹងត្រូវបានលុបចោលជារៀងរហូត!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: '<i class="bi bi-trash me-2"></i>បាទ/ចាស លុប',
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់',
                        background: '#f8f9fa',
                        backdrop: `rgba(0,0,0,0.4) left top no-repeat`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // ============================================================================
            // RESET DOWNLOADS CONFIRMATION - បញ្ជាក់ការកំណត់ចំនួនទាញយកឡើងវិញ
            // ============================================================================
            const resetDownloadButtons = document.querySelectorAll('.btn-reset-downloads');
            resetDownloadButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const bookName = this.getAttribute('data-name') || 'សៀវភៅនេះ';

                    Swal.fire({
                        title: 'កំណត់ចំនួនទាញយកឡើងវិញ?',
                        html: `<strong>${bookName}</strong> នឹងត្រូវបានកំណត់ចំនួនទាញយកទៅ ០`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="bi bi-check-circle me-2"></i>បាទ/ចាស',
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // ============================================================================
            // RESET VIEWS CONFIRMATION - បញ្ជាក់ការកំណត់ចំនួនអ្នកមើលឡើងវិញ
            // ============================================================================
            const resetViewButtons = document.querySelectorAll('.btn-reset-views');
            resetViewButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    const bookName = this.getAttribute('data-name') || 'សៀវភៅនេះ';

                    Swal.fire({
                        title: 'កំណត់ចំនួនអ្នកមើលឡើងវិញ?',
                        html: `<strong>${bookName}</strong> នឹងត្រូវបានកំណត់ចំនួនអ្នកមើលទៅ ០`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="bi bi-check-circle me-2"></i>បាទ/ចាស',
                        cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // ============================================================================
            // AUTO-HIDE ALERTS - លាក់សារដោយស្វ័យប្រវត្តិបន្ទាប់ពី ៥ វិនាទី
            // ============================================================================
            setTimeout(() => {
                document.querySelectorAll('.alert-modern').forEach(alert => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000);
        });
    </script>
@endsection
