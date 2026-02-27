<template>
  <div class="min-h-screen bg-base-200 flex items-center justify-center p-4">

    <!-- Main Card -->
     <div class="card w-96 max-w-md bg-base-100 shadow-xl">
      <div class="card-body">
        <!-- Logo/Header -->
        <div class="text-center mb-4">
          <router-link to="/" class="text-3xl font-bold text-primary">
            <b>Admin</b><span class="text-base-content">LTE</span>
          </router-link>
          <p class="text-base-content/70 mt-2 text-sm">
            Welcome back! Please sign in to continue
          </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="signIn" class="space-y-4">
          <!-- Email Field -->
          <div class="form-control w-full">
            <label class="label">
              <span class="label-text flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                  <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                  <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                </svg>
                Email Address
              </span>
            </label>
            <div class="relative">
              <input
                v-model="user.email"
                type="email"
                placeholder="your@email.com"
                class="input input-bordered w-full pl-10"
                :class="{ 'input-error': !!userError.email }"
              />
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                </svg>
              </span>
            </div>
            <label v-if="userError.email" class="label">
              <span class="label-text-alt text-error flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
                {{ userError.email }}
              </span>
            </label>
          </div>

          <!-- Password Field -->
          <div class="form-control w-full">
            <label class="label">
              <span class="label-text flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                  <path fill-rule="evenodd" d="M14 8a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5Zm-6.5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5ZM2.5 8a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5Z" clip-rule="evenodd" />
                </svg>
                Password
              </span>
              <label class="label">
                <router-link :to="{ name: 'auth.reset.password' }" class="label-text-alt link link-primary text-xs">
                  Forgot password?
                </router-link>
              </label>
            </label>
            <div class="relative">
              <input
                v-model="user.password"
                :type="showPassword ? 'text' : 'password'"
                placeholder="••••••••"
                class="input input-bordered w-full pl-10 pr-10"
                :class="{ 'input-error': !!userError.password }"
              />
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
              </span>
              <button
                type="button"
                @click="togglePassword"
                class="absolute right-3 top-1/2 -translate-y-1/2 text-base-content/40 hover:text-base-content/70"
              >
                <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>
                <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </button>
            </div>
            <label v-if="userError.password" class="label">
              <span class="label-text-alt text-error flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                </svg>
                {{ userError.password }}
              </span>
            </label>
          </div>

          <!-- Remember Me -->
          <div class="flex items-center justify-between">
            <label class="cursor-pointer flex items-center gap-2">
              <input type="checkbox" checked class="checkbox checkbox-primary checkbox-sm" />
              <span class="label-text text-sm">Remember me</span>
            </label>
          </div>

          <!-- Sign In Button -->
          <button type="submit" class="btn btn-primary w-full mt-4" :disabled="loading">
            <span v-if="loading" class="loading loading-spinner loading-sm"></span>
            <span v-else>Sign In</span>
          </button>
        </form>

        <!-- Divider -->
        <div class="divider my-6">OR</div>

        <!-- Google Sign In -->
        <button @click="googleSignIn" class="btn btn-outline btn-error w-full gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
          </svg>
          Sign in with Google
        </button>

        <!-- Sign Up Link -->
        <p class="text-center text-sm mt-4">
          Don't have an account?
          <router-link :to="{ name: 'auth.signup' }" class="link link-primary font-medium">
            Sign up
          </router-link>
        </p>

        <!-- Demo Credentials -->
        <div class="alert alert-info mt-4 text-sm shadow-sm">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <div class="flex flex-col">
            <span class="font-medium">Demo Credentials:</span>
            <span class="text-xs opacity-80">admin@example.com / password</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from "vue-router";
import { reactive, ref } from "vue";
import { postSignIn } from "@func/api/auth";
import { LoadingModal, MessageModal, CloseModal } from "@func/swal";

const router = useRouter();
const loading = ref(false);
const showPassword = ref(false);

const user = reactive({
  email: "",
  password: "",
});

const userError = reactive({
  email: "",
  password: "",
});

const togglePassword = () => {
  showPassword.value = !showPassword.value;
};

function googleSignIn() {
  try {
    LoadingModal();
    window.location.href = `${window.API_URL}/auth/google`;
    // Remove router.replace from here - it will execute before redirect
    CloseModal();
  } catch (e) {
    MessageModal("error", "Error", "Google sign-in failed");
  }
}

async function signIn() {
  try {
    loading.value = true;
    LoadingModal();
    const response = await postSignIn(user);
    localStorage.setItem("token", response.data.token);
    resetData();
    router.replace({ name: "home" });
    CloseModal();
  } catch (error) {
    CloseModal();
    if (!error.response) {
      return MessageModal("error", "Error", error.message);
    }
    if (error.response.status === 422) {
      Object.keys(userError).forEach((key) => {
        userError[key] = error.response.data.errors[key]
          ? error.response.data.errors[key][0]
          : "";
      });
      return;
    }
    return MessageModal("error", "Error", error.response.data.message);
  } finally {
    loading.value = false;
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
.btn, .input {
  transition: all 0.2s ease;
}
</style>
