<script setup>
import Navbar from "./components/navigation/Navbar.vue";
</script>
<template>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-3xl my-5 font-bold underline text-center">
                    Sockets App
                </h1>
                <div class="mb-4">
                    <Navbar />
                </div>
                <router-view />
            </div>
        </div>
    </div>
</template>
<style lang="scss">
body {
    background: #d1e1f7;
}
.navbar-nav {
    a {
        &.router-link-exact-active {
            color: red;
        }
    }
}
</style>
