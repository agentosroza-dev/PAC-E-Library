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
            Enter your new password
          </p>
        </div>

        <!-- Form -->
        <form @submit.prevent="setNewPassword" class="space-y-4">
          <!-- Password Field -->
          <div class="form-control w-full flex justify-center ">
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': !!userError.password }">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                <path fill-rule="evenodd" d="M14 8a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5Zm-6.5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5ZM2.5 8a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5Z" clip-rule="evenodd" />
              </svg>
              <input
                v-model="user.password"
                type="password"
                class="grow"
                placeholder="New Password"
              />
            </label>
            <label v-if="userError.password" class="label">
              <span class="label-text-alt text-error">{{ userError.password }}</span>
            </label>
          </div>

          <!-- Confirm Password Field -->
          <div class="form-control w-full flex justify-center ">
            <label class="input input-bordered flex items-center gap-2" :class="{ 'input-error': !!userError.password_confirmation }">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 opacity-70">
                <path fill-rule="evenodd" d="M14 8a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h6a.5.5 0 0 1 .5.5Zm-6.5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5ZM2.5 8a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5Zm5-3a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5Z" clip-rule="evenodd" />
              </svg>
              <input
                v-model="user.password_confirmation"
                type="password"
                class="grow"
                placeholder="Confirm New Password"
              />
            </label>
            <label v-if="userError.password_confirmation" class="label">
              <span class="label-text-alt text-error">{{ userError.password_confirmation }}</span>
            </label>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-center mt-6">
            <button type="submit" class="btn btn-primary">
              Reset Password
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
import { reactive } from "vue";
import { useRoute, useRouter } from "vue-router";
import { LoadingModal, MessageModal, CloseModal } from "@func/swal";
import axios from "axios";

const route = useRoute();
const router = useRouter();

const user = reactive({
  password: "",
  password_confirmation: "",
});

const userError = reactive({
  password: "",
  password_confirmation: "",
});

async function setNewPassword() {
  try {
    LoadingModal();

    // Make sure to use the full URL
    const apiUrl = route.params.api_url;
    const response = await axios.post(apiUrl, user);

    resetData();
    CloseModal();

    // Show success message with SweetAlert2
    const result = await Swal.fire({
      title: response.data.message || "Password Reset Successful",
      text: "You can now sign in with your new password.",
      icon: "success",
      showCancelButton: true,
      confirmButtonText: "Go to Sign In",
      cancelButtonText: "Stay Here",
      confirmButtonColor: "#3b82f6",
      cancelButtonColor: "#6b7280",
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
      // Handle validation errors
      const errors = error.response.data.errors || {};

      // Reset errors
      userError.password = "";
      userError.password_confirmation = "";

      // Set new errors
      if (errors.password) {
        userError.password = errors.password[0];
      }
      if (errors.password_confirmation) {
        userError.password_confirmation = errors.password_confirmation[0];
      }

      return;
    }

    return MessageModal("error", "Error", error.response.data.message || "Something went wrong");
  }
}

// Reset form data
function resetData() {
  user.password = "";
  user.password_confirmation = "";
  userError.password = "";
  userError.password_confirmation = "";
}
</script>

<style scoped>
/* Optional: Add animation */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.card {
  animation: fadeIn 0.3s ease-out;
}

/* Smooth transitions */
.btn, .input {
  transition: all 0.2s ease;
}
</style>
