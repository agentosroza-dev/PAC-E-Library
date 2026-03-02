<template>
    <div class="min-h-screen bg-base-200">
        <!-- Header Section -->
        <div
            class="bg-base-200 shadow-sm border-b border-base-300 m-4 rounded-xl"
        >
            <div class="container mx-auto px-4 py-4">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4"
                >
                    <div class="flex items-center gap-3 mb-4 md:mb-0">
                        <div>
                            <h4
                                class="text-3xl font-bold bg-gradient-to-r from-error to-secondary bg-clip-text text-transparent"
                            >
                                PDF Books Management
                            </h4>
                            <p class="text-sm opacity-90">
                                Manage your digital library collection
                            </p>
                        </div>
                    </div>
                    <div class="text-sm breadcrumbs">
                        <ul>
                            <li class="flex items-center gap-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                                    />
                                </svg>
                                Dashboard
                            </li>
                            <li class="flex items-center gap-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
                                    />
                                </svg>
                                PDF Books
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            <!-- Stats Cards -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8"
            >
                <div
                    class="stat bg-linear-to-br from-primary to-primary-focus text-primary-content rounded-box shadow-lg hover:scale-105 transition-transform duration-300"
                >
                    <div class="stat-figure text-primary-content">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                            ></path>
                        </svg>
                    </div>
                    <div class="stat-title text-primary-content opacity-80">
                        Total Books
                    </div>
                    <div class="stat-value">{{ stats.totalBooks }}</div>
                    <div class="stat-desc text-primary-content opacity-80">
                        ↗︎ {{ stats.activeBooks }} active
                    </div>
                </div>

                <div
                    class="stat bg-linear-to-br from-success to-success-focus text-success-content rounded-box shadow-lg hover:scale-105 transition-transform duration-300"
                >
                    <div class="stat-figure text-success-content">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                            ></path>
                        </svg>
                    </div>
                    <div class="stat-title text-success-content opacity-80">
                        Active Books
                    </div>
                    <div class="stat-value">{{ stats.activeBooks }}</div>
                    <div class="stat-desc text-success-content opacity-80">
                        {{
                            (
                                (stats.activeBooks / stats.totalBooks) * 100 ||
                                0
                            ).toFixed(1)
                        }}% of total
                    </div>
                </div>

                <div
                    class="stat bg-linear-to-br from-warning to-warning-focus text-warning-content rounded-box shadow-lg hover:scale-105 transition-transform duration-300"
                >
                    <div class="stat-figure text-warning-content">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                            ></path>
                        </svg>
                    </div>
                    <div class="stat-title text-warning-content opacity-80">
                        Total Downloads
                    </div>
                    <div class="stat-value">
                        {{ formatNumber(stats.totalDownloads) }}
                    </div>
                    <div class="stat-desc text-warning-content opacity-80">
                        ↗︎
                        {{
                            (
                                stats.totalDownloads /
                                    (stats.totalBooks || 1) || 0
                            ).toFixed(1)
                        }}
                        avg per book
                    </div>
                </div>

                <div
                    class="stat bg-linear-to-br from-error to-error-focus text-error-content rounded-box shadow-lg hover:scale-105 transition-transform duration-300"
                >
                    <div class="stat-figure text-error-content">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block w-8 h-8 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"
                            ></path>
                        </svg>
                    </div>
                    <div class="stat-title text-error-content opacity-80">
                        Categories
                    </div>
                    <div class="stat-value">{{ stats.categories }}</div>
                    <div class="stat-desc text-error-content opacity-80">
                        {{
                            (
                                stats.totalBooks / (stats.categories || 1) || 0
                            ).toFixed(1)
                        }}
                        books per category
                    </div>
                </div>
            </div>

            <!-- Filter Card -->
            <div
                class="card bg-base-100 shadow-xl mb-8 hover:shadow-2xl transition-shadow duration-300"
            >
                <div class="card-body">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="card-title">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-6 h-6 stroke-current"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                                ></path>
                            </svg>
                            Filter & Search
                        </h2>
                        <button
                            class="btn btn-ghost btn-sm hover:bg-base-300 transition-colors duration-300"
                            @click="toggleFilterCollapse"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-4 h-4 stroke-current"
                                :class="{ 'rotate-180': !filterCollapsed }"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Filter Content - Use v-show for better performance -->
                    <div v-show="!filterCollapsed" class="filter-content">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Category Filter -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="w-4 h-4 inline-block mr-1 stroke-current"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                                            ></path>
                                        </svg>
                                        Category
                                    </span>
                                </label>
                                <select
                                    class="select select-bordered w-full hover:border-primary transition-colors duration-300"
                                    v-model="filters.category_id"
                                    @change="onFilterChange"
                                >
                                    <option value="">All Categories</option>
                                    <option
                                        v-for="cat in categories"
                                        :key="cat.id"
                                        :value="cat.id"
                                    >
                                        {{ cat.title }}
                                    </option>
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="w-4 h-4 inline-block mr-1 stroke-current"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                            ></path>
                                        </svg>
                                        Status
                                    </span>
                                </label>
                                <select
                                    class="select select-bordered w-full hover:border-primary transition-colors duration-300"
                                    v-model="filters.status"
                                    @change="onFilterChange"
                                >
                                    <option value="">All Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <!-- Search Input -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="w-4 h-4 inline-block mr-1 stroke-current"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                            ></path>
                                        </svg>
                                        Search
                                    </span>
                                </label>
                                <div class="join">
                                    <input
                                        type="text"
                                        class="input input-bordered join-item w-full hover:border-primary transition-colors duration-300"
                                        v-model="filters.search"
                                        placeholder="Search by title or description..."
                                        @keyup.enter="applyFilters"
                                        @input="debouncedSearch"
                                    />
                                    <button
                                        class="btn btn-primary join-item hover:scale-105 transition-transform duration-300"
                                        @click="applyFilters"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            class="w-4 h-4 stroke-current"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                            ></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4 gap-2">
                            <button
                                class="btn btn-ghost btn-sm hover:bg-base-300 transition-colors duration-300"
                                @click="resetFilters"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-1 stroke-current"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                    ></path>
                                </svg>
                                Reset Filters
                            </button>
                            <button
                                class="btn btn-primary btn-sm hover:scale-105 transition-transform duration-300"
                                @click="applyFilters"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="w-4 h-4 mr-1 stroke-current"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                    ></path>
                                </svg>
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Filters Display -->
            <div
                v-if="hasActiveFilters"
                class="flex flex-wrap gap-2 mb-4 animate-fadeIn"
            >
                <span class="text-sm opacity-70 mr-2">Active filters:</span>
                <div
                    v-if="filters.category_id"
                    class="badge badge-info gap-1 hover:scale-105 transition-transform duration-300"
                >
                    Category: {{ getCategoryName(filters.category_id) }}
                    <button
                        class="ml-1 hover:text-error transition-colors duration-300"
                        @click="removeFilter('category_id')"
                    >
                        ✕
                    </button>
                </div>
                <div
                    v-if="filters.status !== ''"
                    class="badge badge-info gap-1 hover:scale-105 transition-transform duration-300"
                >
                    Status: {{ filters.status === "1" ? "Active" : "Inactive" }}
                    <button
                        class="ml-1 hover:text-error transition-colors duration-300"
                        @click="removeFilter('status')"
                    >
                        ✕
                    </button>
                </div>
                <div
                    v-if="filters.search"
                    class="badge badge-info gap-1 hover:scale-105 transition-transform duration-300"
                >
                    Search: "{{ filters.search }}"
                    <button
                        class="ml-1 hover:text-error transition-colors duration-300"
                        @click="removeFilter('search')"
                    >
                        ✕
                    </button>
                </div>
                <button
                    class="badge badge-ghost gap-1 cursor-pointer hover:bg-base-300 hover:scale-105 transition-all duration-300"
                    @click="resetFilters"
                >
                    Clear all
                </button>
            </div>

            <!-- Books Table Card -->
            <div
                class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300"
            >
                <div class="card-body p-0">
                    <div class="flex justify-between items-center p-6 pb-0">
                        <h2 class="card-title">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-6 h-6 stroke-current"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                ></path>
                            </svg>
                            Books List
                        </h2>
                        <button
                            class="btn btn-primary hover:scale-105 transition-transform duration-300"
                            @click="showBookModal"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-4 h-4 mr-2 stroke-current"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 4v16m8-8H4"
                                ></path>
                            </svg>
                            Add New Book
                        </button>
                    </div>

                    <!-- Loading State -->
                    <div
                        v-if="loading"
                        class="flex justify-center items-center py-12"
                    >
                        <span
                            class="loading loading-spinner loading-lg text-primary"
                        ></span>
                    </div>

                    <!-- Books Table -->
                    <div v-else class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Version</th>
                                    <th>Uploader</th>
                                    <th>Status</th>
                                    <th>Downloads</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(book, index) in books"
                                    :key="book.id"
                                    class="group hover:bg-base-300 hover:shadow-lg transition-all duration-300 cursor-pointer"
                                    :class="{ 'opacity-60': !book.status }"
                                    @click="viewBook(book.id)"
                                >
                                    <td
                                        class="group-hover:text-primary transition-colors duration-300"
                                    >
                                        {{ getSerialNumber(index) }}
                                    </td>
                                    <td>
                                        <div class="avatar">
                                            <div
                                                class="w-12 h-16 rounded group-hover:scale-110 transition-transform duration-300"
                                            >
                                                <img
                                                    :src="
                                                        book.image_url ||
                                                        'https://via.placeholder.com/50x70?text=No+Cover'
                                                    "
                                                    :alt="book.title"
                                                    class="object-cover"
                                                />
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="font-bold group-hover:text-primary transition-colors duration-300"
                                        >
                                            {{ book.title }}
                                        </div>
                                        <div
                                            class="text-sm opacity-50 group-hover:opacity-100 transition-opacity duration-300"
                                        >
                                            {{
                                                truncateText(
                                                    book.description,
                                                    50,
                                                )
                                            }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="badge badge-info gap-1 group-hover:scale-105 transition-transform duration-300"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                class="w-3 h-3 stroke-current"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                                                ></path>
                                            </svg>
                                            {{ book.category?.title || "N/A" }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="badge badge-ghost group-hover:scale-105 transition-transform duration-300"
                                        >
                                            v{{ book.version || "1.0" }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1">
                                            <!-- <div class="avatar placeholder">
                        <div class="bg-neutral text-neutral-content rounded-full w-6 h-6 group-hover:scale-110 transition-transform duration-300">
                          <span class="text-xs">{{ getInitials(book.uploader?.name) }}</span>
                        </div>
                      </div> -->
                                            <span
                                                class="text-sm group-hover:text-primary transition-colors duration-300"
                                                >{{
                                                    book.uploader?.name ||
                                                    "Unknown"
                                                }}</span
                                            >
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            :class="`badge badge-${book.status ? 'success' : 'error'} gap-1 group-hover:scale-105 transition-transform duration-300`"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                class="w-3 h-3 stroke-current"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    :d="
                                                        book.status
                                                            ? 'M5 13l4 4L19 7'
                                                            : 'M6 18L18 6M6 6l12 12'
                                                    "
                                                ></path>
                                            </svg>
                                            {{
                                                book.status
                                                    ? "Active"
                                                    : "Inactive"
                                            }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="badge badge-primary gap-1 group-hover:scale-105 transition-transform duration-300"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                class="w-3 h-3 stroke-current"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                                ></path>
                                            </svg>
                                            {{
                                                formatNumber(
                                                    book.downloads || 0,
                                                )
                                            }}
                                        </div>
                                    </td>
                                    <td>
                                        <div
                                            class="text-sm group-hover:text-primary transition-colors duration-300"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                class="w-3 h-3 inline mr-1 stroke-current"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                ></path>
                                            </svg>
                                            {{
                                                formatDate(
                                                    book.created_at,
                                                    "short",
                                                )
                                            }}
                                        </div>
                                    </td>
                                    <td @click.stop>
                                        <!-- Prevent row click when clicking buttons -->
                                        <div class="join">
                                            <button
                                                class="btn btn-xs btn-info join-item hover:scale-110 transition-transform duration-300"
                                                @click="viewBook(book.id)"
                                                title="View/Edit"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    class="w-4 h-4 stroke-current"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                    ></path>
                                                </svg>
                                            </button>
                                            <button
                                                class="btn btn-xs btn-primary join-item hover:scale-110 transition-transform duration-300"
                                                @click="downloadBook(book.id)"
                                                title="Download"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    class="w-4 h-4 stroke-current"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                                    ></path>
                                                </svg>
                                            </button>
                                            <button
                                                :class="`btn btn-xs btn-${book.status ? 'warning' : 'success'} join-item hover:scale-110 transition-transform duration-300`"
                                                @click="toggleStatus(book.id)"
                                                :title="
                                                    book.status
                                                        ? 'Deactivate'
                                                        : 'Activate'
                                                "
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    class="w-4 h-4 stroke-current"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        :d="
                                                            book.status
                                                                ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636'
                                                                : 'M13 10V3L4 14h7v7l9-11h-7z'
                                                        "
                                                    ></path>
                                                </svg>
                                            </button>
                                            <button
                                                class="btn btn-xs btn-error join-item hover:scale-110 transition-transform duration-300"
                                                @click="removeBook(book.id)"
                                                title="Delete"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    class="w-4 h-4 stroke-current"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="books.length === 0 && !loading">
                                    <td colspan="10" class="text-center py-12">
                                        <div class="flex flex-col items-center">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                class="w-16 h-16 stroke-current text-base-300 mb-4"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                                ></path>
                                            </svg>
                                            <h3
                                                class="text-lg font-semibold text-base-content opacity-50"
                                            >
                                                No Books Found
                                            </h3>
                                            <p
                                                class="text-sm text-base-content opacity-30"
                                            >
                                                Click "Add New Book" to create
                                                your first book.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div
                        class="flex justify-between items-center p-6"
                        v-if="pagination && pagination.total > 0"
                    >
                        <div class="text-sm opacity-70">
                            Showing {{ pagination.from || 0 }} to
                            {{ pagination.to || 0 }} of
                            {{ pagination.total || 0 }} entries
                        </div>
                        <div class="join">
                            <button
                                class="join-item btn btn-sm hover:scale-110 transition-transform duration-300"
                                :disabled="pagination.current_page === 1"
                                @click="changePage(pagination.current_page - 1)"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="w-4 h-4 stroke-current"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 19l-7-7 7-7"
                                    ></path>
                                </svg>
                            </button>
                            <button
                                class="join-item btn btn-sm"
                                v-for="page in pagination.last_page"
                                :key="page"
                                :class="{
                                    'btn-active':
                                        page === pagination.current_page,
                                    'hover:scale-110 transition-transform duration-300':
                                        page !== pagination.current_page,
                                }"
                                @click="changePage(page)"
                            >
                                {{ page }}
                            </button>
                            <button
                                class="join-item btn btn-sm hover:scale-110 transition-transform duration-300"
                                :disabled="
                                    pagination.current_page ===
                                    pagination.last_page
                                "
                                @click="changePage(pagination.current_page + 1)"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    class="w-4 h-4 stroke-current"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    ></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Book Modal (DaisyUI Modal) -->
        <dialog ref="bookModal" class="modal">
            <div class="modal-box w-11/12 max-w-5xl">
                <form method="dialog">
                    <button
                        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2 hover:rotate-90 transition-transform duration-300"
                        @click="hideBookModal"
                    >
                        ✕
                    </button>
                </form>

                <h3 class="font-bold text-lg mb-4">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        class="w-5 h-5 inline mr-2 stroke-current"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            :d="
                                bookObject.id
                                    ? 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'
                                    : 'M12 4v16m8-8H4'
                            "
                        ></path>
                    </svg>
                    {{ bookObject.id ? "Edit" : "Create New" }} PDF Book
                </h3>

                <form
                    @submit.prevent="
                        bookObject.id ? updateBook() : createBook()
                    "
                    enctype="multipart/form-data"
                >
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left Column - Main Form -->
                        <div class="md:col-span-2 space-y-4">
                            <!-- Title -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">
                                        Title <span class="text-error">*</span>
                                    </span>
                                </label>
                                <input
                                    type="text"
                                    class="input input-bordered w-full hover:border-primary transition-colors duration-300"
                                    :class="{
                                        'input-error': bookObjectErr.title,
                                    }"
                                    v-model="bookObject.title"
                                    placeholder="Enter book title"
                                />
                                <label class="label" v-if="bookObjectErr.title">
                                    <span class="label-text-alt text-error">{{
                                        bookObjectErr.title
                                    }}</span>
                                </label>
                            </div>

                            <!-- Category & Version -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium">
                                            Category
                                            <span class="text-error">*</span>
                                        </span>
                                    </label>
                                    <select
                                        class="select select-bordered w-full hover:border-primary transition-colors duration-300"
                                        :class="{
                                            'select-error':
                                                bookObjectErr.category_id,
                                        }"
                                        v-model="bookObject.category_id"
                                    >
                                        <option value="">
                                            Select Category
                                        </option>
                                        <option
                                            v-for="cat in categories"
                                            :key="cat.id"
                                            :value="cat.id"
                                        >
                                            {{ cat.title }}
                                        </option>
                                    </select>
                                    <label
                                        class="label"
                                        v-if="bookObjectErr.category_id"
                                    >
                                        <span
                                            class="label-text-alt text-error"
                                            >{{
                                                bookObjectErr.category_id
                                            }}</span
                                        >
                                    </label>
                                </div>

                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text font-medium"
                                            >Version</span
                                        >
                                    </label>
                                    <input
                                        type="text"
                                        class="input input-bordered w-full hover:border-primary transition-colors duration-300"
                                        :class="{
                                            'input-error':
                                                bookObjectErr.version,
                                        }"
                                        v-model="bookObject.version"
                                        placeholder="1.0.0"
                                    />
                                    <label
                                        class="label"
                                        v-if="bookObjectErr.version"
                                    >
                                        <span
                                            class="label-text-alt text-error"
                                            >{{ bookObjectErr.version }}</span
                                        >
                                    </label>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium"
                                        >Description</span
                                    >
                                </label>
                                <textarea
                                    class="textarea textarea-bordered h-24 hover:border-primary transition-colors duration-300"
                                    :class="{
                                        'textarea-error':
                                            bookObjectErr.description,
                                    }"
                                    v-model="bookObject.description"
                                    placeholder="Enter book description"
                                ></textarea>
                                <label
                                    class="label"
                                    v-if="bookObjectErr.description"
                                >
                                    <span class="label-text-alt text-error">{{
                                        bookObjectErr.description
                                    }}</span>
                                </label>
                            </div>

                            <!-- Status Toggle -->
                            <div class="form-control">
                                <label
                                    class="label cursor-pointer justify-start gap-3"
                                >
                                    <span class="label-text font-medium"
                                        >Active Status</span
                                    >
                                    <input
                                        type="checkbox"
                                        class="toggle toggle-primary hover:scale-110 transition-transform duration-300"
                                        v-model="bookObject.status"
                                    />
                                </label>
                            </div>
                        </div>

                        <!-- Right Column - File Uploads -->
                        <div class="space-y-4">
                            <!-- Cover Image -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium"
                                        >Cover Image</span
                                    >
                                </label>
                                <div
                                    class="border-2 border-dashed border-base-300 rounded-lg p-4 text-center hover:border-primary transition-colors duration-300"
                                >
                                    <div class="avatar mb-3">
                                        <div
                                            class="w-32 h-40 rounded-lg group-hover:scale-110 transition-transform duration-300"
                                        >
                                            <img
                                                :src="
                                                    imagePreview ||
                                                    bookObject.image_url ||
                                                    'https://via.placeholder.com/128x160?text=No+Cover'
                                                "
                                                class="object-cover"
                                            />
                                        </div>
                                    </div>
                                    <input
                                        type="file"
                                        ref="imageInput"
                                        class="file-input file-input-bordered w-full max-w-xs hover:border-primary transition-colors duration-300"
                                        @change="handleImageUpload"
                                        accept="image/*"
                                    />
                                    <p class="text-xs opacity-50 mt-2">
                                        Max: 2MB (jpeg, png, jpg, gif)
                                    </p>
                                </div>
                            </div>

                            <!-- PDF File -->
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-medium">
                                        PDF File
                                        <span class="text-error">*</span>
                                    </span>
                                </label>
                                <div
                                    class="border-2 border-dashed border-base-300 rounded-lg p-4 text-center hover:border-primary transition-colors duration-300"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        class="w-12 h-12 mx-auto mb-2 stroke-current opacity-50"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                                        ></path>
                                    </svg>

                                    <div
                                        v-if="bookObject.file_url && !fileFile"
                                        class="mb-2"
                                    >
                                        <a
                                            :href="bookObject.download_url"
                                            target="_blank"
                                            class="link link-primary text-sm hover:scale-105 transition-transform duration-300"
                                        >
                                            View Current PDF
                                        </a>
                                    </div>

                                    <input
                                        type="file"
                                        ref="fileInput"
                                        class="file-input file-input-bordered w-full max-w-xs hover:border-primary transition-colors duration-300"
                                        @change="handleFileUpload"
                                        accept=".pdf"
                                        :required="!bookObject.id"
                                    />
                                    <p class="text-xs opacity-50 mt-2">
                                        Max: 10MB (PDF only)
                                    </p>

                                    <label
                                        class="label"
                                        v-if="bookObjectErr.file"
                                    >
                                        <span
                                            class="label-text-alt text-error"
                                            >{{ bookObjectErr.file }}</span
                                        >
                                    </label>
                                </div>
                            </div>

                            <!-- Statistics (View Only) -->
                            <div
                                v-if="bookObject.id"
                                class="stats stats-vertical shadow w-full hover:shadow-lg transition-shadow duration-300"
                            >
                                <div
                                    class="stat hover:scale-105 transition-transform duration-300"
                                >
                                    <div class="stat-title">Downloads</div>
                                    <div class="stat-value text-primary">
                                        {{
                                            formatNumber(
                                                bookObject.downloads || 0,
                                            )
                                        }}
                                    </div>
                                </div>
                                <div
                                    class="stat hover:scale-105 transition-transform duration-300"
                                >
                                    <div class="stat-title">Views</div>
                                    <div class="stat-value text-secondary">
                                        {{
                                            formatNumber(
                                                bookObject.userview || 0,
                                            )
                                        }}
                                    </div>
                                </div>
                                <div
                                    class="stat hover:scale-105 transition-transform duration-300"
                                >
                                    <div class="stat-title">Created</div>
                                    <div class="stat-value text-sm">
                                        {{ formatDate(bookObject.created_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-action">
                        <button
                            type="button"
                            class="btn btn-ghost hover:scale-105 transition-transform duration-300"
                            @click="hideBookModal"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary hover:scale-105 transition-transform duration-300"
                            :class="{ loading: saving }"
                            :disabled="saving"
                        >
                            <svg
                                v-if="!saving"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                class="w-4 h-4 mr-2 stroke-current"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"
                                ></path>
                            </svg>
                            {{ saving ? "Saving..." : "Save Changes" }}
                        </button>
                    </div>
                </form>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button @click="hideBookModal">close</button>
            </form>
        </dialog>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from "vue";
import Swal from "sweetalert2";
import { CloseModal, LoadingModal, MessageModal } from "@func/swal";
import {
    apiGetPDFBook,
    apiGetPDFBookID,
    apiCreatePDFBook,
    apiUpdatePDFBook,
    apiDeletePDFBook,
    apiTogglePDFBookStatus,
    apiDownloadPDFBookID,
    apiGetCategories,
} from "@func/api/pdfbook";

// Refs
const bookModal = ref(null);
const imageInput = ref(null);
const fileInput = ref(null);
const filterCollapsed = ref(true);
const searchTimeout = ref(null);

// Data
const books = ref([]);
const categories = ref([]);
const loading = ref(false);
const saving = ref(false);
const imageFile = ref(null);
const fileFile = ref(null);
const imageFileName = ref("");
const fileFileName = ref("");
const imagePreview = ref(null);
const pagination = ref({
    current_page: 1,
    last_page: 1,
    total: 0,
    from: 0,
    to: 0,
    per_page: 15,
});

// Stats
const stats = computed(() => {
    const total = books.value.length;
    const active = books.value.filter((b) => b.status).length;
    const downloads = books.value.reduce(
        (sum, b) => sum + (b.downloads || 0),
        0,
    );
    return {
        totalBooks: total,
        activeBooks: active,
        totalDownloads: downloads,
        categories: categories.value.length,
    };
});

// Check if any filters are active
const hasActiveFilters = computed(() => {
    return (
        filters.category_id !== "" ||
        filters.status !== "" ||
        filters.search !== ""
    );
});

// Filters - Make sure these match your backend expected parameters
const filters = reactive({
    category_id: "",
    status: "",
    search: "",
});

// Book object
const bookObject = reactive({
    id: null,
    title: "",
    description: "",
    category_id: "",
    status: true,
    version: "1.0.0",
    downloads: 0,
    userview: 0,
    image_url: "",
    file_url: "",
    download_url: "",
    category: null,
    uploader: null,
    created_at: "",
    updated_at: "",
});

const bookObjectErr = reactive({
    title: "",
    description: "",
    category_id: "",
    version: "",
    image: "",
    file: "",
});

const defaultBookObject = JSON.parse(JSON.stringify(bookObject));
const defaultBookObjectErr = JSON.parse(JSON.stringify(bookObjectErr));

// Helper function to get initials from name
function getInitials(name) {
    if (!name) return "U";
    return name
        .split(" ")
        .map((word) => word[0])
        .join("")
        .toUpperCase()
        .substring(0, 2);
}

// Lifecycle
onMounted(async () => {
    await loadCategories();
    await loadBooks();
});

// Methods
function toggleFilterCollapse() {
    filterCollapsed.value = !filterCollapsed.value;
}

// Handle filter change (immediate for dropdowns)
function onFilterChange() {
    pagination.value.current_page = 1;
    loadBooks();
}

// Debounced search
function debouncedSearch() {
    clearTimeout(searchTimeout.value);
    searchTimeout.value = setTimeout(() => {
        pagination.value.current_page = 1;
        loadBooks();
    }, 500);
}

// Apply filters manually
function applyFilters() {
    pagination.value.current_page = 1;
    loadBooks();
}

// Reset all filters
function resetFilters() {
    filters.category_id = "";
    filters.status = "";
    filters.search = "";
    applyFilters();
}

// Remove a specific filter
function removeFilter(filterKey) {
    filters[filterKey] = "";
    applyFilters();
}

// Get category name by ID
function getCategoryName(categoryId) {
    const category = categories.value.find(
        (c) => c.id === parseInt(categoryId),
    );
    return category ? category.title : "Unknown";
}

async function loadBooks() {
    loading.value = true;
    try {
        LoadingModal();

        const params = {
            page: pagination.value.current_page,
            per_page: pagination.value.per_page,
        };

        // Add filters only if they have values
        if (filters.category_id) {
            params.category_id = filters.category_id;
        }

        // FIX: Handle status correctly - send as string "1" or "0" which Laravel accepts
        if (filters.status !== "") {
            // Send as string "1" or "0" - Laravel's boolean validation accepts these
            params.status = filters.status;
        }

        if (filters.search) {
            params.search = filters.search;
        }

        // Add sort parameters
        params.sort_field = 'created_at';
        params.sort_direction = 'desc';

        console.log("Loading books with params:", params);

        const response = await apiGetPDFBook(params);

        console.log("API Response:", response.data);

        if (response.data?.success && response.data?.data) {
            if (response.data.data.data) {
                books.value = response.data.data.data;
                pagination.value = {
                    current_page: response.data.data.current_page,
                    last_page: response.data.data.last_page,
                    total: response.data.data.total,
                    from: response.data.data.from,
                    to: response.data.data.to,
                    per_page: response.data.data.per_page,
                };
            } else if (Array.isArray(response.data.data)) {
                books.value = response.data.data;
                pagination.value = {
                    current_page: 1,
                    last_page: 1,
                    total: books.value.length,
                    from: 1,
                    to: books.value.length,
                    per_page: books.value.length,
                };
            } else {
                books.value = [];
            }
        } else {
            books.value = [];
        }

        CloseModal();
    } catch (error) {
        console.error("Load books error:", error);

        if (error.response?.data?.errors) {
            console.error("Validation errors:", error.response.data.errors);
        }

        MessageModal(
            "error",
            "Error",
            error.response?.data?.message || "Failed to load books",
        );
    } finally {
        loading.value = false;
    }
}


async function loadCategories() {
    try {
        const response = await apiGetCategories();
        if (response.data?.success) {
            categories.value = response.data?.data || [];
        } else {
            categories.value = [];
        }
    } catch (error) {
        console.error("Failed to load categories:", error);
        categories.value = [];
    }
}

async function createBook() {
    try {
        // Clear previous errors
        Object.keys(bookObjectErr).forEach((key) => {
            bookObjectErr[key] = "";
        });

        // Validate
        if (!bookObject.title) {
            bookObjectErr.title = "Title is required";
            return;
        }

        if (!bookObject.category_id) {
            bookObjectErr.category_id = "Category is required";
            return;
        }

        if (!fileFile.value) {
            bookObjectErr.file = "PDF file is required";
            return;
        }

        saving.value = true;
        LoadingModal();

        const formData = new FormData();
        formData.append("title", bookObject.title.trim());
        formData.append("description", bookObject.description?.trim() || "");
        formData.append("category_id", bookObject.category_id);
        formData.append("status", bookObject.status ? "1" : "0");
        formData.append("version", bookObject.version?.trim() || "1.0.0");

        if (imageFile.value) {
            formData.append("image", imageFile.value);
        }

        if (fileFile.value) {
            formData.append("file", fileFile.value);
        }

        const response = await apiCreatePDFBook(formData);

        if (response.data?.success) {
            hideBookModal();
            MessageModal(
                "success",
                "Success",
                response.data?.message || "Book created successfully",
            );
            await loadBooks();
        } else {
            throw new Error(response.data?.message || "Failed to create book");
        }
    } catch (error) {
        console.error("Create book error:", error);
        if (error.response?.status === 422) {
            const errors = error.response.data.errors || {};
            Object.keys(bookObjectErr).forEach((key) => {
                bookObjectErr[key] = errors[key]?.[0] || "";
            });
            MessageModal(
                "error",
                "Validation Error",
                "Please check the form for errors",
            );
        } else {
            MessageModal(
                "error",
                "Error",
                error.response?.data?.message ||
                    error.message ||
                    "Failed to create book",
            );
        }
    } finally {
        saving.value = false;
        CloseModal();
    }
}

async function updateBook() {
    try {
        // Clear previous errors
        Object.keys(bookObjectErr).forEach((key) => {
            bookObjectErr[key] = "";
        });

        // Validate
        if (!bookObject.title) {
            bookObjectErr.title = "Title is required";
            return;
        }

        if (!bookObject.category_id) {
            bookObjectErr.category_id = "Category is required";
            return;
        }

        saving.value = true;
        LoadingModal();

        const formData = new FormData();
        formData.append("title", bookObject.title.trim());
        formData.append("description", bookObject.description?.trim() || "");
        formData.append("category_id", bookObject.category_id);
        formData.append("status", bookObject.status ? "1" : "0");
        formData.append("version", bookObject.version?.trim() || "1.0.0");
        formData.append("_method", "PUT");

        if (imageFile.value) {
            formData.append("image", imageFile.value);
        }

        if (fileFile.value) {
            formData.append("file", fileFile.value);
        }

        const response = await apiUpdatePDFBook(bookObject.id, formData);

        if (response.data?.success) {
            hideBookModal();
            MessageModal(
                "success",
                "Success",
                response.data?.message || "Book updated successfully",
            );
            await loadBooks();
        } else {
            throw new Error(response.data?.message || "Failed to update book");
        }
    } catch (error) {
        console.error("Update book error:", error);
        if (error.response?.status === 422) {
            const errors = error.response.data.errors || {};
            Object.keys(bookObjectErr).forEach((key) => {
                bookObjectErr[key] = errors[key]?.[0] || "";
            });
            MessageModal(
                "error",
                "Validation Error",
                "Please check the form for errors",
            );
        } else {
            MessageModal(
                "error",
                "Error",
                error.response?.data?.message ||
                    error.message ||
                    "Failed to update book",
            );
        }
    } finally {
        saving.value = false;
        CloseModal();
    }
}

async function viewBook(id) {
    try {
        LoadingModal();
        const response = await apiGetPDFBookID(id);

        if (!response.data?.success && !response.data?.data) {
            throw new Error("Invalid response format");
        }

        const bookData = response.data?.data || response.data;

        resetData();

        Object.assign(bookObject, {
            id: bookData.id,
            title: bookData.title || "",
            description: bookData.description || "",
            category_id: bookData.category_id || "",
            status: bookData.status === 1 || bookData.status === true,
            version: bookData.version || "1.0.0",
            downloads: bookData.downloads || 0,
            userview: bookData.userview || 0,
            image_url: bookData.image_url || "",
            file_url: bookData.file_url || "",
            download_url: bookData.download_url || "",
            category: bookData.category || null,
            uploader: bookData.uploader || null,
            created_at: bookData.created_at || "",
            updated_at: bookData.updated_at || "",
        });

        showEditModal();
        CloseModal();
    } catch (error) {
        console.error("View book error:", error);
        MessageModal(
            "error",
            "Error",
            error.response?.data?.message ||
                error.message ||
                "Failed to load book",
        );
    }
}

async function toggleStatus(id) {
    const result = await Swal.fire({
        title: "Toggle Status",
        text: "Are you sure you want to toggle this book's status?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
    });

    if (result.isConfirmed) {
        try {
            LoadingModal();
            const response = await apiTogglePDFBookStatus(id);
            if (response.data?.success) {
                MessageModal(
                    "success",
                    "Success",
                    response.data?.message || "Status updated",
                );
                await loadBooks();
            } else {
                throw new Error(
                    response.data?.message || "Failed to update status",
                );
            }
        } catch (error) {
            console.error("Toggle status error:", error);
            MessageModal(
                "error",
                "Error",
                error.response?.data?.message ||
                    error.message ||
                    "Failed to update status",
            );
        }
    }
}

function downloadBook(id) {
    apiDownloadPDFBookID(id)
        .then((response) => {
            // Get filename from Content-Disposition header if available
            const contentDisposition = response.headers["content-disposition"];
            let filename = `book-${id}.pdf`;

            if (contentDisposition) {
                const filenameMatch = contentDisposition.match(
                    /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/,
                );
                if (filenameMatch && filenameMatch[1]) {
                    filename = filenameMatch[1].replace(/['"]/g, "");
                }
            }

            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", filename);
            document.body.appendChild(link);
            link.click();
            link.remove();
            window.URL.revokeObjectURL(url);

            MessageModal("success", "Success", "Book downloaded successfully");
        })
        .catch((error) => {
            console.error("Download error:", error);
            MessageModal(
                "error",
                "Error",
                error.response?.data?.message ||
                    error.message ||
                    "Failed to download book",
            );
        });
}

async function removeBook(id) {
    const result = await Swal.fire({
        title: "Delete Book",
        text: "Are you sure you want to delete this book? This action cannot be undone.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
    });

    if (result.isConfirmed) {
        try {
            LoadingModal();
            const response = await apiDeletePDFBook(id);
            if (response.data?.success) {
                MessageModal(
                    "success",
                    "Success",
                    response.data?.message || "Book deleted",
                );
                await loadBooks();
            } else {
                throw new Error(
                    response.data?.message || "Failed to delete book",
                );
            }
        } catch (error) {
            console.error("Delete error:", error);
            MessageModal(
                "error",
                "Error",
                error.response?.data?.message ||
                    error.message ||
                    "Failed to delete book",
            );
        }
    }
}

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            MessageModal("error", "Error", "Image size must be less than 2MB");
            event.target.value = "";
            return;
        }

        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/jpg",
            "image/gif",
        ];
        if (!allowedTypes.includes(file.type)) {
            MessageModal(
                "error",
                "Error",
                "Only JPEG, PNG, JPG, and GIF images are allowed",
            );
            event.target.value = "";
            return;
        }

        imageFile.value = file;
        imageFileName.value = file.name;

        const reader = new FileReader();
        reader.onload = (e) => (imagePreview.value = e.target.result);
        reader.readAsDataURL(file);
    }
}

function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        if (file.size > 10 * 1024 * 1024) {
            MessageModal("error", "Error", "PDF size must be less than 10MB");
            event.target.value = "";
            return;
        }

        if (file.type !== "application/pdf") {
            MessageModal("error", "Error", "Only PDF files are allowed");
            event.target.value = "";
            return;
        }

        fileFile.value = file;
        fileFileName.value = file.name;
        bookObjectErr.file = "";
    }
}

function changePage(page) {
    if (page < 1 || page > pagination.value.last_page) return;
    pagination.value.current_page = page;
    loadBooks();
}

function showBookModal() {
    resetData();
    if (bookModal.value) {
        bookModal.value.showModal();
    }
}

function showEditModal() {
    if (bookModal.value) {
        bookModal.value.showModal();
    }
}

function hideBookModal() {
    if (bookModal.value) {
        bookModal.value.close();
    }
}

function resetData() {
    const freshObject = JSON.parse(JSON.stringify(defaultBookObject));
    Object.keys(bookObject).forEach((key) => {
        bookObject[key] = freshObject[key];
    });
    Object.keys(bookObjectErr).forEach((key) => {
        bookObjectErr[key] = "";
    });
    imageFile.value = null;
    fileFile.value = null;
    imageFileName.value = "";
    fileFileName.value = "";
    imagePreview.value = null;
    if (imageInput.value) {
        imageInput.value.value = "";
    }
    if (fileInput.value) {
        fileInput.value.value = "";
    }
}

function getSerialNumber(index) {
    return (
        (pagination.value.current_page - 1) * pagination.value.per_page +
        index +
        1
    );
}

function formatDate(dateString, format = "full") {
    if (!dateString) return "N/A";
    try {
        const date = new Date(dateString);
        if (format === "short") {
            return date.toLocaleDateString("en-US", {
                month: "short",
                day: "numeric",
                year: "numeric",
            });
        }
        return date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "short",
            day: "numeric",
        });
    } catch (e) {
        return "Invalid Date";
    }
}

function formatNumber(num) {
    return new Intl.NumberFormat().format(num);
}

function truncateText(text, length) {
    if (!text) return "";
    return text.length > length ? text.substring(0, length) + "..." : text;
}
</script>


<style scoped>
/* Custom styles that complement DaisyUI */
.modal-box {
    max-height: 90vh;
    overflow-y: auto;
}

.stat {
    transition: transform 0.2s;
}

.stat:hover {
    transform: translateY(-4px);
}

/* Custom scrollbar for modal */
.modal-box::-webkit-scrollbar {
    width: 8px;
}

.modal-box::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.modal-box::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.modal-box::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.rotate-180 {
    transform: rotate(180deg);
    transition: transform 0.3s;
}

.filter-content {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Group hover effects */
.group:hover {
    background-color: hsl(var(--b3));
    box-shadow:
        0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Table row hover animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}

/* Smooth transitions for all interactive elements */
button,
.badge,
.avatar,
.stat,
.card {
    transition: all 0.3s ease;
}

/* Hover effects for table cells */
td {
    transition: all 0.2s ease;
}

/* Gradient animation for active filters */
.badge-info {
    background: linear-gradient(45deg, #3b82f6, #8b5cf6);
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

@keyframes gradient {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}
</style>
