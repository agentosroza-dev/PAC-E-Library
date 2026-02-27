<template>
    <div class="min-h-screen bg-base-100">
        <!-- Page Header -->
        <div class="bg-base-200 shadow-sm border-b border-base-300 m-4 rounded-xl">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-3xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                            About Us
                        </h3>
                        <p class="text-base-content/70 text-sm mt-1">
                            Learn more about our mission, team, and story
                        </p>
                    </div>
                    <div class="text-sm breadcrumbs">
                        <ul>
                            <li>
                                <router-link :to="{ name: 'home' }" class="link link-hover flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                    </svg>
                                    Home
                                </router-link>
                            </li>
                            <li class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                About
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="relative rounded-2xl overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-secondary/20"></div>
                <div class="relative bg-base-200 p-12 text-center">
                    <h1 class="text-5xl font-bold mb-4 bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                        {{ $t('appname') }}
                    </h1>
                    <p class="text-xl text-base-content/70 max-w-2xl mx-auto">
                        Building innovative solutions to make the world a better place, one line of code at a time.
                    </p>
                    <div class="flex gap-4 justify-center mt-8">
                        <button class="btn btn-primary">Join Our Team</button>
                        <button class="btn btn-outline btn-primary">Contact Us</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mission & Vision -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Mission Card -->
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-3 bg-primary/10 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold">Our Mission</h2>
                        </div>
                        <p class="text-base-content/80 leading-relaxed">
                            To empower individuals and businesses through innovative technology solutions that simplify complexity, enhance productivity, and foster meaningful connections in an increasingly digital world.
                        </p>
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Innovation driven development</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>User-centric approach</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Sustainable growth</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Card -->
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-3 bg-secondary/10 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold">Our Vision</h2>
                        </div>
                        <p class="text-base-content/80 leading-relaxed">
                            To become the global leader in creating seamless digital experiences that bridge the gap between technology and humanity, making advanced solutions accessible to everyone.
                        </p>
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Global accessibility</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Continuous innovation</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                <span>Digital inclusion</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4 text-center">
                    <div class="stat-value text-3xl text-primary">5+</div>
                    <div class="stat-title">Years of Experience</div>
                </div>
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4 text-center">
                    <div class="stat-value text-3xl text-secondary">50+</div>
                    <div class="stat-title">Team Members</div>
                </div>
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4 text-center">
                    <div class="stat-value text-3xl text-accent">200+</div>
                    <div class="stat-title">Projects Completed</div>
                </div>
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4 text-center">
                    <div class="stat-value text-3xl text-info">1K+</div>
                    <div class="stat-title">Happy Clients</div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold mb-4">Meet Our Team</h2>
                <p class="text-base-content/70 max-w-2xl mx-auto">
                    Passionate experts dedicated to delivering exceptional results
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Team Member 1 -->
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:scale-105 transition-transform">
                    <figure class="px-6 pt-6">
                        <div class="avatar">
                            <div class="w-32 h-32 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                                <img src="https://api.dicebear.com/9.x/avataaans/svg?seed=john" alt="Team member" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">John Doe</h3>
                        <p class="text-sm text-primary font-semibold">CEO & Founder</p>
                        <p class="text-sm text-base-content/70">10+ years in tech leadership</p>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-circle btn-xs btn-outline btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.509.5.902 1.105 1.153 1.772.248.637.415 1.363.465 2.428.05 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.217 1.79-.465 2.428a4.883 4.883 0 01-1.153 1.772c-.5.509-1.105.902-1.772 1.153-.637.248-1.363.415-2.428.465-1.066.05-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.217-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.904 4.904 0 01-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.897 4.897 0 015.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm6.5-.25a1.25 1.25 0 10-2.5 0 1.25 1.25 0 002.5 0zM12 9a3 3 0 110 6 3 3 0 010-6z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.204 0 22.225 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:scale-105 transition-transform">
                    <figure class="px-6 pt-6">
                        <div class="avatar">
                            <div class="w-32 h-32 rounded-full ring ring-secondary ring-offset-base-100 ring-offset-2">
                                <img src="https://api.dicebear.com/9.x/avataaans/svg?seed=jane" alt="Team member" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Jane Smith</h3>
                        <p class="text-sm text-secondary font-semibold">CTO</p>
                        <p class="text-sm text-base-content/70">Tech architect & innovator</p>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-circle btn-xs btn-outline btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.509.5.902 1.105 1.153 1.772.248.637.415 1.363.465 2.428.05 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.217 1.79-.465 2.428a4.883 4.883 0 01-1.153 1.772c-.5.509-1.105.902-1.772 1.153-.637.248-1.363.415-2.428.465-1.066.05-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.217-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.904 4.904 0 01-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.897 4.897 0 015.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm6.5-.25a1.25 1.25 0 10-2.5 0 1.25 1.25 0 002.5 0zM12 9a3 3 0 110 6 3 3 0 010-6z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.204 0 22.225 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:scale-105 transition-transform">
                    <figure class="px-6 pt-6">
                        <div class="avatar">
                            <div class="w-32 h-32 rounded-full ring ring-accent ring-offset-base-100 ring-offset-2">
                                <img src="https://api.dicebear.com/9.x/avataaans/svg?seed=mike" alt="Team member" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Mike Johnson</h3>
                        <p class="text-sm text-accent font-semibold">Lead Developer</p>
                        <p class="text-sm text-base-content/70">Full-stack expert</p>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-circle btn-xs btn-outline btn-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.509.5.902 1.105 1.153 1.772.248.637.415 1.363.465 2.428.05 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.217 1.79-.465 2.428a4.883 4.883 0 01-1.153 1.772c-.5.509-1.105.902-1.772 1.153-.637.248-1.363.415-2.428.465-1.066.05-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.217-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.904 4.904 0 01-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.897 4.897 0 015.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm6.5-.25a1.25 1.25 0 10-2.5 0 1.25 1.25 0 002.5 0zM12 9a3 3 0 110 6 3 3 0 010-6z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.204 0 22.225 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:scale-105 transition-transform">
                    <figure class="px-6 pt-6">
                        <div class="avatar">
                            <div class="w-32 h-32 rounded-full ring ring-info ring-offset-base-100 ring-offset-2">
                                <img src="https://api.dicebear.com/9.x/avataaans/svg?seed=sarah" alt="Team member" />
                            </div>
                        </div>
                    </figure>
                    <div class="card-body items-center text-center">
                        <h3 class="card-title text-xl">Sarah Williams</h3>
                        <p class="text-sm text-info font-semibold">UX Director</p>
                        <p class="text-sm text-base-content/70">Design thinking advocate</p>
                        <div class="flex gap-2 mt-2">
                            <button class="btn btn-circle btn-xs btn-outline btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153.509.5.902 1.105 1.153 1.772.248.637.415 1.363.465 2.428.05 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.217 1.79-.465 2.428a4.883 4.883 0 01-1.153 1.772c-.5.509-1.105.902-1.772 1.153-.637.248-1.363.415-2.428.465-1.066.05-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.217-2.428-.465a4.89 4.89 0 01-1.772-1.153 4.904 4.904 0 01-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 011.153-1.772A4.897 4.897 0 015.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 100 10 5 5 0 000-10zm6.5-.25a1.25 1.25 0 10-2.5 0 1.25 1.25 0 002.5 0zM12 9a3 3 0 110 6 3 3 0 010-6z"/>
                                </svg>
                            </button>
                            <button class="btn btn-circle btn-xs btn-outline btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.204 0 22.225 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Timeline Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold mb-4">Our Journey</h2>
                <p class="text-base-content/70 max-w-2xl mx-auto">
                    Key milestones that shaped our story
                </p>
            </div>

            <div class="relative">
                <!-- Timeline Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-primary to-secondary"></div>

                <div class="space-y-12">
                    <!-- Timeline Item 1 -->
                    <div class="flex items-center w-full">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-base-200 p-6 rounded-xl shadow-lg border border-base-300">
                                <span class="badge badge-primary mb-2">2020</span>
                                <h3 class="font-bold text-lg">Company Founded</h3>
                                <p class="text-sm text-base-content/70">Started with a vision to transform digital experiences</p>
                            </div>
                        </div>
                        <div class="relative flex items-center justify-center w-10">
                            <div class="w-4 h-4 bg-primary rounded-full ring-4 ring-base-100"></div>
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>

                    <!-- Timeline Item 2 -->
                    <div class="flex items-center w-full">
                        <div class="w-1/2 pr-8"></div>
                        <div class="relative flex items-center justify-center w-10">
                            <div class="w-4 h-4 bg-secondary rounded-full ring-4 ring-base-100"></div>
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-base-200 p-6 rounded-xl shadow-lg border border-base-300">
                                <span class="badge badge-secondary mb-2">2021</span>
                                <h3 class="font-bold text-lg">First 100 Clients</h3>
                                <p class="text-sm text-base-content/70">Reached milestone of serving 100+ happy clients</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Item 3 -->
                    <div class="flex items-center w-full">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-base-200 p-6 rounded-xl shadow-lg border border-base-300">
                                <span class="badge badge-accent mb-2">2022</span>
                                <h3 class="font-bold text-lg">Team Expansion</h3>
                                <p class="text-sm text-base-content/70">Grew to 50+ talented team members</p>
                            </div>
                        </div>
                        <div class="relative flex items-center justify-center w-10">
                            <div class="w-4 h-4 bg-accent rounded-full ring-4 ring-base-100"></div>
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>

                    <!-- Timeline Item 4 -->
                    <div class="flex items-center w-full">
                        <div class="w-1/2 pr-8"></div>
                        <div class="relative flex items-center justify-center w-10">
                            <div class="w-4 h-4 bg-info rounded-full ring-4 ring-base-100"></div>
                        </div>
                        <div class="w-1/2 pl-8">
                            <div class="bg-base-200 p-6 rounded-xl shadow-lg border border-base-300">
                                <span class="badge badge-info mb-2">2023</span>
                                <h3 class="font-bold text-lg">International Recognition</h3>
                                <p class="text-sm text-base-content/70">Received industry awards for innovation</p>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Item 5 -->
                    <div class="flex items-center w-full">
                        <div class="w-1/2 pr-8 text-right">
                            <div class="bg-base-200 p-6 rounded-xl shadow-lg border border-base-300">
                                <span class="badge badge-success mb-2">2024</span>
                                <h3 class="font-bold text-lg">Global Expansion</h3>
                                <p class="text-sm text-base-content/70">Launched services in 10+ countries</p>
                            </div>
                        </div>
                        <div class="relative flex items-center justify-center w-10">
                            <div class="w-4 h-4 bg-success rounded-full ring-4 ring-base-100"></div>
                        </div>
                        <div class="w-1/2 pl-8"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-bold mb-4">Our Core Values</h2>
                <p class="text-base-content/70 max-w-2xl mx-auto">
                    Principles that guide everything we do
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card bg-base-200 shadow-xl border border-base-300 hover:shadow-2xl transition-all">
                    <div class="card-body items-center text-center">
                        <div class="p-4 bg-primary/10 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-xl">Innovation</h3>
                        <p class="text-sm text-base-content/70">Constantly pushing boundaries to create cutting-edge solutions</p>
                    </div>
                </div>

                <div class="card bg-base-200 shadow-xl border border-base-300 hover:shadow-2xl transition-all">
                    <div class="card-body items-center text-center">
                        <div class="p-4 bg-secondary/10 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                        </div>
                        <h3 class="card-title text-xl">Collaboration</h3>
                        <p class="text-sm text-base-content/70">Working together to achieve extraordinary results</p>
                    </div>
                </div>

                <div class="card bg-base-200 shadow-xl border border-base-300 hover:shadow-2xl transition-all">
                    <div class="card-body items-center text-center">
                        <div class="p-4 bg-accent/10 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="card-title text-xl">Integrity</h3>
                        <p class="text-sm text-base-content/70">Honest, transparent, and ethical in all we do</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="container mx-auto px-4 py-12">
            <div class="bg-base-200 rounded-2xl shadow-xl border border-base-300 p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold mb-2">Get in Touch</h2>
                    <p class="text-base-content/70">We'd love to hear from you</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col items-center gap-2">
                        <div class="p-3 bg-primary/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <h3 class="font-bold">Email</h3>
                        <p class="text-sm text-base-content/70">hello@company.com</p>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <div class="p-3 bg-secondary/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                        </div>
                        <h3 class="font-bold">Phone</h3>
                        <p class="text-sm text-base-content/70">+1 (555) 123-4567</p>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <div class="p-3 bg-accent/10 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="font-bold">Office</h3>
                        <p class="text-sm text-base-content/70">123 Tech Street, Silicon Valley, CA</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'

const store = useStore()
const userData = computed(() => store.state.user || {})
</script>
