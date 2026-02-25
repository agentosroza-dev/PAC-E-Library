{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (optional) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }

        .sidebar a {
            color: #fff;
            padding: 12px;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar a.bg-secondary {
            background-color: #6c757d !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <h5 class="text-white text-center py-3">Menu</h5>
                <a href="{{ route('students.index') }}"
                    class="{{ request()->routeIs('students.*') ? 'bg-secondary' : '' }}">
                    <i class="bi bi-box-seam"></i> Students
                </a>
                <a href="{{ route(name: 'majors.index') }}"
                    class="{{ request()->routeIs('majors.*') ? 'bg-secondary' : '' }}">
                    <i class="bi bi-box-seam"></i> Majors
                </a>
                <a href="{{ route(name: 'pdf-books.index') }}"
                    class="{{ request()->routeIs('pdf-books.*') ? 'bg-secondary' : '' }}">
                    <i class="bi bi-box-seam"></i> Pdf-Books
                </a>
                <a href="{{ route(name: 'categories.index') }}"
                    class="{{ request()->routeIs('categories.*') ? 'bg-secondary' : '' }}">
                    <i class="bi bi-box-seam"></i> Category
                </a>
            </nav>
            <!-- Main content -->
            <main class="col-md-10 p-4">
                <h3>@yield('title')</h3>
                <hr>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- sweetalert2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                let form = this.closest('form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "This item will be permanently deleted.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    <!-- end of sweetalert2-->

</body>

</html> --}}

<!DOCTYPE html>
<html lang="km"  data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ប្រព័ន្ធគ្រប់គ្រង')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts - Khmer -->
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            font-family: 'Kantumruy Pro', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* ===== Top Navbar ===== */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #667eea;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            font-size: 2rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .navbar-brand:hover {
            color: #764ba2;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            background: white;
            box-shadow: 5px 0 20px rgba(0,0,0,0.05);
            min-height: calc(100vh - 80px);
            transition: all 0.3s ease;
            border-right: 1px solid rgba(0,0,0,0.05);
            padding: 20px 0;
        }

        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }

        .sidebar-header h6 {
            color: #6c757d;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
        }

        .nav-section {
            margin-bottom: 20px;
        }

        .nav-section-title {
            padding: 10px 20px;
            color: #6c757d;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-item-custom {
            margin: 5px 10px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #495057;
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link-custom i {
            width: 25px;
            font-size: 1.2rem;
            margin-right: 12px;
            color: #667eea;
            transition: all 0.3s ease;
        }

        .nav-link-custom:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .nav-link-custom:hover i {
            color: white;
            transform: scale(1.1);
        }

        .nav-link-custom.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .nav-link-custom.active i {
            color: white;
        }

        .nav-link-custom .badge {
            margin-left: auto;
            background: linear-gradient(135deg, #ff6b6b, #ee5253);
            color: white;
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 20px;
        }

        /* ===== Dropdown Menu ===== */
        .dropdown-menu-custom {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 10px;
            min-width: 200px;
            animation: slideIn 0.3s ease;
        }

        .dropdown-item-custom {
            padding: 10px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-item-custom i {
            width: 20px;
            color: #667eea;
        }

        .dropdown-item-custom:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        .dropdown-item-custom:hover i {
            color: white;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Main Content ===== */
        .main-content {
            padding: 30px;
            background: #f8fafc;
            min-height: calc(100vh - 80px);
        }

        .page-header {
            background: white;
            padding: 20px 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 5px solid #667eea;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .page-title i {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-right: 10px;
        }

        .breadcrumb-custom {
            background: #f8f9fa;
            padding: 10px 20px;
            border-radius: 30px;
            margin: 0;
        }

        .breadcrumb-custom .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-custom .breadcrumb-item.active {
            color: #6c757d;
        }

        /* ===== Quick Actions ===== */
        .quick-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .btn-quick-action {
            background: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            color: #2c3e50;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-quick-action i {
            color: #667eea;
            font-size: 1.2rem;
        }

        .btn-quick-action:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-quick-action:hover i {
            color: white;
        }

        /* ===== Stats Cards ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.3s ease;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.2);
        }

        .stat-info h4 {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
        }

        .stat-info p {
            color: #6c757d;
            margin: 5px 0 0;
            font-weight: 500;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        /* ===== Content Card ===== */
        .content-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 30px;
            border: none;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* ===== Table Styles ===== */
        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table-custom thead th {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 600;
            padding: 15px;
            border: none;
            font-size: 1rem;
        }

        .table-custom thead th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .table-custom thead th:last-child {
            border-radius: 0 10px 10px 0;
        }

        .table-custom tbody tr {
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .table-custom tbody tr:hover {
            transform: scale(1.01);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .table-custom tbody td {
            padding: 15px;
            vertical-align: middle;
            border: none;
        }

        .table-custom tbody td:first-child {
            border-radius: 10px 0 0 10px;
        }

        .table-custom tbody td:last-child {
            border-radius: 0 10px 10px 0;
        }

        /* ===== Button Styles ===== */
        .btn-action {
            width: 35px;
            height: 35px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin: 0 3px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-action:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-gradient-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-gradient-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-gradient-success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-gradient-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(46, 204, 113, 0.4);
        }

        .btn-gradient-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-gradient-warning:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(243, 156, 18, 0.4);
        }

        .btn-gradient-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-gradient-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(231, 76, 60, 0.4);
        }

        .btn-gradient-info {
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-gradient-info:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(26, 188, 156, 0.4);
        }

        /* ===== Form Styles ===== */
        .form-control-custom {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control-custom:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        /* ===== Alert Styles ===== */
        .alert-custom {
            border-radius: 10px;
            border-left: 5px solid;
            padding: 15px 20px;
            margin-bottom: 20px;
            animation: slideInRight 0.5s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left-color: #28a745;
        }

        .alert-error-custom {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            border-left-color: #dc3545;
        }

        .alert-warning-custom {
            background: linear-gradient(135deg, #fff3cd, #ffeeba);
            border-left-color: #ffc107;
        }

        /* ===== Pagination ===== */
        .pagination-custom {
            gap: 5px;
        }

        .page-link-custom {
            border-radius: 8px !important;
            border: none;
            color: #667eea;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 8px 15px;
            margin: 0 2px;
        }

        .page-link-custom:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .page-item.active .page-link-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        /* ===== Mobile Responsive ===== */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                top: 80px;
                width: 280px;
                height: calc(100vh - 80px);
                z-index: 999;
                overflow-y: auto;
                transition: left 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                justify-content: center;
            }
        }

        /* ===== Custom Scrollbar ===== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #764ba2, #667eea);
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Top Navbar -->
    @include('components.navbar')


    @auth
    <div class="d-flex">
    <!-- Top sidebar -->
    @include('components.sidebar')


        <!-- Main Content -->
        <main class="main-content flex-grow-1">
            <!-- Page Header -->
            {{-- <div class="page-header">

                <h3 class="page-title">
                    <i class="fa-regular fa-@yield('page-icon', 'file')"></i>
                    @yield('title')
                </h3>

            </div> --}}

            <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
    <h3 class="page-title mb-2 mb-md-0">
        <i class="fa-regular fa-@yield('page-icon', 'file')"></i>
        @yield('title')
    </h3>

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none">
                   <i class="bi bi-house-door me-1"></i>ទំព័រដើម
                </a>
            </li>
            @yield('breadcrumb')
        </ol>
    </nav>
</div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                @yield('actions')
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-custom alert-error-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-custom alert-warning-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>សូមពិនិត្យមើលកំហុសខាងក្រោម៖</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="content-card">
                @yield('content')
            </div>
             @include('components.footer')
        </main>

    </div>

    <!-- Add this CSS -->
    <style>
        /* Sidebar Styles */
        .sidebar {
            background: white;
            box-shadow: 5px 0 25px rgba(0, 0, 0, 0.05);
            min-height: 100vh;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            width: 280px;
        }

        /* User Profile Section */
        .user-profile-section {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            border-bottom: 1px solid #e9ecef;
        }

        /* Avatar Styles */
        .avatar {
            transition: all 0.3s ease;
        }

        .avatar:hover {
            transform: scale(1.05);
        }

        /* Navigation Items */
        .nav-item-custom {
            transition: all 0.2s ease;
        }

        .nav-link-custom {
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link-custom:hover {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .nav-link-custom.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .nav-link-custom.active i {
            color: white !important;
        }

        .nav-link-custom.active:hover {
            transform: translateX(5px);
        }

        /* Submenu Styles */
        .nav-sub-link {
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .nav-sub-link:hover {
            background: #f8f9fa;
            color: #667eea !important;
            transform: translateX(5px);
        }

        .nav-sub-link.active {
            background: #f8f9fa;
            color: #667eea !important;
            font-weight: 500;
        }

        /* Rotate chevron when expanded */
        [aria-expanded="true"] .fa-chevron-right {
            transform: rotate(90deg);
        }

        .fa-chevron-right {
            transition: transform 0.3s ease;
        }

        /* Search Wrapper */
        .search-wrapper {
            position: relative;
        }

        .search-wrapper input {
            transition: all 0.3s ease;
        }

        .search-wrapper input:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        /* System Info Card */
        .bg-gradient-light {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
        }

        /* Tooltip Styles */
        [data-bs-toggle="tooltip"] {
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                top: 80px;
                width: 280px;
                height: calc(100vh - 80px);
                z-index: 999;
                overflow-y: auto;
                box-shadow: 5px 0 30px rgba(0, 0, 0, 0.15);
            }

            .sidebar.active {
                left: 0;
            }

            .user-profile-section {
                padding: 15px !important;
            }
        }
    </style>

    <!-- Initialize Tooltips -->
    <script>
        // // Initialize Bootstrap tooltips
        // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl)
        // });

        // Sidebar search functionality
        document.getElementById('sidebarSearch')?.addEventListener('keyup', function () {
            let searchTerm = this.value.toLowerCase();
            let menuItems = document.querySelectorAll('.nav-link-custom');

            menuItems.forEach(item => {
                let text = item.textContent.toLowerCase();
                let parent = item.closest('.nav-item-custom');

                if (text.includes(searchTerm)) {
                    parent.style.display = 'block';
                } else {
                    parent.style.display = 'none';
                }
            });
        });
    </script>
@endauth



    @guest
        <!-- បង្ហាញតែពេលមិនទាន់ Login -->
        <div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 80px);">
            <div class="text-center text-white">
                <i class="fas fa-graduation-cap fa-4x mb-3"></i>
                <h4 class="mb-3">សូមស្វាគមន៍មកកាន់ EduManage</h4>
                <p class="mb-4">ប្រព័ន្ធគ្រប់គ្រងនិស្សិត ជំនាញ និងសៀវភៅ PDF</p>
                <a href="{{ route('login') }}" class="btn btn-gradient-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    ចូលប្រើប្រាស់ប្រព័ន្ធ
                </a>
            </div>
        </div>
    @endguest

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Theme toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            if (newTheme === 'dark') {
                document.body.style.background = 'linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%)';
            } else {
                document.body.style.background = 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)';
            }

            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Update theme text
            const themeText = document.getElementById('theme-text');
            if (themeText) {
                themeText.textContent = newTheme === 'light' ? 'ប្តូរទៅងងឹត' : 'ប្តូរទៅភ្លឺ';
            }
        }

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            document.body.style.background = 'linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%)';
        }
        document.documentElement.setAttribute('data-theme', savedTheme);
        const themeText = document.getElementById('theme-text');
        if (themeText) {
            themeText.textContent = savedTheme === 'light' ? 'ប្តូរទៅងងឹត' : 'ប្តូរទៅភ្លឺ';
        }

        // Sidebar toggle for mobile (តែពេលមាន sidebar)
        @auth
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebarToggle');

            if (window.innerWidth <= 768) {
                if (sidebar && toggleBtn && !sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });
        @endauth

        // Logout confirmation
        function confirmLogout() {
            Swal.fire({
                title: 'តើអ្នកពិតជាចង់ចាកចេញមែនទេ?',
                text: 'អ្នកនឹងត្រូវបានបញ្ជូនទៅកាន់ទំព័រចូលប្រើប្រាស់',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-arrow-right-from-bracket me-2"></i>បាទ/ចាស ចាកចេញ',
                cancelButtonText: '<i class="fas fa-times me-2"></i>បោះបង់',
                background: '#f8f9fa'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

    </script>

    @yield('scripts')
    @push('scripts')
    @stack('scripts')

    
</body>

</html>
