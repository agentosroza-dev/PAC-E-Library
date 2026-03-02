<!-- <template>
  <div
    class="min-h-screen bg-linear-to-br from-primary/5 via-base-200 to-secondary/5 flex items-center justify-center p-4"
  >

    <div class="absolute inset-0 overflow-hidden -z-10">
      <div
        class="absolute -top-40 -right-40 w-80 h-80 bg-primary/10 rounded-full blur-3xl"
      ></div>
      <div
        class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary/10 rounded-full blur-3xl"
      ></div>
    </div>


    <div v-if="loading" class="flex flex-col items-center gap-4">
      <span class="loading loading-spinner loading-lg text-primary"></span>
      <p class="text-base-content/70">Processing sign out...</p>
    </div>


    <div v-else class="card w-full max-w-md bg-base-100 shadow-2xl">

      <div class="card-header text-center pt-8 px-8">
        <router-link to="/" class="inline-block">
          <h1 class="text-4xl font-bold">
            <span class="text-primary">Admin</span>
            <span class="text-base-content">LTE</span>
          </h1>
        </router-link>
      </div>


      <div class="card-body px-8 pb-8 pt-4 text-center">

        <div class="flex justify-center mb-4">
          <div
            class="w-24 h-24 rounded-full bg-warning/20 flex items-center justify-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-12 h-12 text-warning"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="1.5"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
          </div>
        </div>


        <h2 class="text-2xl font-semibold text-base-content mb-2">
          Ready to Leave?
        </h2>
        <p class="text-base-content/70 mb-6">
          Are you sure you want to sign out of your account?
        </p>

        <div class="flex flex-col sm:flex-row gap-3 mt-4">
          <button
            @click="confirmSignOut"
            class="btn btn-primary flex-1 gap-2"
            :disabled="processing"
          >
            <svg
              v-if="!processing"
              xmlns="http://www.w3.org/2000/svg"
              class="w-5 h-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
              />
            </svg>
            <span
              v-if="processing"
              class="loading loading-spinner loading-sm"
            ></span>
            {{ processing ? "Signing out..." : "Yes, Sign Out" }}
          </button>

          <button
            @click="cancelSignOut"
            class="btn btn-outline flex-1"
            :disabled="processing"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="w-5 h-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
            Cancel
          </button>
        </div>


        <div class="mt-6">
          <router-link to="/" class="link link-primary text-sm link-hover">
            ← Return to Homepage
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
-->

<template>
    <div class="flex justify-center items-center">
        <p class="login-box-msg">Processing Logout authentication...!</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { postSignOut } from "@/functions/api/auth";
import { ConfirmModal ,SuccessModal} from "@/functions/swal";

const router = useRouter();
const loading = ref(true);
const processing = ref(false);

// Function to go back to previous route
function goBack() {
    if (window.history.length > 1) {
        router.back();
    } else {
        router.replace({ name: "home" });
    }
}

// Cancel sign out and go back
function cancelSignOut() {
    goBack();
}

// Confirm sign out
async function confirmSignOut() {
    processing.value = true;

    try {
        const token = localStorage.getItem("token");
        if (!token) {
            router.replace({ name: "auth.signin" });
            return;
        }

        await postSignOut(token);
        localStorage.removeItem("token");

        // Show success message
        await SuccessModal(
           "Signed Out!",
            "You have been successfully signed out.",
            "success",
             2000,
             true,
        );

        router.replace({ name: "auth.signin" });
    } catch (error) {
        processing.value = false;

        if (!error.response) {
            return MessageModal("error", "Error", error.message);
        }
        return MessageModal("error", "Error", error.response.data.message);
    }
}

// Initialize on mount
onMounted(async () => {
    const result = await ConfirmModal(
  "Are you sure?",
  "This action cannot be undone",
  "warning"
);

    if (result.isConfirmed) {
        await confirmSignOut();
    } else {
        loading.value = false;
        goBack();
    }
});
</script>

<style scoped>
/* Smooth transitions */
.card {
    animation: fadeIn 0.3s ease-out;
}

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

.btn {
    transition: all 0.2s ease;
}
</style>
