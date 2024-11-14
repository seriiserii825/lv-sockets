<script setup lang="ts">
import axios from "axios";
import IconHeart from "../icons/IconHeart.vue";
import { ref } from "vue";
import { onMounted } from "vue";

const props = defineProps({
    post: Object,
});

const is_liked = ref(false);
const likes_count = ref(0);

async function toggleLike() {
    try {
        const res = await axios.get(`/api/posts/${props.post.id}/toggle_liked`);
        is_liked.value = res.data.is_liked;
        likes_count.value = res.data.likes_count;
        console.log(likes_count.value, "likes_count.value");
    } catch (error) {
        console.error("error", error);
    }
}

onMounted(() => {
    is_liked.value = props.post.is_liked;
    likes_count.value = props.post.likes_count;
    console.log(likes_count.value, "likes_count.value");
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
                <a
                    href="#"
                    @click.prevent="toggleLike"
                    class="d-flex align-items-center gap-1"
                >
                    <IconHeart :fill="`${is_liked ? 'red' : 'white'}`" />
                    <span class="fw-bold">{{ likes_count }}</span>
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
