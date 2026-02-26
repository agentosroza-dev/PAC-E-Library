{{-- ================================================================================
    ទំព័រគ្រប់គ្រងសៀវភៅ PDF - Main Index Page
    ================================================================================ --}}

@extends('layouts.myapp')

@section('title', 'គ្រប់គ្រងសៀវភៅ PDF')

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
        SECTION 3: FILTER CARD - តម្រង និងស្វែងរក
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
                <div class="col-lg-2">
                    <select name="category_id" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="">ប្រភេទទាំងអស់</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
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
                <div class="col-lg-3">
                    <select name="per_page" class="form-select form-select-lg" onchange="this.form.submit()">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>១០ ក្បាល/ទំព័រ</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>២០ ក្បាល/ទំព័រ</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>៥០ ក្បាល/ទំព័រ</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>១០០ ក្បាល/ទំព័រ</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    {{-- ================================================================================
        SECTION 4: VIEW CONTAINERS - TABLE VIEW (របៀបដើម)
        ================================================================================ --}}
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
                                <th class="py-3" width="80">រូបភាព</th>
                                <th class="py-3">ចំណងជើង</th>
                                <th class="py-3">ប្រភេទ</th>
                                <th class="py-3">កំណែ</th>
                                <th class="py-3">ទាញយក</th>
                                <th class="py-3">មើល</th>
                                <th class="py-3">ស្ថានភាព</th>
                                <th class="py-3">អ្នកផ្ទុកឡើង</th> {{-- NEW COLUMN --}}
                                <th class="py-3">ឯកសារ</th>
                                <th class="py-3">សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pdfBooks as $index => $pdfBook)
                                <tr class="border-bottom">
                                    <td class="px-4 py-3 fw-medium">{{ $pdfBooks->firstItem() + $index }}</td>
                                    <td class="py-3">
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
                                    </td>
                                    <td class="py-3">
                                        <strong>{{ $pdfBook->title }}</strong>
                                        @if ($pdfBook->description)
                                            <br>
                                            <small class="text-muted">{{ Str::limit($pdfBook->description, 40) }}</small>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if ($pdfBook->category)
                                            <span class="text-muted badge badge-info">{{ $pdfBook->category->title }}</span>
                                        @else
                                            <span class="text-muted badge badge-secondary">គ្មានប្រភេទ</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if ($pdfBook->version)
                                            <span class="text-muted badge badge-secondary">v{{ $pdfBook->version }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted badge badge-info">
                                            <i class="bi bi-download me-1"></i>
                                            {{ number_format($pdfBook->downloads ?? 0) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted badge badge-primary">
                                            <i class="bi bi-eye me-1"></i>
                                            {{ number_format($pdfBook->userview ?? 0) }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        @if ($pdfBook->status)
                                            <span class="text-muted badge badge-success">
                                                <i class="bi bi-check-circle me-1"></i>សកម្ម
                                            </span>
                                        @else
                                            <span class="text-muted badge badge-danger">
                                                <i class="bi bi-x-circle me-1"></i>អសកម្ម
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        {{-- UPLOADER INFORMATION --}}
                                        @if ($pdfBook->uploader)
                                            <div class="d-flex align-items-center">
                                                @if ($pdfBook->uploader->photo)
                                                    <img src="{{$pdfBook->uploader->photo}}"
                                                        alt="{{ $pdfBook->uploader->name }}"
                                                        class="rounded-circle me-2"
                                                        style="width: 30px; height: 30px; object-fit: cover;">
                                                @else
                                                    <div class="bg-soft-primary rounded-circle d-flex align-items-center justify-content-center me-2"
                                                        style="width: 30px; height: 30px;">
                                                        <i class="bi bi-person text-primary"></i>
                                                    </div>
                                                @endif
                                                <div>

                                                    <a href="{{ route('users.show', $user->id) }}">
                                                        <strong>{{ $pdfBook->uploader->name }}</strong>
                                                    </a>

                                                    {{-- <br>
                                                    <small class="text-muted">{{ $pdfBook->uploader->email }}</small> --}}
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if ($pdfBook->file)
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-file-pdf text-danger me-2 fs-4"></i>
                                                <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                                    class="btn btn-sm btn-success rounded-pill">
                                                    <i class="bi bi-download me-1"></i>ទាញយក
                                                </a>
                                            </div>
                                            <small class="text-muted d-block mt-1">
                                                {{ Str::limit(basename($pdfBook->file), 20) }}
                                            </small>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="bi bi-x-circle me-1"></i>គ្មានឯកសារ
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            <a href="{{ route('pdf-books.show', $pdfBook) }}"
                                                class="btn btn-sm btn-info rounded-pill"
                                                title="មើលលម្អិត">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('pdf-books.edit', $pdfBook) }}"
                                                class="btn btn-sm btn-warning rounded-pill"
                                                title="កែប្រែ">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if ($pdfBook->file)
                                                <a href="{{ route('pdf-books.download', $pdfBook) }}"
                                                    class="btn btn-sm btn-success rounded-pill"
                                                    title="ទាញយក">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @endif
                                            <form action="{{ route('pdf-books.destroy', $pdfBook) }}" method="POST"
                                                class="pt-3 delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn btn-sm btn-danger rounded-pill btn-delete"
                                                    title="លុប"
                                                    data-id="{{ $pdfBook->id }}"
                                                    data-name="{{ $pdfBook->title }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                            {{-- @auth
                                                @if (Auth::user()->level === 'admin')
                                                    <form action="{{ route('pdf-books.reset-downloads', $pdfBook) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-secondary rounded-pill btn-reset-downloads"
                                                            title="កំណត់ចំនួនទាញយកឡើងវិញ"
                                                            data-id="{{ $pdfBook->id }}"
                                                            data-name="{{ $pdfBook->title }}">
                                                            <i class="bi bi-arrow-counterclockwise"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('pdf-books.reset-userviews', $pdfBook) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="button"
                                                            class="btn btn-sm btn-secondary rounded-pill btn-reset-views"
                                                            title="កំណត់ចំនួនអ្នកមើលឡើងវិញ"
                                                            data-id="{{ $pdfBook->id }}"
                                                            data-name="{{ $pdfBook->title }}">
                                                            <i class="bi bi-eye-slash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
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


    {{-- ================================================================================
        SECTION 5: PAGINATION
        ================================================================================ --}}
    @if ($pdfBooks->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                បង្ហាញពី {{ $pdfBooks->firstItem() }} ដល់ {{ $pdfBooks->lastItem() }}
                នៃ {{ $pdfBooks->total() }} ក្បាល
            </div>
            <div>
                {{ $pdfBooks->links() }}
            </div>
        </div>
    @endif

    {{-- ================================================================================
        SECTION 6: SUCCESS/ERROR MESSAGES
        ================================================================================ --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
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

{{-- ================================================================================
    SCRIPTS
    ================================================================================ --}}
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================================================
    // SORTING FUNCTIONALITY
    // ============================================================================
    const sortBySelect = document.getElementById('sort_by_select');
    const sortOrderSelect = document.getElementById('sort_order_select');
    const sortByHidden = document.getElementById('sort_by');
    const sortOrderHidden = document.getElementById('sort_order');
    const filterForm = document.getElementById('filterForm');

    function updateSort() {
        sortByHidden.value = sortBySelect.value;
        sortOrderHidden.value = sortOrderSelect.value;
    }

    sortBySelect?.addEventListener('change', function() {
        updateSort();
        filterForm.submit();
    });

    sortOrderSelect?.addEventListener('change', function() {
        updateSort();
        filterForm.submit();
    });

    // ============================================================================
    // DELETE CONFIRMATION
    // ============================================================================
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const bookName = this.dataset.name || 'សៀវភៅនេះ';

            Swal.fire({
                title: 'តើអ្នកពិតជាចង់លុប?',
                html: `<strong>${bookName}</strong> នឹងត្រូវបានលុបចោលជារៀងរហូត!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="bi bi-trash me-2"></i>បាទ/ចាស លុប',
                cancelButtonText: '<i class="bi bi-x-circle me-2"></i>បោះបង់'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // ============================================================================
    // RESET DOWNLOADS CONFIRMATION
    // ============================================================================
    const resetDownloadButtons = document.querySelectorAll('.btn-reset-downloads');
    resetDownloadButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const bookName = this.dataset.name || 'សៀវភៅនេះ';

            Swal.fire({
                title: 'កំណត់ចំនួនទាញយកឡើងវិញ?',
                html: `<strong>${bookName}</strong> នឹងត្រូវបានកំណត់ចំនួនទាញយកទៅ ០`,
                icon: 'question',
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
    // RESET VIEWS CONFIRMATION
    // ============================================================================
    const resetViewButtons = document.querySelectorAll('.btn-reset-views');
    resetViewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            const bookName = this.dataset.name || 'សៀវភៅនេះ';

            Swal.fire({
                title: 'កំណត់ចំនួនអ្នកមើលឡើងវិញ?',
                html: `<strong>${bookName}</strong> នឹងត្រូវបានកំណត់ចំនួនអ្នកមើលទៅ ០`,
                icon: 'question',
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
    // AUTO-HIDE ALERTS
    // ============================================================================
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});
</script>
@endsection
