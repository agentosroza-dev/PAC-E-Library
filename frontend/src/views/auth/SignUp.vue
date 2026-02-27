<template>
    <div class="min-h-screen bg-base-200 flex items-center justify-center p-4">
        <div class="card w-96 max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <!-- Logo/Header -->
                <div class="text-center mb-4">
                    <router-link to="/" class="text-3xl font-bold text-primary">
                        <b>Admin</b><span class="text-base-content">LTE</span>
                    </router-link>
                    <p class="text-base-content/70 mt-2 text-sm">
                        Sign up for a new membership
                    </p>
                </div>

                <!-- Form -->
                <form @submit.prevent="signUp" class="space-y-4">
                    <!-- Name Field -->
                    <div class="form-control w-full flex justify-center">
                        <label
                            class="input input-bordered flex items-center gap-2"
                            :class="{ 'input-error': !!userError.name }"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="w-4 h-4 opacity-70"
                            >
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM12.735 14c.618 0 1.093-.561.872-1.139a6.002 6.002 0 0 0-11.215 0c-.22.578.254 1.139.872 1.139h9.47Z"
                                />
                            </svg>
                            <input
                                v-model="user.name"
                                type="text"
                                class="grow"
                                placeholder="Full Name"
                            />
                        </label>
                        <label v-if="userError.name" class="label">
                            <span class="label-text-alt text-error">{{
                                userError.name
                            }}</span>
                        </label>
                    </div>

                    <!-- Email Field -->
                    <div class="form-control w-full flex justify-center">
                        <label
                            class="input input-bordered flex items-center gap-2"
                            :class="{ 'input-error': !!userError.email }"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="w-4 h-4 opacity-70"
                            >
                                <path
                                    d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z"
                                />
                                <path
                                    d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z"
                                />
                            </svg>
                            <input
                                v-model="user.email"
                                type="email"
                                class="grow"
                                placeholder="Email"
                            />
                        </label>
                        <label v-if="userError.email" class="label">
                            <span class="label-text-alt text-error">{{
                                userError.email
                            }}</span>
                        </label>
                    </div>

                    <!-- Password Field -->
                    <div class="form-control w-full flex justify-center">
                        <label
                            class="input input-bordered flex items-center gap-2"
                            :class="{ 'input-error': !!userError.password }"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="w-4 h-4 opacity-70"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M14 8a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5Zm-6.5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5ZM2.5 8a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <input
                                v-model="user.password"
                                type="password"
                                class="grow"
                                placeholder="Password"
                            />
                        </label>
                        <label v-if="userError.password" class="label">
                            <span class="label-text-alt text-error">{{
                                userError.password
                            }}</span>
                        </label>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-control w-full flex justify-center">
                        <label
                            class="input input-bordered flex items-center gap-2"
                            :class="{
                                'input-error':
                                    !!userError.password_confirmation,
                            }"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 16 16"
                                fill="currentColor"
                                class="w-4 h-4 opacity-70"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M14 8a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5Zm-6.5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5ZM2.5 8a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5Z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            <input
                                v-model="user.password_confirmation"
                                type="password"
                                class="grow"
                                placeholder="Confirm Password"
                            />
                        </label>
                        <label
                            v-if="userError.password_confirmation"
                            class="label"
                        >
                            <span class="label-text-alt text-error">{{
                                userError.password_confirmation
                            }}</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center mt-6">
                        <button type="submit" class="btn btn-primary">
                            Sign Up
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="divider my-4">OR</div>

                <!-- Google Sign Up -->
                <div class="form-control w-full flex justify-center">

                    <button @click="googleSignUp" class="btn btn-outline btn-error w-full gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4"
                            />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853"
                            />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05"
                            />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335"
                            />
                        </svg>
                        Sign up with Google
                    </button>
                </div>

                <!-- Sign In Link -->
                <p class="text-center text-sm mt-4">
                    Already have an account?
                    <router-link
                        :to="{ name: 'auth.signin' }"
                        class="link link-primary font-medium"
                    >
                        Sign in
                    </router-link>
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { useRouter } from "vue-router";
import { postSignUp } from "@func/api/auth";
import { LoadingModal, MessageModal, CloseModal } from "@func/swal";
import Swal from "sweetalert2";

const router = useRouter();

const user = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const userError = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

function googleSignUp() {
    try {
        LoadingModal();
        window.location.href = `${window.API_URL}/auth/google`;
    } catch (e) {
        MessageModal("error", "Error", "Google sign-up failed");
    }
}

async function signUp() {
    try {
        LoadingModal();
        const response = await postSignUp(user);
        resetData();
        CloseModal();

        const result = await Swal.fire({
            title: "Success!",
            text:
                response.data.message ||
                "Your account has been created successfully.",
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#3b82f6",
            cancelButtonColor: "#ef4444",
            confirmButtonText: "Go to Sign In",
            cancelButtonText: "Stay Here",
        });

        if (result.isConfirmed) {
            router.push({ name: "auth.signin" });
        }
    } catch (error) {
        CloseModal();

        if (!error.response) {
            return MessageModal("error", "Connection Error", error.message);
        }

        if (error.response.status === 422) {
            // Reset errors
            Object.keys(userError).forEach((key) => (userError[key] = ""));

            // Set new errors
            const errors = error.response.data.errors || {};
            Object.keys(errors).forEach((key) => {
                if (userError.hasOwnProperty(key)) {
                    userError[key] = errors[key][0];
                }
            });
            return;
        }

        return MessageModal(
            "error",
            "Error",
            error.response.data.message || "Something went wrong",
        );
    }
}

const defaultUser = JSON.parse(JSON.stringify(user));
const defaultUserError = JSON.parse(JSON.stringify(userError));

function resetData() {
    Object.assign(user, defaultUser);
    Object.assign(userError, defaultUserError);
}
</script>

<style scoped>
/* Smooth transitions */
.input,
.btn {
    transition: all 0.2s ease;
}
</style>
