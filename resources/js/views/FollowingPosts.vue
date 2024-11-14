<script setup>
import { onMounted, ref } from "vue";
import axios from "axios";
import Loading from "../components/ui/Loading.vue";
import Posts from "../components/posts/Posts.vue";

const loading_post = ref(false);
const posts = ref([]);

const getPosts = async () => {
    loading_post.value = true;
    try {
        const response = await axios.get(`/api/users/following_posts`);
        console.log("response", response);
        posts.value = response.data.data;
        loading_post.value = false;
    } catch (error) {
        console.log(error);
        loading_post.value = false;
    }
};

onMounted(async () => {
    await getPosts();
});
</script>

<template>
    <Loading v-if="loading_post" />
    <template v-else>
        <div class="row" v-if="posts.length">
            <Posts :posts="posts" />
        </div>
        <div class="row" v-else>
            <div class="col-12">
                <h2 class="text-center">No posts found</h2>
            </div>
        </div>
    </template>
</template>
