<script setup lang="ts">
const props = defineProps({
    post: Object,
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
            <p class="card-text">
                <small class="text-muted">{{ post.date }}</small>
            </p>
        </div>
    </div>
</template>

<style lang="scss">
.post {
}
</style>
