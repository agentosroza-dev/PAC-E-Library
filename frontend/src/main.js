import { createApp } from "vue";
import { createPinia } from "pinia";
import "./style.css";
import App from "./App.vue";
import router from "./router";
import i18n from "./i18n/i18n";
import store from "./functions/api/store"; // Import the store
// SweetAlert2
import Swal from "sweetalert2";
window.Swal = Swal;

// Axios
import axios from "axios";
window.axios = axios;

// Echo & Pusher
import Echo from "laravel-echo";
import Pusher from "pusher-js";
window.Pusher = Pusher;

// Enable Pusher/Echo debug logging if needed
// Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    wsPath: import.meta.env.VITE_REVERB_PATH ?? "",
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
    authorizer: (channel) => {
        return {
            authorize: (socketId, callback) => {
                axios
                    .post(
                        import.meta.env.VITE_API_URL + "/broadcasting/auth",
                        {
                            socket_id: socketId,
                            channel_name: channel.name,
                        },
                        {
                            headers: {
                                Authorization:
                                    "Bearer " +
                                    (localStorage.getItem("token") || ""),
                            },
                        },
                    )
                    .then((response) => callback(null, response.data))
                    .catch((error) => callback(error));
            },
        };
    },
});

window.API_URL = import.meta.env.VITE_API_URL;

const app = createApp(App);
const pinia = createPinia();

app.use(i18n);
app.use(router);
app.use(pinia);
app.use(store); // Register Vuex store
app.mount("#app");

// Router guard +++++++++++++++++++++++++++++++++++
router.beforeEach(async (to, from, next) => {
    console.log("Navigating to:", to.name);

    await store.dispatch("verifyAccount");
    const guard = Boolean(to.meta.guard);
    const isAuthenticated = Boolean(store.state.user !== null);

    if (!guard && isAuthenticated) {
        return next({ name: "home" });
    }
    if (guard && !isAuthenticated) {
        return next({ name: "auth.signin" });
    }

    return next();
});
