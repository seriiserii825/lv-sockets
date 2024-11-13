<script setup>
import { onMounted, ref } from "vue";
import InputComponent from "../components/forms/InputComponent.vue";
import axios from "axios";
import Loading from "../components/ui/Loading.vue";
import Errors from "../components/ui/Errors.vue";
import Posts from "../components/posts/Posts.vue";

const title = ref("");
const content = ref("");
const file = ref(File | null);
const image = ref(null);
const loading_img = ref(false);
const loading_post = ref(false);
const checked = ref(false);
const errors = ref([]);
const posts = ref([]);

const getPosts = async () => {
    try {
        const response = await axios.get("/api/posts");
        console.log(JSON.stringify(response.data.data, null, 4));
        posts.value = response.data.data;
    } catch (error) {
        console.log(error);
    }
};

const uploadImage = async () => {
    loading_img.value = true;
    const formData = new FormData();
    formData.append("post_id", 1);
    formData.append("image", file.value);
    try {
        const response = await axios.post("/api/post_image", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        image.value = response.data.data;
        loading_img.value = false;
    } catch (error) {
        console.log(error);
        loading_img.value = false;
    }
};

function onFileChanged($event) {
    const target = $event.target;
    if (target && target.files) {
        file.value = target.files[0];
    }
}

async function publish() {
    loading_post.value = true;
    try {
        const response = await axios.post("/api/posts", {
            title: title.value,
            content: content.value,
            image_id: image.value ? image.value.id : null,
            clear_storage: checked.value,
        });
        console.log(response, "response");
        title.value = "";
        content.value = "";
        image.value = null;
        await getPosts();
        loading_post.value = false;
    } catch (error) {
        console.log(error, "error");
        errors.value = error.response.data.errors;
        loading_post.value = false;
    }
}

onMounted(async () => {
    await getPosts();
});
</script>

<template>
    <div class="row">
        <h2 class="mb-3 h2">Create Post:</h2>
        <div class="mb-3">
            <InputComponent
                name="title"
                placeholder="Title"
                v-model:value="title"
            />
            <Errors v-if="errors['title']" :errors="errors['title']" />
        </div>
        <div class="mb-3">
            <textarea
                name="content"
                class="form-control"
                v-model="content"
                placeholder="content"
                rows="10"
            ></textarea>
            <Errors v-if="errors['content']" :errors="errors['content']" />
        </div>
        <div class="mb-3">
            <input
                type="file"
                @change="onFileChanged($event)"
                accept="image/*"
                capture
            />
            <Errors v-if="errors['image_id']" :errors="errors['image_id']" />
        </div>
        <div class="d-flex align-items-start gap-3 mb-4">
            <div v-if="image" class="mb-3">
                <img :width="300" :height="300" :src="image.url" alt="" />
            </div>
            <button
                v-if="image"
                @click.prevent="image = null"
                class="btn btn-danger"
            >
                Cancel
            </button>

            <button
                v-if="!image"
                type="btn"
                @click.prevent="uploadImage"
                class="btn btn-primary mr-3 d-flex align-items-center gap-2"
                :disabled="loading_img"
            >
                <span>Upload image</span>
                <Loading v-if="loading_img" />
            </button>
        </div>
        <div class="d-flex gap-3">
            <button
                type="btn"
                @click.prevent="publish"
                class="btn btn-success d-flex align-items-center gap-2"
                :disabled="loading_post"
            >
                <span>Publish</span>
                <Loading v-if="loading_post" />
            </button>
            <div class="form-check">
                <input
                    class="form-check-input"
                    type="checkbox"
                    @change="checked = !checked"
                    id="flexCheckChecked"
                    :checked="checked"
                />
                <label class="form-check-label" for="flexCheckChecked"
                    >Clear Storage</label
                >
            </div>
        </div>
    </div>
    <Loading v-if="loading_post" />
    <div class="row" v-else-if="posts.length">
        <Posts :posts="posts" />
    </div>
</template>
