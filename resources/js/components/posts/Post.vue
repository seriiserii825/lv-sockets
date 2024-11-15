<script setup lang="ts">
import axios from "axios";
import IconHeart from "../icons/IconHeart.vue";
import { ref } from "vue";
import { onMounted } from "vue";
import RepostForm from "./RepostForm.vue";
import IconRepost from "../icons/IconRepost.vue";
import { useRoute } from "vue-router";

const route = useRoute();

const is_personal = ref(false);

const props = defineProps({
    post: Object,
});

const is_liked = ref(false);
const likes_count = ref(0);

const repost_title = ref("");
const repost_text = ref("");
const repost_status = ref(false);

function emitTitle(title: string) {
    repost_title.value = title;
}
function emitContent(content: string) {
    repost_text.value = content;
}

async function toggleLike() {
    try {
        const res = await axios.get(`/api/posts/${props.post.id}/toggle_liked`);
        is_liked.value = res.data.is_liked;
        likes_count.value = res.data.likes_count;
        // console.log(likes_count.value, "likes_count.value");
    } catch (error) {
        console.error("error", error);
    }
}

onMounted(() => {
    if (route.name === 'personal') {
        is_personal.value = true;
    }
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
            <div class="d-flex mt-3 card-text">
                <a
                    href="#"
                    @click.prevent="toggleLike"
                    class="d-flex align-items-center gap-1"
                >
                    <IconHeart :fill="`${is_liked ? 'red' : 'white'}`" />
                    <span class="fw-bold">{{ likes_count }}</span>
                </a>
                <small class="text-muted ml-auto mr-3">{{ post.date }}</small>
                <div v-if="!is_personal" @click="repost_status = !repost_status" class="ml-2">
                    <IconRepost :active="repost_status" />
                </div>
            </div>
        </div>
        <div
            v-if="post.reposted_post"
            class="p-3 bg-light border-top border-bottom"
        >
            <img
                v-if="post.reposted_post.image_url"
                :src="post.reposted_post.image_url"
                class="card-img-top"
                alt="post.reposted_post.title"
            />
            <div class="card-body">
                <h5 class="card-title">{{ post.reposted_post.title }}</h5>
                <p class="card-text">{{ post.reposted_post.content }}</p>
            </div>
        </div>
        <RepostForm
            v-if="repost_status && !is_personal"
            @emit_title="emitTitle"
            @emit_content="emitContent"
            :post="post"
        />
    </div>
</template>

<style lang="scss">
.post {
}
</style>
