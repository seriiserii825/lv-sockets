<script setup lang="ts">
import { onMounted } from "vue";
import { ref } from "vue";
import axios from "axios";

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
                    <li class="nav-item" v-if="token">
                        <router-link class="nav-link" to="/">Home</router-link>
                    </li>
                    <li class="nav-item" v-if="token">
                        <router-link class="nav-link" to="/personal"
                            >Personal</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="token">
                        <router-link class="nav-link" to="/page"
                            >Page</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="!token">
                        <router-link
                            class="nav-link"
                            :to="{ name: 'user.login' }"
                            >Login</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="!token">
                        <router-link
                            class="nav-link"
                            :to="{ name: 'user.registration' }"
                            >Registration</router-link
                        >
                    </li>
                    <li class="nav-item" v-if="token">
                        <a href="#" @click.prevent="logout" class="nav-link"
                            >Logout</a
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
