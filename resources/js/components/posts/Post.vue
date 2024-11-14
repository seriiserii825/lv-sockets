<script setup lang="ts">
import axios from "axios";
import IconHeart from "../icons/IconHeart.vue";
import {ref} from "vue";
import {onMounted} from "vue";

const props = defineProps({
    post: Object,
});

const is_liked = ref(false);

async function toggleLike() {
    try {
        const res = await axios.get(`/api/posts/${props.post.id}/toggle_liked`);
        is_liked.value = res.data.is_liked;
    } catch (error) {
        console.error("error", error);
    }
}

onMounted(() => {
    is_liked.value = props.post.is_liked;
});
</script>

<template>
    <div v-if="post" class="card mb-3">
        <img
            v-if="post.image_url"
            :src="post.image_url"
            class="card-img-top"
            alt="post.title"
        />
        <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ post.content }}</p>
            <p class="d-flex justify-content-between mt-3 card-text">
                <a href="#" @click.prepend="toggleLike">
                    <IconHeart :fill="`${is_liked ? 'red' : 'white'}`" />
                </a>
                <small class="text-muted">{{ post.date }}</small>
            </p>
        </div>
    </div>
</template>

<style lang="scss">
.post {
}
</style>
