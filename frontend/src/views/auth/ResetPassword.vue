<template>
  <div class="min-h-screen bg-base-200 flex items-center justify-center p-4">
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
      <div class="card-body">
        <!-- Logo/Header -->
        <div class="text-center mb-4">
          <router-link to="/" class="text-3xl font-bold text-primary">
            <b>Admin</b><span class="text-base-content">LTE</span>
          </router-link>
          <p class="text-base-content/70 mt-2 text-sm">
            Enter your email to receive a password reset link
          </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="requestResetLink" class="space-y-4">
          <!-- Email Field -->
          <div class="form-control w-full flex justify-center ">
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': !!userError.email }">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                <path d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                <path d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
              </svg>
              <input
                v-model="user.email"
                type="email"
                class="grow"
                placeholder="Email"
              />
            </label>
            <label v-if="userError.email" class="label">
              <span class="label-text-alt text-error">{{ userError.email }}</span>
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center  mt-6">
            <button type="submit" class="btn btn-primary">
              Send Reset Link
            </button>
          </div>
        </form>

        <!-- Links -->
        <div class="divider my-4">OR</div>

        <div class="space-y-2 text-center">
          <p>
            <router-link :to="{ name: 'auth.signin' }" class="link link-primary link-hover text-sm">
              ← Go back to login
            </router-link>
          </p>
          <p>
            <router-link :to="{ name: 'auth.signup' }" class="link link-primary link-hover text-sm">
              Register a new membership
            </router-link>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>



<script setup>
import { useRouter } from "vue-router";
import { reactive } from "vue";
import { postRequestResetLink } from "@func/api/auth";
import { LoadingModal, MessageModal, CloseModal } from "@func/swal";
const router = useRouter();

const user = reactive({
  email: "",
});

const userError = reactive({
  email: "",
});

async function requestResetLink() {
  try {
    LoadingModal();
    const response = await postRequestResetLink(user);
    resetData();
    MessageModal("success", "Success", response.data.message);
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

const defaultUser = JSON.parse(JSON.stringify(user));
const defaultUserError = JSON.parse(JSON.stringify(userError));

function resetData() {
  Object.assign(user, defaultUser);
  Object.assign(userError, defaultUserError);
}
</script>
