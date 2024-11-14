<script setup lang="ts">
import axios from "axios";
import { onMounted, ref } from "vue";
import Loading from "../components/ui/Loading.vue";

const users = ref([]);
const loading = ref(false);

async function getUsers() {
    loading.value = true;
    try {
        const response = await axios.get("/api/users");
        users.value = response.data.data;
        loading.value = false;
    } catch (error) {
        console.log(error, "error");
        loading.value = false;
    }
}

onMounted(async () => {
    await getUsers();
});
</script>

<template>
    <h2 class="mb-4">Users:</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Link</th>
            </tr>
        </thead>
        <Loading v-if="loading" />
        <tbody v-if="users.length">
            <tr v-for="(user, index) in users" :key="index">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>
                    <router-link
                            :to="{ name: 'user.posts', params: { id: user.id } }"
                            class="btn btn-success"
                    >
                        View
                    </router-link>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<style lang="scss">
.users {
}
</style>
