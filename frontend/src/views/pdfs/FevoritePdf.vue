<template>
    <div class="min-h-screen bg-base-100">
        <!-- Page Header with Search -->
        <div
            class="bg-base-200 shadow-sm border-b border-base-300 m-4 rounded-xl"
        >
            <div class="container mx-auto px-4 py-4">
                <div
                    class="flex flex-col md:flex-row justify-between items-center gap-4"
                >
                    <div>
                        <div class="flex items-center gap-2">
                            <h4
                                class="text-3xl font-bold bg-gradient-to-r from-error to-secondary bg-clip-text text-transparent"
                            >
                                My Favorite Books
                            </h4>
                            <div class="badge badge-error badge-lg gap-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                {{ statistics.total_favorites || 0 }}
                            </div>
                        </div>
                        <p class="text-base-content/70 text-sm mt-1">
                            Your personally curated collection of favorite PDF
                            books
                        </p>
                    </div>

                    <!-- Search Box - Centered -->
                    <div class="flex-1 max-w-md mx-auto">
                        <div class="join w-full">
                            <input
                                type="text"
                                class="input input-bordered join-item w-full"
                                v-model="filters.search"
                                placeholder="Search favorites by title or description..."
                                @keyup.enter="applyFilters"
                                @input="debouncedSearch"
                            />
                            <button
                                class="btn btn-primary join-item"
                                @click="applyFilters"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
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
                                    class="h-4 w-4 text-error"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Favorites
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Active Filter Badge (only shows when search is active) -->
                <div v-if="filters.search" class="flex justify-center mt-4">
                    <div class="badge badge-info gap-2 p-3">
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
                        Searching: "{{ filters.search }}"
                        <button
                            class="ml-1 hover:text-error"
                            @click="clearSearch"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Toggle - Moved below header -->
        <!-- <div class="container px-4 mb-4">
            <div class="flex justify-end">
                <div class="join">
                    <button
                        @click="viewMode = 'grid'"
                        class="btn btn-sm join-item"
                        :class="
                            viewMode === 'grid' ? 'btn-primary' : 'btn-ghost'
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
                        class="btn btn-sm join-item"
                        :class="
                            viewMode === 'list' ? 'btn-primary' : 'btn-ghost'
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
        </div> -->

        <!-- Rest of your content remains the same -->
        <div class="container px-4">
            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-12">
                <span
                    class="loading loading-spinner loading-lg text-error"
                ></span>
            </div>

            <!-- Grid View - USING filteredFavorites -->
            <div
                v-else-if="viewMode === 'grid' && filteredFavorites.length > 0"
                class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
            >
                <div
                    v-for="favorite in filteredFavorites"
                    :key="favorite.id"
                    class="card bg-base-200 shadow-sm border border-base-300 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group"
                >
                    <!-- Remove Button -->
                    <div class="absolute top-2 left-2 z-10">
                        <button
                            @click.stop="removeFavorite(favorite)"
                            class="btn btn-circle btn-xs btn-error"
                            title="Remove from favorites"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
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
                                    favorite.pdf_book?.image_url ||
                                    'https://via.placeholder.com/300x200?text=No+Cover'
                                "
                                :alt="favorite.pdf_book?.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            />
                            <div class="absolute top-2 right-2">
                                <div class="badge badge-error gap-1">
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
                                    Favorite
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2">
                                <div
                                    class="text-xs bg-base-100/80 backdrop-blur-sm px-2 py-1 rounded-full"
                                >
                                    {{
                                        formatDate(favorite.created_at, "short")
                                    }}
                                </div>
                            </div>
                        </div>
                    </figure>

                    <!-- Book Info -->
                    <div class="card-body">
                        <h2 class="card-title text-lg font-bold line-clamp-1">
                            {{ favorite.pdf_book?.title }}
                        </h2>
                        <p class="text-sm text-base-content/70 line-clamp-2">
                            {{
                                favorite.pdf_book?.description ||
                                "No description"
                            }}
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
                                {{
                                    favorite.pdf_book?.category?.title ||
                                    "Uncategorized"
                                }}
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
                                v{{ favorite.pdf_book?.version || "1.0" }}
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
                                    formatNumber(
                                        favorite.pdf_book?.userview || 0,
                                    )
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
                                    formatNumber(
                                        favorite.pdf_book?.downloads || 0,
                                    )
                                }}</span>
                            </div>
                        </div>

                        <div class="card-actions justify-end mt-2">
                            <button
                                class="btn btn-xs btn-primary"
                                @click="viewBook(favorite.pdf_book?.id)"
                            >
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List View - USING filteredFavorites -->
            <div
                v-else-if="viewMode === 'list' && filteredFavorites.length > 0"
                class="bg-base-200 rounded-xl shadow-sm border border-base-300 overflow-hidden"
            >
                <table class="table table-zebra w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title & Description</th>
                            <th>Category</th>
                            <th>Version</th>
                            <th>Favorited On</th>
                            <th>Downloads</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(favorite, index) in filteredFavorites"
                            :key="favorite.id"
                        >
                            <td>{{ getSerialNumber(index) }}</td>
                            <td>
                                <div class="avatar">
                                    <div class="w-12 h-16 rounded">
                                        <img
                                            :src="
                                                favorite.pdf_book?.image_url ||
                                                'https://via.placeholder.com/50x70?text=No+Cover'
                                            "
                                            :alt="favorite.pdf_book?.title"
                                            class="object-cover"
                                        />
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="font-bold">
                                    {{ favorite.pdf_book?.title }}
                                </div>
                                <div class="text-sm opacity-50">
                                    {{
                                        truncateText(
                                            favorite.pdf_book?.description,
                                            50,
                                        )
                                    }}
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
                                    {{
                                        favorite.pdf_book?.category?.title ||
                                        "N/A"
                                    }}
                                </div>
                            </td>
                            <td>
                                <div class="badge badge-ghost">
                                    v{{ favorite.pdf_book?.version || "1.0" }}
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
                                    {{
                                        formatDate(favorite.created_at, "short")
                                    }}
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
                                    {{
                                        formatNumber(
                                            favorite.pdf_book?.downloads || 0,
                                        )
                                    }}
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
                                    {{
                                        formatNumber(
                                            favorite.pdf_book?.userview || 0,
                                        )
                                    }}
                                </div>
                            </td>
                            <td>
                                <div class="join">
                                    <button
                                        class="btn btn-xs btn-info join-item"
                                        @click="viewBook(favorite.pdf_book?.id)"
                                        title="View"
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
                                        class="btn btn-xs btn-error join-item"
                                        @click="removeFavorite(favorite)"
                                        title="Remove"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-3 w-3"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
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

            <!-- Empty State - USING filteredFavorites -->
            <div
                v-if="!loading && filteredFavorites.length === 0"
                class="text-center py-12"
            >
                <div v-if="filters.search" class="flex flex-col items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-24 h-24 text-base-300"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"
                        />
                    </svg>
                    <h3
                        class="text-lg font-semibold text-base-content opacity-50 mt-4"
                    >
                        No Results Found
                    </h3>
                    <p class="text-sm text-base-content opacity-30">
                        No favorites match "{{ filters.search }}"
                    </p>
                    <button class="btn btn-primary btn-sm mt-4" @click="clearSearch">
                        Clear Search
                    </button>
                </div>
                <div v-else class="flex flex-col items-center">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-24 h-24 text-base-300"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path
                            d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"
                        />
                    </svg>
                    <h3
                        class="text-lg font-semibold text-base-content opacity-50 mt-4"
                    >
                        No Favorites Yet
                    </h3>
                    <p class="text-sm text-base-content opacity-30">
                        Start adding books to your favorites by clicking the
                        heart icon
                    </p>
                    <router-link
                        to="/pdfbook"
                        class="btn btn-primary btn-sm mt-4"
                    >
                        Browse Books
                    </router-link>
                </div>
            </div>

            <!-- Pagination - Keep using favorites for pagination (total count) -->
            <div
                v-if="
                    favorites.length > 0 && pagination && pagination.total > 0
                "
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
    </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from "vue";
import { useRouter } from "vue-router";
import {
    CloseModal,
    LoadingModal,
    MessageModal,
    ConfirmModal,
    Toast,
} from "@func/swal";
import {
    apiGetMyFavorites,
    apiToggleFavorite,
    apiGetFavoriteStatistics,
    apiGetCategories,
    apiGetPDFBookID,
} from "@func/api/pdfbook";

const router = useRouter();
const viewMode = ref("grid");
const loading = ref(false);
const favorites = ref([]);
const categories = ref([]);
const searchTimeout = ref(null);
const statistics = ref({
    total_favorites: 0,
    favorite_categories: 0,
    unique_users: 0,
    weekly_favorites: 0,
});
const mostFavoritedBook = ref(null);

// Search filter only
const filters = reactive({
    search: "",
});

const pagination = ref({
    current_page: 1,
    last_page: 1,
    total: 0,
    from: 0,
    to: 0,
    per_page: 15,
});

// Client-side filtering as fallback
const filteredFavorites = computed(() => {
    if (!filters.search || filters.search.trim() === "") {
        return favorites.value;
    }

    const searchTerm = filters.search.toLowerCase().trim();
    return favorites.value.filter(favorite => {
        const title = favorite.pdf_book?.title?.toLowerCase() || "";
        const description = favorite.pdf_book?.description?.toLowerCase() || "";
        const category = favorite.pdf_book?.category?.title?.toLowerCase() || "";

        return title.includes(searchTerm) ||
               description.includes(searchTerm) ||
               category.includes(searchTerm);
    });
});

// Load favorites with search
async function loadFavorites() {
    loading.value = true;
    try {
        LoadingModal();

        const params = {
            page: pagination.value.current_page,
            per_page: pagination.value.per_page,
        };

        // Try multiple parameter names that your API might expect
        if (filters.search && filters.search.trim() !== "") {
            params.search = filters.search.trim();
            // Uncomment these if needed
            // params.q = filters.search.trim();
            // params.keyword = filters.search.trim();
            // params.filter = filters.search.trim();
        }

        console.log("Loading favorites with params:", params);

        const response = await apiGetMyFavorites(params);

        console.log("API Response:", response.data);

        if (response.data?.success) {
            // Handle different response structures
            if (response.data.data && response.data.data.data) {
                // Laravel pagination structure
                favorites.value = response.data.data.data;
                pagination.value = {
                    current_page: response.data.data.current_page,
                    last_page: response.data.data.last_page,
                    total: response.data.data.total,
                    from: response.data.data.from,
                    to: response.data.data.to,
                    per_page: response.data.data.per_page,
                };
            } else if (Array.isArray(response.data.data)) {
                // Direct array response
                favorites.value = response.data.data;
                pagination.value = {
                    current_page: 1,
                    last_page: 1,
                    total: favorites.value.length,
                    from: 1,
                    to: favorites.value.length,
                    per_page: favorites.value.length,
                };
            } else if (response.data.data && Array.isArray(response.data.data.favorites)) {
                // Custom structure
                favorites.value = response.data.data.favorites;
                pagination.value = {
                    current_page: response.data.data.current_page || 1,
                    last_page: response.data.data.last_page || 1,
                    total: response.data.data.total || favorites.value.length,
                    from: response.data.data.from || 1,
                    to: response.data.data.to || favorites.value.length,
                    per_page: response.data.data.per_page || favorites.value.length,
                };
            } else {
                favorites.value = [];
                console.warn("Unexpected API response structure:", response.data);
            }
        } else {
            favorites.value = [];
            console.warn("API response not successful:", response.data);
        }

        CloseModal();
    } catch (error) {
        console.error("Load favorites error:", error);
        console.error("Error response:", error.response?.data);
        MessageModal(
            "error",
            "Error",
            error.response?.data?.message || "Failed to load favorites",
        );
    } finally {
        loading.value = false;
    }
}

// Debounced search
function debouncedSearch() {
    clearTimeout(searchTimeout.value);
    searchTimeout.value = setTimeout(() => {
        pagination.value.current_page = 1;
        loadFavorites();
    }, 500);
}

// Apply filters manually
function applyFilters() {
    pagination.value.current_page = 1;
    loadFavorites();
}

// Clear search
function clearSearch() {
    filters.search = "";
    pagination.value.current_page = 1;
    loadFavorites();
}

// Load statistics
async function loadStatistics() {
    try {
        const response = await apiGetFavoriteStatistics();
        if (response.data?.success) {
            statistics.value = response.data.data;
            if (response.data.data.most_favorited) {
                mostFavoritedBook.value = response.data.data.most_favorited;
            }
        }
    } catch (error) {
        console.error("Load statistics error:", error);
    }
}

// Load categories
async function loadCategories() {
    try {
        const response = await apiGetCategories();
        if (response.data?.success) {
            categories.value = response.data.data;
        }
    } catch (error) {
        console.error("Load categories error:", error);
    }
}

// Remove from favorites
async function removeFavorite(favorite) {
    const result = await ConfirmModal(
        "Remove from Favorites",
        `Are you sure you want to remove "${favorite.pdf_book?.title}" from your favorites?`,
        "warning",
    );

    if (result.isConfirmed) {
        try {
            LoadingModal();
            const response = await apiToggleFavorite(favorite.pdf_book?.id);

            if (response.data?.success) {
                // Remove from list
                favorites.value = favorites.value.filter(
                    (f) => f.id !== favorite.id,
                );
                CloseModal();
                Toast("success", "Book removed from favorites");
                await loadStatistics();

                // Reload favorites to update pagination if needed
                if (
                    favorites.value.length === 0 &&
                    pagination.value.current_page > 1
                ) {
                    pagination.value.current_page--;
                }
                await loadFavorites();
            }
        } catch (error) {
            CloseModal();
            console.error("Remove favorite error:", error);
            Toast("error", "Failed to remove from favorites");
        }
    }
}

// View book
async function viewBook(id) {
    try {
        LoadingModal();
        const response = await apiGetPDFBookID(id);
        CloseModal();
        if (response.data?.success) {
            router.push({ name: "pdf-book-view", params: { id } });
        }
    } catch (error) {
        CloseModal();
        console.error("View book error:", error);
        Toast("error", "Failed to load book details");
    }
}

// Change page
function changePage(page) {
    if (page < 1 || page > pagination.value.last_page) return;
    pagination.value.current_page = page;
    loadFavorites();
}

// Get serial number
function getSerialNumber(index) {
    return (
        (pagination.value.current_page - 1) * pagination.value.per_page +
        index +
        1
    );
}

// Format date
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

// Format number
function formatNumber(num) {
    return new Intl.NumberFormat().format(num);
}

// Truncate text
function truncateText(text, length) {
    if (!text) return "";
    return text.length > length ? text.substring(0, length) + "..." : text;
}

// Lifecycle
onMounted(async () => {
    await loadCategories();
    await loadStatistics();
    await loadFavorites();
});
</script>
