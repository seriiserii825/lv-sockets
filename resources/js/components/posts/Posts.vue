<script setup lang="ts">
import Post from './Post.vue';

const props = defineProps({
    posts: Object,
});
</script>

<template>
    <div class="posts mt-5">
        <h2 class="mb-3 h2">Posts:</h2>
        <div v-for="post in posts" :key="post.id" class="col-6">
            <Post :post="post" />
        </div>
    </div>
</template>

<style lang="scss">
.posts {
}
</style>
