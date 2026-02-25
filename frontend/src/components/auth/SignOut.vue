<template>
  <div class="login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <router-link to="/" class="h1"><b>Admin</b>LTE</router-link>
        </div>
        <div class="card-body">
          <p class="login-box-msg">You have been signed out</p>
          <p class="mb-0">
            <router-link :to="{ name: 'auth.signin' }" class="text-center"
              >Sign in again</router-link
            >
          </p>

        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { postSignOut } from "@/functions/api/auth";
import { MessageModal } from "@/functions/swal";
import { onMounted } from "vue";
import { useRouter } from "vue-router";
const router = useRouter();

onMounted(async () => {
    await window.Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to logout this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, logout it!"
    }).then((result) => {
        if (result.isConfirmed) {
            try {
                const token = localStorage.getItem("token");
                postSignOut(token);
                localStorage.removeItem("token");
                return router.replace({ name: "auth.signin" });
            } catch (error) {
                if (!error.response) {
                    return MessageModal("error", "Error", error.message);
                }
                return MessageModal("error", "Error", error.response.data.message);
            }
        }
        return router.replace({ name: "dashboard" });
        // return router.back();
    });

});

</script>
