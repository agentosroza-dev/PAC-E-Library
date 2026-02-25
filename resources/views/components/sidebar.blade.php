        <!-- Sidebar (បង្ហាញតែពេល Login រួច) -->
        <nav class="sidebar" id="sidebar">
            <!-- User Profile Section (Desktop & Mobile) -->
            <div class="user-profile-section p-4 mb-3">
                <div class="d-flex align-items-center gap-3">
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

                        @if ($hasPhoto)
                            <!-- បង្ហាញរូបភាពប្រសិនបើមាន -->
                            <img src="{{ $photoUrl }}" alt="{{ $user->name ?? 'User' }}"
                                class="rounded-circle shadow-lg"
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
                                                    $initials = strtoupper(
                                                        substr($nameParts[0], 0, 1) .
                                                            substr($nameParts[count($nameParts) - 1], 0, 1),
                                                    );
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

                    <!-- User Info -->
                    <div class="user-info">
                        <h6 class="fw-bold mb-1 text-dark">
                            @auth
                                {{ Auth::user()->name ?? 'អ្នកប្រើប្រាស់' }}
                            @endauth
                        </h6>
                        <small class="text-muted d-block mb-2">
                            {{-- <i class="fas fa-envelope me-1" style="font-size: 0.7rem;"></i> --}}
                            @auth
                                {{ Auth::user()->email ?? '' }}
                            @endauth
                        </small>
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill">
                            <i class="fas fa-shield-alt me-1" style="font-size: 0.7rem;"></i>
                            {{ Auth::user()->level ?? 'អ្នកប្រើប្រាសធម្មតា' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Search in Sidebar -->
            <div class="px-3 mb-4">
                <div class="search-wrapper position-relative">
                    <i class="fas fa-search search-icon position-absolute top-50 translate-middle-y text-muted"
                        style="left: 15px; z-index: 10;"></i>
                    <input type="text" class="form-control form-control-sm rounded-pill border-0 bg-light py-2 ps-5"
                        placeholder="ស្វែងរកម៉ឺនុយ..." id="sidebarSearch" autocomplete="off">
                    <button type="button"
                        class="btn btn-sm btn-link position-absolute top-50 translate-middle-y text-muted"
                        style="right: 10px; display: none;" id="clearSearch">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="search-result-count small text-muted mt-2 px-2" id="searchResultCount"></div>
            </div>

            <!-- Menu Title -->
            <div class="sidebar-header px-4 mb-2">
                <h6 class="text-uppercase fw-bold small text-muted">ម៉ឺនុយមេ</h6>
            </div>

            <!-- Dashboard Menu -->
            <div class="nav-section px-3">
                <!-- Home -->
                <div class="nav-item-custom mb-1">
                    <a href="{{ route('home') }}"
                        class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 {{ request()->routeIs('home') ? 'active bg-gradient-primary text-white' : 'text-dark' }}"
                        data-bs-toggle="tooltip" title="ទំព័រដើម">
                        <i class="fas fa-gauge-high me-3 {{ request()->routeIs('home') ? 'text-white' : 'text-primary' }}"
                            style="width: 20px;"></i>
                        <span class="flex-grow-1">ទំព័រដើម</span>
                        @if (request()->routeIs('home'))
                            <span class="badge bg-white text-primary rounded-pill px-2 py-1">សកម្ម</span>
                        @endif
                    </a>
                </div>

                <!-- PDF Books with Submenu -->
                <div class="nav-item-custom mb-1">
                    <a href="#pdfBooksSubmenu"
                        class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 text-dark collapsed"
                        data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('pdf-books.*') ? 'true' : 'false' }}">
                        <i class="fas fa-file-pdf me-3 text-primary" style="width: 20px;"></i>
                        <span class="flex-grow-1">សៀវភៅ PDF</span>
                        <i class="fas fa-chevron-right ms-auto transition-rotate"></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('pdf-books.*') ? 'show' : '' }}" id="pdfBooksSubmenu">
                        <div class="ps-4 mt-2">
                            <a href="{{ route('pdf-books.index') }}"
                                class="d-block nav-sub-link px-3 py-2 rounded-3 mb-1 {{ request()->routeIs('pdf-books.index') ? 'active bg-light text-primary' : 'text-muted' }}"
                                style="text-decoration: none;">
                                <i class="fas fa-list me-2" style="font-size: 0.8rem;"></i>
                                បញ្ជីសៀវភៅ
                            </a>
                            <a href="{{ route('pdf-books.create') }}"
                                class="d-block nav-sub-link px-3 py-2 rounded-3 mb-1 {{ request()->routeIs('pdf-books.create') ? 'active bg-light text-primary' : 'text-muted' }}"
                                style="text-decoration: none;">
                                <i class="fas fa-plus me-2" style="font-size: 0.8rem;"></i>
                                បន្ថែមថ្មី
                            </a>
                            <a href="{{ route('categories.index') }}"
                                class="d-block nav-sub-link px-3 py-2 rounded-3 mb-1 {{ request()->routeIs('categories.index') ? 'active bg-light text-primary' : 'text-muted' }}"
                                style="text-decoration: none;">
                                <i class="fas fa-plus me-2" style="font-size: 0.8rem;"></i>
                                ប្រភេទសៀវភៅ
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Categories and Major - បង្ហាញតែពេលអ្នកប្រើប្រាស់ជា Admin -->
                @if (Auth::check() && Auth::user()->level === 'admin')

                    <div class="nav-item-custom mb-1">
                        <a href="{{ route('categories.index') }}"
                            class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 {{ request()->routeIs('categories.*') ? 'active bg-gradient-primary text-white' : 'text-dark' }}"
                            data-bs-toggle="tooltip" title="គ្រប់គ្រងប្រភេទ">
                            <i class="fas fa-tags me-3 {{ request()->routeIs('categories.*') ? 'text-white' : 'text-primary' }}"
                                style="width: 20px;"></i>
                            <span class="flex-grow-1">ប្រភេទ</span>

                            <!-- Admin Badge (optional) -->
                            @if (request()->routeIs('categories.*'))
                                <span class="badge bg-white text-primary ms-2 rounded-pill px-2 py-1">
                                    <i class="fas fa-crown me-1" style="font-size: 0.7rem;"></i>
                                    Admin
                                </span>
                            @endif


                        </a>
                    </div>
                @endif

                <!-- Divider -->
                <hr class="my-4 bg-light">

                <!-- System Menu Title -->
                <h6 class="text-uppercase fw-bold small text-muted px-3 mb-2">ប្រព័ន្ធ</h6>

                <!-- Settings with Submenu -->
                <div class="nav-item-custom mb-1">
                    <a href="#settingsSubmenu"
                        class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 text-dark collapsed"
                        data-bs-toggle="collapse">
                        <i class="fas fa-gear me-3 text-primary" style="width: 20px;"></i>
                        <span class="flex-grow-1">ការកំណត់</span>
                        <i class="fas fa-chevron-right ms-auto transition-rotate"></i>
                    </a>
                    <div class="collapse" id="settingsSubmenu">
                        <div class="ps-4 mt-2">
@if (Auth::check() && Auth::user()->level === 'admin')
    <a href="{{ route('users.index') }}" class="d-block nav-sub-link px-3 py-2 rounded-3 mb-1 text-muted {{ request()->routeIs('users.*') ? 'active' : '' }}"
        style="text-decoration: none;">
        <i class="fas fa-users-cog fa-fw me-2" style="font-size: 1rem;"></i>
        គ្រប់គ្រងអ្នកប្រើប្រាស់

        <!-- Admin Badge -->
        @if (request()->routeIs('users.*'))
            <span class="badge bg-white text-primary ms-2 rounded-pill px-2 py-1">
                <i class="fas fa-crown me-1" style="font-size: 0.7rem;"></i>
                Admin
            </span>
        @endif
    </a>
@endif
                            <a href="#" class="d-block nav-sub-link px-3 py-2 rounded-3 mb-1 text-muted"
                                style="text-decoration: none;">
                                <i class="fas fa-shield me-2" style="font-size: 0.8rem;"></i>
                                សុវត្ថិភាព
                            </a>

                            @if (Auth::check() && Auth::user()->level === 'admin')
                            <a href="{{ route('backup.index') }}" class="d-block nav-sub-link px-3 py-2 rounded-3 mb-1 text-muted"
                                style="text-decoration: none;">
                                <i class="fas fa-file-archive fa-fw me-2" style="font-size: 0.8rem;"></i>
                                ទិន្នន័យបម្រុងទុក
                                                            <!-- Admin Badge (optional) -->
                            @if (request()->routeIs('backup.*'))
                                <span class="badge bg-white text-primary ms-2 rounded-pill px-2 py-1">
                                    <i class="fas fa-crown me-1" style="font-size: 0.7rem;"></i>
                                    Admin
                                </span>
                            @endif
                            </a>

                            @endif
                        </div>
                    </div>
                </div>

                <!-- Reports -->
                <div class="nav-item-custom mb-1">
                    <a href="#" class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 text-dark">
                        <i class="fas fa-chart-bar me-3 text-primary" style="width: 20px;"></i>
                        <span class="flex-grow-1">របាយការណ៍</span>
                    </a>
                </div>

                <!-- Theme Switcher -->
                <div class="nav-item-custom mb-1">
                    <a href="#" class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 text-dark"
                        onclick="toggleTheme()">
                        <i class="fas fa-circle-half-stroke me-3 text-primary" style="width: 20px;"></i>
                        <span class="flex-grow-1" id="theme-text">ប្តូររូបរាង</span>
                    </a>
                </div>

                <!-- Logout -->
                <div class="nav-item-custom mt-4 mb-3">
                    <a href="#"
                        class="nav-link-custom d-flex align-items-center px-3 py-2 rounded-3 text-danger"
                        onclick="confirmLogout()">
                        <i class="fas fa-arrow-right-from-bracket me-3" style="width: 20px;"></i>
                        <span class="flex-grow-1">ចាកចេញ</span>
                    </a>
                </div>
            </div>

            <!-- System Info Card -->
            <div class="mt-auto p-3">
                <div class="card bg-gradient-light border-0 rounded-4 shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="progress-circle position-relative" data-progress="70">
                                <svg width="50" height="50" viewBox="0 0 50 50">
                                    <circle cx="25" cy="25" r="20" fill="none" stroke="#e9ecef"
                                        stroke-width="4" />
                                    <circle cx="25" cy="25" r="20" fill="none" stroke="#667eea"
                                        stroke-width="4" stroke-dasharray="125.6" stroke-dashoffset="37.68"
                                        transform="rotate(-90 25 25)" />
                                    <text x="25" y="25" text-anchor="middle" dy="0.3em" fill="#2c3e50"
                                        font-size="10" font-weight="bold">70%</text>
                                </svg>
                            </div>
                            <div>
                                <p class="fw-medium mb-0 small">ទំហំផ្ទុក</p>
                                <small class="text-muted">7GB ក្នុង 10GB</small>
                                <div class="progress mt-2" style="height: 4px;">
                                    <div class="progress-bar bg-gradient-primary" style="width: 70%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Sidebar search functionality
                const searchInput = document.getElementById('sidebarSearch');
                const clearButton = document.getElementById('clearSearch');
                const resultCount = document.getElementById('searchResultCount');

                if (searchInput) {
                    // Get all menu items that should be searchable
                    const menuItems = document.querySelectorAll('.nav-item-custom');
                    const menuLinks = document.querySelectorAll('.nav-link-custom, .nav-sub-link');

                    // Store original display states
                    menuItems.forEach(item => {
                        item.dataset.originalDisplay = item.style.display || 'block';
                    });

                    // Search function
                    function filterMenu(searchTerm) {
                        searchTerm = searchTerm.toLowerCase().trim();
                        let visibleCount = 0;

                        // Show/hide clear button
                        if (clearButton) {
                            clearButton.style.display = searchTerm ? 'block' : 'none';
                        }

                        if (searchTerm === '') {
                            // Show all items
                            menuItems.forEach(item => {
                                item.style.display = 'block';
                            });
                            // Show all sections
                            document.querySelectorAll('.nav-section').forEach(section => {
                                section.style.display = 'block';
                            });
                            if (resultCount) resultCount.innerHTML = '';
                            return;
                        }

                        // Search in menu items
                        menuItems.forEach(item => {
                            const link = item.querySelector('.nav-link-custom');
                            const subLinks = item.querySelectorAll('.nav-sub-link');
                            let itemMatch = false;

                            // Check main link
                            if (link) {
                                const linkText = link.textContent.toLowerCase();
                                if (linkText.includes(searchTerm)) {
                                    itemMatch = true;
                                }
                            }

                            // Check sublinks
                            subLinks.forEach(subLink => {
                                const subLinkText = subLink.textContent.toLowerCase();
                                if (subLinkText.includes(searchTerm)) {
                                    itemMatch = true;
                                    // Expand parent collapse if needed
                                    const parentCollapse = subLink.closest('.collapse');
                                    if (parentCollapse) {
                                        parentCollapse.classList.add('show');
                                        const parentToggle = document.querySelector(
                                            `[href="#${parentCollapse.id}"]`);
                                        if (parentToggle) {
                                            parentToggle.classList.remove('collapsed');
                                            parentToggle.setAttribute('aria-expanded', 'true');
                                        }
                                    }
                                }
                            });

                            // Show/hide item based on match
                            if (itemMatch) {
                                item.style.display = 'block';
                                visibleCount++;
                            } else {
                                item.style.display = 'none';
                            }
                        });

                        // Hide empty sections
                        document.querySelectorAll('.nav-section').forEach(section => {
                            const visibleItems = section.querySelectorAll(
                                '.nav-item-custom[style*="display: block"]');
                            if (visibleItems.length === 0) {
                                section.style.display = 'none';
                            } else {
                                section.style.display = 'block';
                            }
                        });

                        // Update result count
                        if (resultCount) {
                            if (visibleCount === 0) {
                                resultCount.innerHTML =
                                    '<span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>មិនមានម៉ឺនុយដែលត្រូវស្វែងរកទេ</span>';
                            } else {
                                resultCount.innerHTML =
                                    `<span class="text-success"><i class="fas fa-check-circle me-1"></i>ឃើញ ${visibleCount} ម៉ឺនុយ</span>`;
                            }
                        }
                    }

                    // Input event
                    searchInput.addEventListener('input', function(e) {
                        filterMenu(this.value);
                    });

                    // Clear search
                    if (clearButton) {
                        clearButton.addEventListener('click', function() {
                            searchInput.value = '';
                            filterMenu('');
                            searchInput.focus();
                        });
                    }

                    // Handle escape key
                    searchInput.addEventListener('keydown', function(e) {
                        if (e.key === 'Escape') {
                            this.value = '';
                            filterMenu('');
                        }
                    });
                }

                // Initialize tooltips
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Initialize popovers if any
                var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            });
        </script>
