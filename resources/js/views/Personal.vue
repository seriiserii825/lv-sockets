<script setup>
import { ref } from "vue";
import InputComponent from "../components/forms/InputComponent.vue";
import axios from "axios";
import Loading from "../components/ui/Loading.vue";
import Errors from "../components/ui/Errors.vue";

const title = ref("");
const content = ref("");
const file = ref(File | null);
const image = ref(null);
const loading_img = ref(false);
const loading_post = ref(false);
const errors = ref([]);

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
        });
        console.log(response, "response");
        title.value = "";
        content.value = "";
        image.value = null;
        loading_post.value = false;
    } catch (error) {
        console.log(error, "error");
        errors.value = error.response.data.errors;
        loading_post.value = false;
    }
}
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
        <div clas="d-flex gap-3">
            <button
                type="btn"
                @click.prevent="publish"
                class="btn btn-success d-flex align-items-center gap-2"
                :disabled="loading_post"
            >
                <span>Publish</span>
                <Loading v-if="loading_post" />
            </button>
        </div>
    </div>
</template>
