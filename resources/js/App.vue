<script setup>
import {onMounted, ref} from "vue";
import Navbar from "./components/navigation/Navbar.vue";
import ShowUser from "./components/user/ShowUser.vue";

const user = ref({});
const loading = ref(false);

async function getAuthUser() {
    loading.value = true;
    try {
        const response = await axios.get(`/api/users/auth_user`);
        user.value = response.data.data;
        loading.value = false;
    } catch (error) {
        console.log(error);
        loading.value = false;
    }
}

onMounted(async () => {
    await getAuthUser();
});

</script>
<template>
    <div class="container py-5">
        <ShowUser v-if="user" :user="user" />
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
