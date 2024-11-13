<script setup>
import { useRouter } from "vue-router";
import { onMounted } from "vue";
import { ref } from "vue";

const router = useRouter();
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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-3xl my-5 font-bold underline text-center">
                    Sockets App
                </h1>
                <div class="mb-4">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <div id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                    <li class="nav-item" v-if="token">
                                        <router-link class="nav-link" to="/"
                                            >Home</router-link
                                        >
                                    </li>
                                    <li class="nav-item" v-if="token">
                                        <router-link
                                            class="nav-link"
                                            to="/personal"
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
                                        <a
                                            href="#"
                                            @click.prevent="logout"
                                            class="nav-link"
                                            >Logout</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
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
