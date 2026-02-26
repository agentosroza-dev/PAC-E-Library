<template>
    <div id="app">
        <!-- Navigation Links -->
        <nav>
            <router-link to="/">{{ $t("gotohome") }}</router-link>
            <router-link to="/about">{{ $t("gotoabout") }}</router-link>
        </nav>
        <!-- Route content displays here -->
        <router-view />
    </div>
</template>

<script></script>
