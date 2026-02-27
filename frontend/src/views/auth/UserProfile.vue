<template>
    <div class="min-h-screen bg-base-100">
        <!-- Page Header -->
        <div class="bg-base-200 shadow-sm border-b border-base-300 m-4 rounded-xl">
            <div class="container mx-auto px-4 py-4">
                <div
                    class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4"
                >
                    <div>
                        <h3
                            class="text-3xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent"
                        >
                            Profile
                        </h3>
                        <p class="text-base-content/70 text-sm mt-1">
                            Manage your account settings and preferences
                        </p>
                    </div>
                    <div class="text-sm breadcrumbs">
                        <ul>
                            <li>
                                <router-link
                                    :to="{ name: 'home' }"
                                    class="link link-hover flex items-center gap-1"
                                >
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
                                    Home
                                </router-link>
                            </li>
                            <li class="flex items-center gap-1">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Profile
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Profile Photo Column -->
                <div class="lg:col-span-4">
                    <div
                        class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow duration-300"
                    >
                        <div class="card-body items-center text-center">
                            <!-- Profile Photo with Status -->
                            <div class="avatar relative">
                                <div
                                    class="w-48 h-48 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4"
                                >
                                    <img
                                        :src="tempPhoto"
                                        :alt="userData.name"
                                        class="object-cover"
                                    />
                                </div>
                                <div>
                                    <!-- Online Status Badge -->
                                    <div
                                        class="absolute bottom-2 right-2 w-5 h-5 bg-success border-4 border-base-100 rounded-full"
                                    ></div>

                                    <!-- Photo Actions Toolbar -->
                                    <div
                                        class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 flex gap-1 bg-base-100 rounded-full shadow-xl p-1.5"
                                    >
                                        <!-- Upload Button -->
                                        <label
                                            for="file-input"
                                            class="btn btn-circle btn-primary btn-xs sm:btn-sm tooltip"
                                            data-tip="Upload photo"
                                        >
                                            <input
                                                @change="onUpdatePhoto($event)"
                                                type="file"
                                                class="hidden"
                                                :accept="
                                                    allowedExtensions
                                                        .map((ext) => '.' + ext)
                                                        .join(', ')
                                                "
                                                id="file-input"
                                            />
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </label>

                                        <!-- Delete Button -->
                                        <button
                                            @click="onDeletePhoto()"
                                            class="btn btn-circle btn-error btn-xs sm:btn-sm tooltip"
                                            data-tip="Delete photo"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>

                                        <!-- Reset Button -->
                                        <button
                                            @click="onResetPhoto()"
                                            class="btn btn-circle btn-ghost btn-xs sm:btn-sm tooltip"
                                            data-tip="Reset photo"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>

                                        <!-- Save Button (shows only when photo is changed) -->
                                        <button
                                            v-if="changedPhoto"
                                            @click="updatePhoto()"
                                            class="btn btn-circle btn-success btn-xs sm:btn-sm tooltip"
                                            data-tip="Save changes"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="mt-8 space-y-2">
                                <h2 class="text-2xl font-bold">
                                    {{ userData.name }}
                                </h2>
                                <div
                                    class="badge badge-primary badge-outline px-4 py-3"
                                >
                                    Software Engineer
                                </div>
                            </div>

                            <!-- Stats Grid -->
                            <div
                                class="grid grid-cols-3 gap-4 w-full mt-6 pt-6 border-t border-base-300"
                            >
                                <div class="statistic">
                                    <div
                                        class="stat-value text-2xl text-primary"
                                    >
                                        1.3K
                                    </div>
                                    <div class="stat-desc text-xs">
                                        Followers
                                    </div>
                                </div>
                                <div class="statistic">
                                    <div
                                        class="stat-value text-2xl text-secondary"
                                    >
                                        543
                                    </div>
                                    <div class="stat-desc text-xs">
                                        Following
                                    </div>
                                </div>
                                <div class="statistic">
                                    <div
                                        class="stat-value text-2xl text-accent"
                                    >
                                        13K
                                    </div>
                                    <div class="stat-desc text-xs">Friends</div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 w-full mt-4">
                                <button
                                    class="btn btn-outline btn-primary flex-1"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 mr-1"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"
                                        />
                                        <path
                                            d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"
                                        />
                                    </svg>
                                    Message
                                </button>
                                <button class="btn btn-primary flex-1">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 mr-1"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                    >
                                        <path
                                            d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"
                                        />
                                    </svg>
                                    Follow
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info Card -->
                    <div class="card bg-base-100 shadow-xl mt-6">
                        <div class="card-body">
                            <h3 class="card-title text-lg">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-primary"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Account Info
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-base-content/70"
                                        >Member since</span
                                    >
                                    <span class="font-medium"
                                        >January 2024</span
                                    >
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-base-content/70"
                                        >Last active</span
                                    >
                                    <span class="font-medium"
                                        >2 minutes ago</span
                                    >
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-base-content/70"
                                        >Email verified</span
                                    >
                                    <span class="badge badge-success badge-sm"
                                        >Yes</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Password Settings Column -->
                <div class="lg:col-span-8">
                    <!-- Tabs -->
                    <div class="tabs tabs-boxed bg-base-100 mb-6 p-1">
                        <a class="tab tab-active gap-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Password Settings
                        </a>
                        <a class="tab gap-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                                />
                            </svg>
                            Profile Info
                        </a>
                        <a class="tab gap-2">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Preferences
                        </a>
                    </div>

                    <!-- Password Settings Card -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6">
                                Change Password
                            </h2>

                            <form
                                @submit.prevent="changePassword"
                                class="space-y-6"
                            >
                                <!-- Old Password (shown only if password exists) -->
                                <div
                                    v-if="!userData.password_null"
                                    class="form-control w-full"
                                >
                                    <label class="label">
                                        <span class="label-text font-medium"
                                            >Current Password</span
                                        >
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="user.old_password"
                                            type="password"
                                            placeholder="Enter your current password"
                                            class="input input-bordered w-full pr-10"
                                            :class="{
                                                'input-error':
                                                    userError.old_password,
                                            }"
                                        />
                                        <span
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-base-content/40"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </span>
                                    </div>
                                    <label
                                        v-if="userError.old_password"
                                        class="label"
                                    >
                                        <span
                                            class="label-text-alt text-error flex items-center gap-1"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ userError.old_password }}
                                        </span>
                                    </label>
                                </div>

                                <!-- New Password with Strength Meter -->
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text font-medium"
                                            >New Password</span
                                        >
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="user.new_password"
                                            type="password"
                                            placeholder="Enter new password"
                                            class="input input-bordered w-full pr-10"
                                            :class="{
                                                'input-error':
                                                    userError.new_password,
                                            }"
                                        />
                                        <span
                                            class="absolute right-3 top-1/2 -translate-y-1/2 text-base-content/40"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </span>
                                    </div>

                                    <!-- Password Strength Indicator -->
                                    <div class="mt-2" v-if="user.new_password">
                                        <div class="flex gap-1 mb-1">
                                            <div
                                                class="h-1 flex-1 rounded-full"
                                                :class="
                                                    getPasswordStrengthClass(0)
                                                "
                                            ></div>
                                            <div
                                                class="h-1 flex-1 rounded-full"
                                                :class="
                                                    getPasswordStrengthClass(1)
                                                "
                                            ></div>
                                            <div
                                                class="h-1 flex-1 rounded-full"
                                                :class="
                                                    getPasswordStrengthClass(2)
                                                "
                                            ></div>
                                            <div
                                                class="h-1 flex-1 rounded-full"
                                                :class="
                                                    getPasswordStrengthClass(3)
                                                "
                                            ></div>
                                        </div>
                                        <span
                                            class="text-xs"
                                            :class="
                                                getPasswordStrengthTextClass()
                                            "
                                        >
                                            {{ getPasswordStrengthText() }}
                                        </span>
                                    </div>

                                    <label
                                        v-if="userError.new_password"
                                        class="label"
                                    >
                                        <span
                                            class="label-text-alt text-error flex items-center gap-1"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            {{ userError.new_password }}
                                        </span>
                                    </label>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-control w-full">
                                    <label class="label">
                                        <span class="label-text font-medium"
                                            >Confirm Password</span
                                        >
                                    </label>
                                    <div class="relative">
                                        <input
                                            v-model="
                                                user.new_password_confirmation
                                            "
                                            type="password"
                                            placeholder="Confirm your new password"
                                            class="input input-bordered w-full pr-10"
                                            :class="{
                                                'input-success':
                                                    user.new_password &&
                                                    user.new_password_confirmation &&
                                                    user.new_password ===
                                                        user.new_password_confirmation,
                                                'input-error':
                                                    user.new_password_confirmation &&
                                                    user.new_password !==
                                                        user.new_password_confirmation,
                                            }"
                                        />
                                        <span
                                            class="absolute right-3 top-1/2 -translate-y-1/2"
                                        >
                                            <svg
                                                v-if="
                                                    user.new_password &&
                                                    user.new_password_confirmation &&
                                                    user.new_password ===
                                                        user.new_password_confirmation
                                                "
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-success"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    user.new_password_confirmation &&
                                                    user.new_password !==
                                                        user.new_password_confirmation
                                                "
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-error"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <!-- Password Requirements -->
                                <div class="bg-base-200 rounded-lg p-4">
                                    <p class="text-sm font-medium mb-2">
                                        Password requirements:
                                    </p>
                                    <ul class="text-xs space-y-1">
                                        <li
                                            class="flex items-center gap-2"
                                            :class="
                                                hasMinLength
                                                    ? 'text-success'
                                                    : 'text-base-content/60'
                                            "
                                        >
                                            <svg
                                                v-if="hasMinLength"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            <svg
                                                v-else
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            At least 8 characters
                                        </li>
                                        <li
                                            class="flex items-center gap-2"
                                            :class="
                                                hasUpperCase
                                                    ? 'text-success'
                                                    : 'text-base-content/60'
                                            "
                                        >
                                            <svg
                                                v-if="hasUpperCase"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            <svg
                                                v-else
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            At least one uppercase letter
                                        </li>
                                        <li
                                            class="flex items-center gap-2"
                                            :class="
                                                hasNumber
                                                    ? 'text-success'
                                                    : 'text-base-content/60'
                                            "
                                        >
                                            <svg
                                                v-if="hasNumber"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            <svg
                                                v-else
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                            At least one number
                                        </li>
                                    </ul>
                                </div>

                                <!-- Terminate Sessions Checkbox -->
                                <div class="form-control">
                                    <label
                                        class="label cursor-pointer justify-start gap-3 p-0"
                                    >
                                        <input
                                            v-model="user.terminate_sessions"
                                            type="checkbox"
                                            class="checkbox checkbox-primary checkbox-sm"
                                        />
                                        <span class="label-text"
                                            >Sign out from all other
                                            devices</span
                                        >
                                    </label>
                                    <span
                                        class="text-xs text-base-content/50 mt-1"
                                    >
                                        This will invalidate all active sessions
                                        except this one
                                    </span>
                                </div>

                                <!-- Form Actions -->
                                <div
                                    class="card-actions justify-end gap-3 pt-4 border-t border-base-300"
                                >
                                    <button
                                        type="reset"
                                        class="btn btn-ghost btn-outline"
                                    >
                                        Cancel
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-primary px-8"
                                        :disabled="!isPasswordValid"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 mr-2"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import emptyPhoto from "@assets/images/emptyPhoto.png";
import { CloseModal, LoadingModal, MessageModal } from "@func/swal";
import { useRouter } from "vue-router";
import { computed, reactive, ref, watch } from "vue";
import {
    patchChangePassword,
    patchCreatePassword,
    patchUpdateUserPhoto,
} from "@func/api/auth";
import store from "@/functions/api/store";

const userData = computed(() => store.state.user);
const userPhoto = computed(() => store.state.user.photo);
const router = useRouter();

// Password form state
const user = reactive({
    old_password: "",
    new_password: "",
    new_password_confirmation: "",
    terminate_sessions: false,
});

const userError = reactive({
    old_password: "",
    new_password: "",
});

// Password validation
const hasMinLength = computed(() => user.new_password.length >= 8);
const hasUpperCase = computed(() => /[A-Z]/.test(user.new_password));
const hasNumber = computed(() => /[0-9]/.test(user.new_password));
const isPasswordValid = computed(() => {
    return hasMinLength.value && hasUpperCase.value && hasNumber.value;
});

function getPasswordStrength() {
    if (!user.new_password) return 0;
    let strength = 0;
    if (hasMinLength.value) strength++;
    if (hasUpperCase.value) strength++;
    if (hasNumber.value) strength++;
    return strength;
}

function getPasswordStrengthClass(index) {
    const strength = getPasswordStrength();
    if (index < strength) {
        if (strength === 1) return "bg-error";
        if (strength === 2) return "bg-warning";
        if (strength === 3) return "bg-success";
    }
    return "bg-base-300";
}

function getPasswordStrengthText() {
    const strength = getPasswordStrength();
    if (strength === 0) return "Weak password";
    if (strength === 1) return "Weak password";
    if (strength === 2) return "Medium password";
    return "Strong password";
}

function getPasswordStrengthTextClass() {
    const strength = getPasswordStrength();
    if (strength === 0 || strength === 1) return "text-error";
    if (strength === 2) return "text-warning";
    return "text-success";
}

// Photo management
const allowedExtensions = ["jpg", "jpeg", "png"];
const tempPhoto = ref(null);

// Watch for user photo changes
watch(
    () => userPhoto.value,
    (nv) => {
        if (nv === null) {
            return (tempPhoto.value = emptyPhoto);
        }
        return (tempPhoto.value = nv);
    },
    { immediate: true },
);

const changedPhoto = computed(
    () =>
        (tempPhoto.value !== emptyPhoto &&
            tempPhoto.value !== userPhoto.value) ||
        (tempPhoto.value === emptyPhoto && userPhoto.value !== null),
);

// Password change handler
async function changePassword() {
    try {
        LoadingModal();
        let response;
        if (userData.value.password_null) {
            response = await patchCreatePassword(user);
        } else {
            response = await patchChangePassword(user);
        }
        await MessageModal("success", "Success", response.data.message, () =>
            router.push({ name: "home" }),
        );
    } catch (error) {
        if (!error.response) {
            return MessageModal("error", "Error", error.message);
        }
        if (error.response.status === 422) {
            Object.keys(userError).forEach((key) => {
                userError[key] = error.response.data.errors[key]
                    ? error.response.data.errors[key][0]
                    : "";
            });
            return CloseModal();
        }
        return MessageModal("error", "Error", error.response.data.message);
    }
}

// Photo handlers
function onUpdatePhoto(event) {
    const files = event.target.files;
    if (files && files.length > 0) {
        const fileName = files[0].name;
        const idxDot = fileName.lastIndexOf(".") + 1;
        const extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

        if (!allowedExtensions.includes(extFile)) {
            return MessageModal(
                "error",
                "Error",
                "Only jpg/jpeg and png files are allowed!",
            );
        }

        const reader = new FileReader();
        reader.onloadend = function () {
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                canvas.width = 454;
                canvas.height = 454;

                const size = Math.min(img.width, img.height);
                const x = (img.width - size) / 2;
                const y = (img.height - size) / 2;

                ctx.drawImage(img, x, y, size, size, 0, 0, 454, 454);
                tempPhoto.value = canvas.toDataURL("image/png");
            };
            img.src = reader.result;
        };
        reader.readAsDataURL(files[0]);
        event.target.value = null;
    }
}

function onDeletePhoto() {
    tempPhoto.value = emptyPhoto;
}

function onResetPhoto() {
    tempPhoto.value = userPhoto.value ? userPhoto.value : emptyPhoto;
}

async function updatePhoto() {
    try {
        LoadingModal();
        if (tempPhoto.value === emptyPhoto) {
            tempPhoto.value = null;
        }
        const response = await patchUpdateUserPhoto({ photo: tempPhoto.value });
        store.commit("setUserPhoto", response.data.photo);
        await MessageModal("success", "Success", response.data.message);
    } catch (error) {
        return MessageModal(
            "error",
            "Error",
            error.response?.data?.message || error.message,
        );
    }
}
</script>
