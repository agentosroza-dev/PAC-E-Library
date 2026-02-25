<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ចូលប្រើប្រាស់ប្រព័ន្ធ | EduManage</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts - Khmer -->
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        * {
            font-family: 'Kantumruy Pro', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 1rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background elements
        body::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -250px;
            left: -250px;
            animation: float 20s infinite ease-in-out;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -300px;
            right: -300px;
            animation: float 25s infinite ease-in-out reverse;
            z-index: 0;
        } */

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(50px, 50px) scale(1.1);
            }
            50% {
                transform: translate(0, 100px) scale(0.9);
            }
            75% {
                transform: translate(-50px, 50px) scale(1.05);
            }
        }

        /* Floating shapes */
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            right: 5%;
            animation: float 18s infinite;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: 15%;
            left: 5%;
            animation: float 15s infinite reverse;
        }

        .shape-3 {
            width: 400px;
            height: 400px;
            top: 40%;
            right: 15%;
            animation: float 22s infinite;
        }

        /* Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            z-index: 10;
            position: relative;
            overflow: hidden;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.3);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
            pointer-events: none;
        }

        .login-card:hover::before {
            left: 100%;
        }

        /* Logo */
        .logo-wrapper {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .logo-wrapper i {
            font-size: 2.5rem;
            color: white;
        }

        /* Form Controls */
        .form-control-custom {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            transition: all 0.3s ease;
            height: 50px;
        }

        .form-control-custom:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            z-index: 10;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        /* Password toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        /* Checkbox */
        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        /* Button */
        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-login:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Alert */
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            animation: slideInRight 0.5s ease;
        }

        .alert-success-custom {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Loading spinner */
        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin: 0 auto;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-login.loading .btn-text {
            display: none;
        }

        .btn-login.loading .spinner {
            display: inline-block;
        }

        /* Links */
        .link-custom {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .link-custom:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Footer */
        .footer-text {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 1.5rem !important;
            }

            .logo-wrapper {
                width: 60px;
                height: 60px;
            }

            .logo-wrapper i {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            .shape-1, .shape-2, .shape-3 {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Animated background shapes -->
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <!-- Logo above card -->
                <div class="text-center mb-4 animate__animated animate__fadeInDown">
                    <div class="logo-wrapper">
                        <i class="bi bi-book-half"></i>
                    </div>
                </div>

                <!-- Login Card -->
                <div class="login-card p-4 p-lg-5 animate__animated animate__fadeInUp">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark mb-2">សូមស្វាគមន៍</h2>
                        <p class="text-muted">ចូលប្រើប្រាស់ប្រព័ន្ធគ្រប់គ្រង</p>
                    </div>

                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert-custom alert-success-custom alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                                <span>{{ session('success') }}</span>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert-custom alert-danger-custom alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                                <span>{{ session('error') }}</span>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert-custom alert-danger-custom alert-dismissible fade show mb-4" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="bi bi-exclamation-circle-fill me-2 fs-5 mt-1"></i>
                                <div>
                                    <strong class="d-block mb-1">សូមពិនិត្យមើលកំហុសខាងក្រោម៖</strong>
                                    <ul class="mb-0 ps-3">
                                        @foreach($errors->all() as $error)
                                            <li class="small">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <!-- Email Field -->
                        <div class="form-group">
                            <i class="bi bi-envelope-fill input-icon"></i>
                            <input type="email"
                                   class="form-control form-control-custom @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="អ៊ីមែល"
                                   required
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password"
                                   class="form-control form-control-custom @error('password') is-invalid @enderror"
                                   name="password"
                                   id="password"
                                   placeholder="ពាក្យសម្ងាត់"
                                   required>
                            <i class="bi bi-eye password-toggle" id="togglePassword" onclick="togglePassword()"></i>
                            @error('password')
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-muted" for="remember">
                                    ចងចាំខ្ញុំ
                                </label>
                            </div>
                            {{-- <a href="{{ route('password.request') }}" class="link-custom small"> --}}
                                ភ្លេចពាក្យសម្ងាត់?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-login w-100" id="submitBtn">
                            <span class="btn-text">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                ចូលប្រើប្រាស់
                            </span>
                            <span class="spinner"></span>
                        </button>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <span class="text-muted">មិនទាន់មានគណនី?</span>
                            {{-- <a href="{{ route('register') }}" class="link-custom ms-1"> --}}
                                ចុះឈ្មោះ
                            </a>
                        </div>
                    </form>

                    <!-- Social Login (Optional) -->
                    <div class="text-center mt-4">
                        <p class="text-muted small mb-3">ឬចូលប្រើជាមួយ</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="#" class="btn btn-outline-secondary rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="bi bi-google"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary rounded-circle p-2" style="width: 40px; height: 40px;">
                                <i class="bi bi-github"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-4 footer-text">
                    <small>
                        <i class="bi bi-c-circle me-1"></i>
                        {{ date('Y') }} EduManage. រក្សាសិទ្ធិគ្រប់យ៉ាង។
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }

        // Form submission with loading state
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;

            // Basic validation
            if (!email || !password) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'សូមបំពេញព័ត៌មាន',
                    text: 'សូមបញ្ចូលអ៊ីមែល និងពាក្យសម្ងាត់',
                    confirmButtonColor: '#667eea',
                    background: '#f8f9fa'
                });
                return;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert-custom').forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // Add floating effect to shapes on mouse move
        document.addEventListener('mousemove', function(e) {
            const shapes = document.querySelectorAll('.shape');
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;

            shapes.forEach((shape, index) => {
                const speed = 20 + (index * 10);
                const x = (mouseX * speed) - (speed / 2);
                const y = (mouseY * speed) - (speed / 2);
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
</body>
</html>
