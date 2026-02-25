@props(['active' => '', 'user' => null])
    <nav class="navbar navbar-custom">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center">
                <!-- Mobile Toggle Button -->
                <button class="btn btn-link d-md-none text-dark me-3" id="sidebarToggle">
                    <i class="fas fa-bars fa-xl"></i>
                </button>

                <!-- Logo/Brand -->
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Elibrary Manage</span>
                </a>
            </div>



            <!-- Right Menu -->
            <div class="d-flex align-items-center gap-3">
                @guest
                    <!-- បង្ហាញតែពេលមិនទាន់ Login -->
                    <a href="{{ route('login') }}" class="btn btn-gradient-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        ចូលប្រើប្រាស់
                    </a>
                @else
                    <!-- បង្ហាញតែពេល Login រួច -->
                    <!-- Notifications -->
                    {{-- <div class="dropdown">
                        <button class="btn btn-link text-dark position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-bell fa-xl"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-custom dropdown-menu-end p-3" style="width: 320px;">
                            <h6 class="dropdown-header fs-6 fw-bold">ការជូនដំណឹង</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item dropdown-item-custom py-3" href="#">
                                <div class="d-flex gap-3">
                                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <span>ថ្មី</span>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-medium">និស្សិតថ្មីបានចុះឈ្មោះ</p>
                                        <small class="text-muted">5 នាទីមុន</small>
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item dropdown-item-custom py-3" href="#">
                                <div class="d-flex gap-3">
                                    <div class="avatar bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <span>សំខ</span>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-medium">ការប្រឡងនៅសប្តាហ៍ក្រោយ</p>
                                        <small class="text-muted">1 ម៉ោងមុន</small>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item dropdown-item-custom text-center text-primary" href="#">
                                មើលទាំងអស់
                            </a>
                        </div>
                    </div> --}}

                    <!-- Messages -->
                    {{-- <div class="dropdown">
                        <button class="btn btn-link text-dark position-relative" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-envelope fa-xl"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                5
                            </span>
                        </button>
                    </div> --}}

                    <!-- User Menu -->
                    <div class="dropdown">
                        <button class="btn btn-link text-dark" type="button" data-bs-toggle="dropdown">
                            <div class="avatar bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                                    <!-- User Avatar with dynamic initial and gradient -->
                    <div class="avatar position-relative">
                        @php
                            $user = Auth::user();
                            $hasPhoto = false;
                            $photoUrl = '';

                            // ពិនិត្យមើលថាតើអ្នកប្រើប្រាស់មានរូបភាពឬទេ
                            // ផ្លាស់ប្តូរតាម field name ដែលអ្នកប្រើក្នុង database
                            if ($user) {
                                // ឧទាហរណ៍ ១: ប្រសិនបើប្រើ 'profile_photo' field
                                if (isset($user->profile_photo) && !empty($user->profile_photo)) {
                                    $hasPhoto = true;
                                    $photoUrl = asset('storage/' . $user->profile_photo);
                                }
                                // ឧទាហរណ៍ ២: ប្រសិនបើប្រើ 'avatar' field
                                elseif (isset($user->avatar) && !empty($user->avatar)) {
                                    $hasPhoto = true;
                                    $photoUrl = asset('storage/' . $user->avatar);
                                }
                                // ឧទាហរណ៍ ៣: ប្រសិនបើប្រើ 'image' field
                                elseif (isset($user->image) && !empty($user->image)) {
                                    $hasPhoto = true;
                                    $photoUrl = asset('storage/' . $user->image);
                                } elseif (isset($user->photo) && !empty($user->photo)) {
                                    $hasPhoto = true;
                                    $photoUrl = $user->photo;
                                }
                                // ឧទាហរណ៍ ៤: ប្រសិនបើប្រើ Gravatar
                                else {
                                    // Gravatar
                                    $email = $user->email ?? '';
                                    $hash = md5(strtolower(trim($email)));
                                    $photoUrl = "https://www.gravatar.com/avatar/{$hash}?s=200&d=mp";
                                    $hasPhoto = true;
                                }
                            }
                        @endphp

                        @if($hasPhoto)
                            <!-- បង្ហាញរូបភាពប្រសិនបើមាន -->
                            <img src="{{ $photoUrl }}" alt="{{ $user->name ?? 'User' }}" class="rounded-circle shadow-lg"
                                style="width: 60px; height: 60px; object-fit: cover; border: 3px solid white;">
                        @else
                            <!-- បង្ហាញ Initial ប្រសិនបើគ្មានរូបភាព -->
                            <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-lg"
                                style="width: 60px; height: 60px; background: linear-gradient(135deg, #667eea, #764ba2);">
                                <span class="fw-bold fs-3">
                                    @auth
                                        @php
                                            $name = Auth::user()->name ?? '';
                                            $initials = '';

                                            if (!empty($name)) {
                                                $nameParts = explode(' ', trim($name));
                                                if (count($nameParts) >= 2) {
                                                    $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1));
                                                } else {
                                                    $initials = strtoupper(substr($nameParts[0], 0, 1));
                                                }
                                            } else {
                                                $initials = 'អ';
                                            }
                                        @endphp
                                        {{ $initials }}
                                    @endauth
                                </span>
                            </div>
                        @endif

                        <!-- Online Status Badge -->
                        <span
                            class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                            style="width: 14px; height: 14px;"></span>
                    </div>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header">{{ Auth::user()->name ?? 'អ្នកប្រើប្រាស់' }}</h6>
                                <small class="dropdown-item-text text-muted px-3">{{ Auth::user()->email ?? '' }}</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <i class="fas fa-user"></i>
                                    ប្រវត្តិរូប
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <i class="fas fa-gear"></i>
                                    ការកំណត់
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <i class="fas fa-circle-question"></i>
                                    ជំនួយ
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom text-danger" href="#" onclick="confirmLogout()">
                                    <i class="fas fa-arrow-right-from-bracket"></i>
                                    ចាកចេញ
                                </a>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>

        <!-- Mobile Search (លាក់ប្រសិនបើគ្មានអ្នកប្រើ) -->
        @auth

        @endauth
    </nav>


<!-- Theme Script -->
@push('scripts')
    <script>
        console.log('Run Navbar')

        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        }

        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                document.documentElement.setAttribute('data-theme', savedTheme);
            }
        });
    </script>
@endpush
