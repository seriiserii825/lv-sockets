<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import Loading from "../components/ui/Loading.vue";
import Posts from "../components/posts/Posts.vue";
import {useRouter} from "vue-router";

const router = useRouter();

const loading_post = ref(false);
const posts = ref([]);
const user_id = router.params.id;

const getPosts = async () => {
    try {
        const response = await axios.get(`/api/users/${user_id}/posts`);
        posts.value = response.data.data;
    } catch (error) {
        console.log(error);
    }
};

onMounted(async () => {
    await getPosts();
});
</script>

<template>
    <Loading v-if="loading_post" />
    <div class="row" v-else-if="posts.length">
        <Posts :posts="posts" />
    </div>
</template>
