<template>
  <div class="login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <router-link to="/" class="h1"><b>Admin</b>LTE</router-link>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign up for a new membership</p>
          <form @submit.prevent="signUp">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Name" v-model="user.name"
                :class="{ 'is-invalid': !!userError.email }" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
              <!-- user invalid-feedback -->
              <div class="invalid-feedback">
                {{ userError.name }}
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email" v-model="user.email"
                :class="{ 'is-invalid': !!userError.email }" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <!-- email invalid-feedback -->
              <div class="invalid-feedback">
                {{ userError.password }}
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" v-model="user.password"
                :class="{ 'is-invalid': !!userError.password }" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              <!-- password invalid-feedback -->
              <div class="invalid-feedback">
                {{ userError.password }}
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Confirm Password"
                v-model="user.password_confirmation" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8"></div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign up</button>
              </div>
            </div>
          </form>
          <p class="mb-1">
            <router-link :to="{ name: 'auth.signin' }" class="text-center">I already have a membership</router-link>
          </p>
          <div class="social-auth-links text-center mt-2 mb-3">
  <button @click="googleSignUp" class="btn btn-block btn-danger">
    <i class="fab fa-google-plus mr-2"></i> Sign up using Google+
  </button>
</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

import { postSignUp } from '@func/api/auth';
import { useRoute } from 'vue-router';
import { LoadingModal, MessageModal, CloseModal } from "@func/swal";
import { reactive } from 'vue';
import Swal from 'sweetalert2';


const router = useRoute();

const user = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const userError = reactive({
  name: '',
  email: '',
  password: ''
});


// Add this function in the script setup section
function googleSignUp() {
  try {
    LoadingModal();
    window.location.href = `${window.API_URL}/auth/google`;
  } catch (e) {
    MessageModal(e, "Error", "Google sign-up failed");
  }
}
async function signUp() {

  try {
    LoadingModal();
    const response = await postSignUp(user);
    resetData();

    Swal.fire({
      title: "Success",
      text: response.data.message,
      icon: "success",
      showCancelButton: true,
      confirmButtonColor: "#28a745",
      cancelButtonColor: "#d33",
      confirmButtonText: "Go to Sign In",
    }).then((result) => {
      if (result.isConfirmed) {
        router.push({ name: "auth.signin" });
      }
    });
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

// function googleSignUp() {
//   try {
//     LoadingModal();
//     window.location.href = `${window.API_URL}/auth/google`;
//   } catch (error) {
//     MessageModal("error", "Error", "Google sign-up failed");
//   }
// }

const defaultUser = JSON.parse(JSON.stringify(user));
const defaultUserError = JSON.parse(JSON.stringify(userError));

function resetData() {
  Object.assign(user, defaultUser);
  Object.assign(userError, defaultUserError);
}
</script>
