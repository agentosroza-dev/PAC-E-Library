import { createRouter, createWebHistory } from "vue-router";
import AboutView from "@/views/AboutView.vue";
import Navbar from "@/views/Layouts/Navbar.vue";
import SideBar from "@/views/Layouts/SideBar.vue";
import Footer from "@/views/Layouts/Footer.vue";
import SignIn from "@/views/auth/SignIn.vue";
import SignOut from "@/views/auth/SignOut.vue";
import SignUp from "@/views/auth/SignUp.vue";
import VerifyEmail from "@/views/auth/VerifyEmail.vue";
import ResetPassword from "@/views/auth/ResetPassword.vue";
import SetNewPassword from "@/views/auth/SetNewPassword.vue";
import GoogleCallback from "@/views/auth/GoogleCallback.vue";
import GoogleCallbackError from "@/views/auth/GoogleCallbackError.vue";
import UserProfile from "@/views/auth/UserProfile.vue";
import IndexPdf from "@/views/pdfs/IndexPdf.vue";
import Dashboard from "../views/Dashboard.vue";
import HomeView from "@/views/HomeView.vue";
import FevoritePdf from "@/views/pdfs/FevoritePdf.vue";

function authorize(roles) {
    return (to, from, next) => {
        import("@/functions/api/store").then(({ default: store }) => {
            const user = store.state.user;
            console.dir(user);
            if (user && roles.includes(user.level)) {
                return next();
            }
            return next({ name: "home" });
        });
    };
}

const includes = {
    navbar: Navbar,
    sidebar: SideBar,
    footer: Footer,
};

const routes = [
    {
        path: "/",
        name: "home",
        components: {
            default: HomeView,
            ...includes,
        },
        meta: { guard: true },
    },
    {
        path: "/pdfbook",
        name: "pdfbook",
        components: {
            default: IndexPdf,
            ...includes,
        },
        meta: { guard: true },
    },
    {
        path: "/favorites",
        name: "favorites",
        components: {
            default: FevoritePdf,
            ...includes,
        },
        meta: { guard: true },
    },
    {
        path: "/dashboard",
        name: "dashboard",
        components: {
            default: Dashboard,
            ...includes,
        },
        meta: { guard: true },
        beforeEnter: authorize(["admin"]),
    },
    {
        path: "/about",
        name: "about",
        components: {
            default: AboutView,
            ...includes,
        },
        meta: { guard: true },
        //   beforeEnter: authorize(['admin']),
    },
    {
        path: "/profile",
        name: "profile",
        components: {
            default: UserProfile,
            ...includes,
        },
        meta: { guard: true },
    },
    {
        path: "/pdfbook",
        name: "pdfbook",
        components: {
            default: IndexPdf,
            ...includes,
        },
        meta: { guard: true },
    },
    {
        path: "/",
        name: "auth.signin",
        component: SignIn,
        meta: { guard: false },
    },
    {
        path: "/signout",
        name: "auth.signout",
        component: SignOut,
        meta: { guard: true },
    },
    {
        path: "/signup",
        name: "auth.signup",
        component: SignUp,
        meta: { guard: false },
    },
    {
        path: "/email/verify/:api_url",
        name: "auth.verify.email",
        component: VerifyEmail,
        meta: { guard: false },
    },
    {
        path: "/password/reset",
        name: "auth.reset.password",
        component: ResetPassword,
        meta: { guard: false },
    },
    {
        path: "/password/reset/:api_url",
        name: "auth.set.password",
        component: SetNewPassword,
        meta: { guard: false },
    },
    {
        path: "/auth/google/callback",
        name: "auth.google.callback",
        component: GoogleCallback,
        meta: { guard: false },
    },
    {
        path: "/auth/google/callback/error",
        name: "auth.google.callback.error",
        component: GoogleCallbackError,
        meta: { guard: false },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        // Scroll to top on route change
        return { top: 0 };
    },
});

export default router;
