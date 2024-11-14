<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import Loading from "../components/ui/Loading.vue";
import Posts from "../components/posts/Posts.vue";
import {useRoute, useRouter} from "vue-router";
import ShowUser from "../components/user/ShowUser.vue";

const route = useRoute();

const loading_post = ref(false);
const posts = ref([]);
const user_id = ref(route.params.id);
const user = ref({});

const getPosts = async () => {
    loading_post.value = true;
    try {
        const response = await axios.get(`/api/users/${user_id.value}/posts`);
        posts.value = response.data.data;
        loading_post.value = false;
    } catch (error) {
        console.log(error);
        loading_post.value = false;
    }
};

async function getUser() {
    loading_post.value = true;
    try {
        const response = await axios.get(`/api/users/${user_id.value}`);
        user.value = response.data.data;
        loading_post.value = false;
    } catch (error) {
        console.log(error);
        loading_post.value = false;
    }

}

onMounted(async () => {
    await getPosts();
    await getUser();
});
</script>

<template>
    <ShowUser v-if="user" :user="user" />
    <Loading v-if="loading_post" />
    <div class="row" v-else-if="posts.length">
        <Posts :posts="posts" />
    </div>
</template>
