<script setup lang="ts">
import { onMounted } from "vue";
import { ref } from "vue";
import axios from "axios";
import NavbarItem from "./NavbarItem.vue";

const token = ref("");

function logout() {
    axios
        .post("/logout")
        .then((response) => {
            localStorage.removeItem("token");
            window.location.href = "/user/login";
        })
        .catch((error) => {
            console.log(error.response.data);
        });
}

onMounted(() => {
    token.value = localStorage.getItem("token");
});
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <NavbarItem v-if="token" name="home" title="Home" />
                    <NavbarItem v-if="token" name="users" title="Users" />
                    <NavbarItem v-if="token" name="personal" title="Personal" />
                    <NavbarItem v-if="token" name="page" title="Page" />
                    <NavbarItem v-if="!token" name="user.login" title="Login" />
                    <NavbarItem
                        v-if="!token"
                        name="user.registration"
                        title="Registration"
                    />
                    <li class="nav-item" v-if="token">
                        <a href="#" @click.prevent="logout" class="nav-link">Logout</a
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
