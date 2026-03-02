<template>
    <div class="min-h-screen bg-base-100">
        <!-- Page Header -->
        <div
            class="bg-base-200 shadow-sm border-b border-base-300 m-4 rounded-xl"
        >
            <div class="container mx-auto px-4 py-4">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4"
                >
                    <div>
                        <h4
                            class="text-3xl font-bold bg-linear-to-r from-error to-secondary bg-clip-text text-transparent"
                        >
                            PDF Books Management
                        </h4>
                        <p class="text-base-content/70 text-sm mt-1">
                            Manage your digital library collection
                        </p>
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

                <!-- Filters and View Toggle -->
                <div
                    class="grid grid-cols-1 md:grid-cols-[2fr_repeat(2,2fr)_2fr] gap-4 mt-4"
                >
                    <h4 class="font-bold text-lg flex items-center gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-primary"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        Filters & Search
                    </h4>

                    <!-- Search Filter -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Search</span>
                        </label>
                        <div class="join w-full">
                            <input
                                type="text"
                                class="input input-bordered join-item w-full"
                                v-model="filters.search"
                                placeholder="Search by title or description..."
                                @keyup.enter="applyFilters"
                                @input="debouncedSearch"
                            />
                            <button
                                class="btn btn-primary join-item"
                                @click="applyFilters"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Category</span>
                        </label>
                        <select
                            class="select select-bordered w-full"
                            v-model="filters.category_id"
                            @change="applyFilters"
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

                    <!-- View Toggle -->
                    <div class="flex items-center gap-2">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">View</span>
                            </label>
                            <div class="flex gap-2 justify-content-evenly">
                                <button
                                    @click="viewMode = 'grid'"
                                    class="btn btn-md"
                                    :class="
                                        viewMode === 'grid'
                                            ? 'btn-primary'
                                            : 'btn-ghost'
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                                        />
                                    </svg>
                                    Grid
                                </button>
                                <button
                                    @click="viewMode = 'list'"
                                    class="btn btn-md"
                                    :class="
                                        viewMode === 'list'
                                            ? 'btn-primary'
                                            : 'btn-ghost'
                                    "
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Filters -->
                <div v-if="hasActiveFilters" class="flex flex-wrap gap-2 mt-4">
                    <span class="text-sm opacity-70 mr-2">Active filters:</span>
                    <div
                        v-if="filters.category_id"
                        class="badge badge-info gap-1 badge-sm"
                    >
                        Category: {{ getCategoryName(filters.category_id) }}
                        <button
                            class="ml-1 hover:text-error"
                            @click="removeFilter('category_id')"
                        >
                            ✕
                        </button>
                    </div>

                    <div
                        v-if="filters.search"
                        class="badge badge-info gap-1 badge-sm"
                    >
                        Search: "{{ filters.search }}"
                        <button
                            class="ml-1 hover:text-error"
                            @click="removeFilter('search')"
                        >
                            ✕
                        </button>
                    </div>
                    <button
                        class="badge badge-ghost gap-1 cursor-pointer hover:bg-base-300 badge-sm"
                        @click="resetFilters"
                    >
                        Clear all
                    </button>
                </div>
            </div>
        </div>

        <!-- Books Display -->
        <div class="container px-4">
            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-12">
                <span
                    class="loading loading-spinner loading-lg text-primary"
                ></span>
            </div>

            <!-- Grid View -->

            <div
                v-else-if="viewMode === 'grid'"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
            >
                <div
                    v-for="book in books"
                    :key="book.id"
                    class="card bg-base-200 shadow-sm border border-base-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group"
                >
                    <!-- Favorite Button - PER USER -->
                    <div class="absolute top-2 left-2 z-10" >
                        <button
                            v-if="isAuthenticated"
                            @click.stop="toggleFavorite(book)"
                            class="btn btn-circle btn-xs"
                            :class="
                                book.is_favorited
                                    ? 'btn-error'
                                    : 'btn-ghost bg-base-100/80 backdrop-blur-sm'
                            "
                            :title="
                                book.is_favorited
                                    ? 'Remove from favorites'
                                    : 'Add to favorites'
                            "
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                :fill="
                                    isFavoritedByCurrentUser(book) ? 'currentColor' : 'none'
                                "
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </button>
                        <!-- Guest favorite button -->
                        <button
                            v-else
                            @click.stop="promptLogin"
                            class="btn btn-circle btn-xs btn-ghost bg-base-100/80 backdrop-blur-sm"
                            title="Login to add to favorites"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                />
                            </svg>
                        </button>
                    </div>

                    <!-- Book Cover -->
                    <figure class="px-4 pt-4">
                        <div
                            class="relative w-full h-36 rounded-lg overflow-hidden"
                        >
                            <img
                                :src="
                                    book.image_url ||
                                    'https://via.placeholder.com/300x200?text=No+Cover'
                                "
                                :alt="book.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            />

                            <!-- Status Badge -->
                            <div class="absolute top-2 right-2">
                                <div
                                    :class="`badge badge-${book.status ? 'success' : 'error'} gap-1`"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            :d="getStatusIconPath(book.status)"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    {{ book.status ? "Active" : "Inactive" }}
                                </div>
                            </div>

                            <!-- Favorite Count Badge - TOTAL from ALL users -->
                            <div class="absolute bottom-2 left-2">
                                <div
                                    class="badge badge-secondary gap-1 badge-sm"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    {{ book.favorite_count || 0 }}
                                </div>
                            </div>
                        </div>
                    </figure>

                    <!-- Book Info -->
                    <div class="card-body">
                        <h2 class="card-title text-lg font-bold line-clamp-1">
                            {{ book.title }}
                        </h2>
                        <p class="text-sm text-base-content/70 line-clamp-2">
                            {{ book.description || "No description" }}
                        </p>

                        <div class="flex flex-wrap gap-2 justify-between">
                            <div class="badge badge-info gap-1 badge-sm">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-3 w-3"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
                                    />
                                </svg>
                                {{ book.category?.title || "Uncategorized" }}
                            </div>
                            <div class="badge badge-ghost gap-1 badge-sm">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-3 w-3"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                v{{ book.version || "1.0" }}
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between mt-2 text-sm"
                        >
                            <div class="flex items-center gap-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-secondary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path
                                        fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span>{{
                                    formatNumber(book.userview || 0)
                                }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span>{{
                                    formatNumber(book.downloads || 0)
                                }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List View with Favorite Column -->
            <div
                v-else-if="viewMode === 'list'"
                class="bg-base-200 rounded-xl shadow-sm border border-base-300 overflow-hidden"
            >
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Favorite</th>
                            <th>Cover</th>
                            <th>Title & Description</th>
                            <th>Category</th>
                            <th>Version</th>
                            <th>Status</th>
                            <th>Downloads</th>
                            <th>Views</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(book, index) in books"
                            :key="book.id"
                            :class="{ 'opacity-60': !book.status }"
                        >
                            <td>{{ getSerialNumber(index) }}</td>

                            <!-- Favorite Column - PER USER -->
                            <td>
                                <div class="flex items-center gap-1">
                                    <button
                                        v-if="isAuthenticated"
                                        @click="toggleFavorite(book)"
                                        class="btn btn-circle btn-xs"
                                        :class="
                                            book.is_favorited
                                                ? 'btn-error'
                                                : 'btn-ghost'
                                        "
                                        :title="
                                            book.is_favorited
                                                ? 'Remove from favorites'
                                                : 'Add to favorites'
                                        "
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            :fill="
                                                book.is_favorited
                                                    ? 'currentColor'
                                                    : 'none'
                                            "
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        v-else
                                        @click="promptLogin"
                                        class="btn btn-circle btn-xs btn-ghost"
                                        title="Login to add to favorites"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                            />
                                        </svg>
                                    </button>
                                    <!-- Total favorites count from ALL users -->
                                    <span class="text-xs">{{
                                        book.favorite_count || 0
                                    }}</span>
                                </div>
                            </td>

                            <td>
                                <div class="avatar">
                                    <div class="w-12 h-16 rounded">
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
                                <div class="font-bold">{{ book.title }}</div>
                                <div class="text-sm opacity-50">
                                    {{ truncateText(book.description, 50) }}
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-info gap-1">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
                                        />
                                    </svg>
                                    {{ book.category?.title || "N/A" }}
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-ghost">
                                    v{{ book.version || "1.0" }}
                                </div>
                            </td>
                            <td>
                                <div
                                    :class="`badge badge-${book.status ? 'success' : 'error'} gap-1`"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            :d="getStatusIconPath(book.status)"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    {{ book.status ? "Active" : "Inactive" }}
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-primary gap-1">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    {{ formatNumber(book.downloads || 0) }}
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-secondary gap-1">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                        />
                                        <path
                                            fill-rule="evenodd"
                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    {{ formatNumber(book.userview || 0) }}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3 w-3 inline mr-1"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    {{ formatDate(book.created_at, "short") }}
                                </div>
                            </td>
                            <td>
                                <div class="join">
                                    <button
                                        class="btn btn-xs btn-info join-item"
                                        @click="viewBook(book.id)"
                                        title="View Book"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                d="M10 12a2 2 0 100-4 2 2 0 000 4z"
                                            />
                                            <path
                                                fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        class="btn btn-xs btn-primary join-item"
                                        @click="downloadBook(book.id)"
                                        title="Download"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div
                v-if="!loading && books.length === 0"
                class="text-center py-12"
            >
                <div class="flex flex-col items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-24 h-24 text-base-300"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path
                            d="M9 4.804A7.968 7.968 0 015.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"
                        />
                    </svg>
                    <h3
                        class="text-lg font-semibold text-base-content opacity-50 mt-4"
                    >
                        No Books Found
                    </h3>
                    <p class="text-sm text-base-content opacity-30">
                        Click "Add New Book" to create your first book.
                    </p>
                </div>
            </div>

            <!-- Pagination -->
            <div
                v-if="pagination && pagination.total > 0"
                class="flex justify-between items-center mt-6"
            >
                <div class="text-sm opacity-70">
                    Showing {{ pagination.from || 0 }} to
                    {{ pagination.to || 0 }} of
                    {{ pagination.total || 0 }} entries
                </div>
                <div class="join">
                    <button
                        class="join-item btn btn-sm"
                        :disabled="pagination.current_page === 1"
                        @click="changePage(pagination.current_page - 1)"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                    <button
                        class="join-item btn btn-sm"
                        v-for="page in pagination.last_page"
                        :key="page"
                        :class="{
                            'btn-active': page === pagination.current_page,
                        }"
                        @click="changePage(page)"
                    >
                        {{ page }}
                    </button>
                    <button
                        class="join-item btn btn-sm"
                        :disabled="
                            pagination.current_page === pagination.last_page
                        "
                        @click="changePage(pagination.current_page + 1)"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Book Modal -->
        <dialog ref="bookModal" class="modal">
            <div class="modal-box w-11/12 max-w-5xl">
                <!-- Modal content here -->
            </div>
        </dialog>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed, watch } from "vue";
import { useRouter } from "vue-router";

import {
    CloseModal,
    LoadingModal,
    MessageModal,
    Toast,
    ConfirmModal,
} from "@func/swal";
import {
    apiGetPDFBook,
    apiGetPDFBookID,
    apiCreatePDFBook,
    apiUpdatePDFBook,
    apiDeletePDFBook,
    apiTogglePDFBookStatus,
    apiDownloadPDFBookID,
    apiGetCategories,
    apiToggleFavorite,
} from "@func/api/pdfbook";
import { useStore } from 'vuex';

const store = useStore();
const user = computed(() => store.getters.getUser);
const router = useRouter();

onMounted(() => {
  console.log(user.value.id);
});
// Check if user is authenticated
const isAuthenticated = computed(() => {
    return !!localStorage.getItem("token");
});

// Get current user info (optional)
const currentUser = computed(() => {
    const userStr = localStorage.getItem("user");
    return userStr ? JSON.parse(userStr) : null;
});

// Prompt login function
function promptLogin() {
    ConfirmModal(
        "Login Required",
        "You need to be logged in to add books to your favorites. Would you like to login now?",
        "info",
    ).then((result) => {
        if (result.isConfirmed) {
            router.push({ name: "signin" });
        }
    });
}

// View mode state
const viewMode = ref("grid");

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

function isFavoritedByCurrentUser(book) {
    if (!user.value?.id || !book.favorites) return false;
    return book.favorites.some(fav => fav.user_id === user.value.id);
}

// Check if any filters are active
const hasActiveFilters = computed(() => {
    return filters.category_id !== "" || filters.search !== "";
});

// Filters
const filters = reactive({
    category_id: "",
    search: "",
});

// Debug: Watch books to verify per-user favorites
watch(
    books,
    (newBooks) => {
        if (newBooks.length > 0 && currentUser.value) {
            console.log(
                `[${currentUser.value.name}] Books loaded:`,
                newBooks.length,
            );
            console.log(
                `[${currentUser.value.name}] Favorited by me:`,
                newBooks.filter((b) => b.is_favorited).length,
            );
            console.log(
                `[${currentUser.value.name}] Favorite details:`,
                newBooks.map((b) => ({
                    id: b.id,
                    title: b.title.substring(0, 20) + "...",
                    is_favorited: b.is_favorited,
                    total_favorites: b.favorite_count,
                })),
            );
        }
    },
    { immediate: true },
);

// Book object for modal
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

// Helper functions for SVG paths
const getStatusIconPath = (status) => {
    return status
        ? "M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
        : "M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z";
};

watch(
    books,
    (newBooks) => {
        if (newBooks.length > 0 && currentUser.value) {
            console.log(`=== ${currentUser.value.name}'s view ===`);
            newBooks.forEach((book) => {
                console.log(`${book.title}:`);
                console.log(`  - Favorited by me: ${book.is_favorited}`);
                console.log(`  - Total favorites: ${book.favorite_count}`);
            });
        }
    },
    { immediate: true },
);

// Lifecycle
onMounted(async () => {

    await loadCategories();
    await loadBooks();

});

// Filter Methods
function toggleFilterCollapse() {
    filterCollapsed.value = !filterCollapsed.value;
}

function applyFilters() {
    pagination.value.current_page = 1;
    loadBooks();
}

function resetFilters() {
    filters.category_id = "";
    filters.search = "";
    applyFilters();
}

function removeFilter(filterKey) {
    filters[filterKey] = "";
    applyFilters();
}

function debouncedSearch() {
    clearTimeout(searchTimeout.value);
    searchTimeout.value = setTimeout(() => {
        if (filters.search && filters.search.trim() !== "") {
            pagination.value.current_page = 1;
            loadBooks();
        }
    }, 500);
}

// Get category name by ID
function getCategoryName(categoryId) {
    const category = categories.value.find(
        (c) => c.id === parseInt(categoryId),
    );
    return category ? category.title : "Unknown";
}

// Load books with filters - FIXED per-user favorites
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

        if (filters.search && filters.search.trim() !== "") {
            params.search = filters.search.trim();
        }

        // Add sorting
        params.sort_field = "created_at";
        params.sort_direction = "desc";

        console.log("Loading books with params:", params);

        const response = await apiGetPDFBook(params);

        if (response.data?.success && response.data?.data) {
            if (response.data.data.data) {
                // Handle paginated response - FIXED: removed 'false ||' which could override
                books.value = response.data.data.data.map((book) => ({
                    ...book,
                    // PER-USER favorite status comes directly from API
                                   // Set is_favorited flag based on current user
                is_favorited: book.favorites?.some(
                    fav => fav.user_id === user.value?.id
                ) || false
                }));
                pagination.value = {
                    current_page: response.data.data.current_page,
                    last_page: response.data.data.last_page,
                    total: response.data.data.total,
                    from: response.data.data.from,
                    to: response.data.data.to,
                    per_page: response.data.data.per_page,
                };
            } else if (Array.isArray(response.data.data)) {
                // Handle non-paginated response - FIXED: removed 'false ||' which could override
                books.value = response.data.data.map((book) => ({
                    ...book,
                    is_favorited: book.is_favorited || false,
                    favorite_count:
                        book.favorite_count || book.favorites_count || 0,
                }));
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
        console.log("Load books error:", error);

        if (error.response?.data?.errors) {
            console.error("Validation errors:", error.response.data.errors);
            MessageModal(
                "error",
                "Validation Error",
                Object.values(error.response.data.errors).flat().join(", "),
            );
        } else {
            MessageModal(
                "error",
                "Error",
                error.response?.data?.message || "Failed to load books",
            );
        }
    } finally {
        loading.value = false;
    }
}

// Load categories
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

// Toggle favorite function - PER USER
async function toggleFavorite(book) {
    if (!isAuthenticated.value) {
        promptLogin();
        return;
    }

    try {
        const response = await apiToggleFavorite(book.id);

        if (response.data?.success) {
            const index = books.value.findIndex((b) => b.id === book.id);
            if (index !== -1) {
                // Update only the current user's favorite status for this book
                books.value[index] = {
                    ...books.value[index],
                    is_favorited: response.data.data.is_favorited || false,
                    favorite_count: response.data.data.favorite_count,
                };
            }

            Toast(
                "success",
                response.data.data.is_favorited
                    ? "Book added to favorites"
                    : "Book removed from favorites",
            );

            // Log for debugging
            if (currentUser.value) {
                console.log(
                    `[${currentUser.value.name}] Toggled favorite for book ${book.id}:`,
                    response.data.data.is_favorited,
                );
            }
        }
    } catch (error) {
        console.error("Toggle favorite error:", error);

        if (error.response?.status === 401) {
            promptLogin();
        } else {
            Toast("error", "Failed to toggle favorite");
        }
    }
}

// CRUD Operations
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

// View book details
async function viewBook(id) {
    try {
        LoadingModal();
        const response = await apiGetPDFBookID(id);
        CloseModal();
        if (response.data?.success) {
            // Navigate to book detail page
            router.push({ name: "pdf-book-view", params: { id } });
        }
    } catch (error) {
        CloseModal();
        console.error("View book error:", error);
        Toast("error", "Failed to load book details");
    }
}

// Download book
function downloadBook(id) {
    apiDownloadPDFBookID(id)
        .then((response) => {
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

            Toast("success", "Book downloaded successfully");
        })
        .catch((error) => {
            console.error("Download error:", error);
            Toast("error", "Failed to download book");
        });
}
</script>

<style scoped>
/* Smooth transitions */
.card {
    transition: all 0.3s ease;
}

/* Line clamp utilities */
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Hover effects */
.stat:hover {
    transform: translateY(-2px);
    transition: transform 0.3s ease;
}

/* Table styles */
.table th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
}

/* Modal scrollbar */
.modal-box {
    max-height: 90vh;
    overflow-y: auto;
}

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

/* View toggle animation */
.btn {
    transition: all 0.2s ease;
}

/* Gradient backgrounds for stat cards */
.bg-gradient-to-br {
    background-size: 200% 200%;
    animation: gradientShift 10s ease infinite;
}

@keyframes gradientShift {
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
