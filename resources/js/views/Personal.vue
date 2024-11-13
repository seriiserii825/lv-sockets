<script setup>
import { ref } from "vue";
import InputComponent from "../components/forms/InputComponent.vue";
import axios from "axios";

const title = ref("");
const content = ref("");
const file = ref(File | null);
const image = ref(null);

const submit = async () => {
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
    } catch (error) {
        console.log(error);
    }
};

function onFileChanged($event) {
    const target = $event.target;
    if (target && target.files) {
        file.value = target.files[0];
    }
}

async function submitPost() {
    try {
        const response = await axios.post("/api/posts", {
            title: title.value,
            content: content.value,
            image_id: image.value ? image.value.id : null,
        });
        console.log(response, "response");
    } catch (error) {
        cnosole.log(error);
    }
}
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="mb-3">
                <InputComponent
                    name="title"
                    placeholder="Title"
                    v-model:value="title"
                />
            </div>
            <div class="mb-3">
                <textarea
                    name="content"
                    class="form-control"
                    v-model="content"
                    placeholder="content"
                    rows="10"
                ></textarea>
            </div>
            <div class="mb-3">
                <input
                    type="file"
                    @change="onFileChanged($event)"
                    accept="image/*"
                    capture
                />
            </div>
            <div class="d-flex align-items-start gap-3">
                <div v-if="image" class="mb-3">
                    <img :src="image.url" alt="" />
                </div>
                <button
                    v-if="image"
                    @click.prevent="image = null"
                    class="btn btn-danger"
                >
                    Cancel
                </button>
            </div>
            <button
                type="btn"
                @click.prevent="submit"
                class="btn btn-primary mr-3"
            >
                Upload image
            </button>

            <button
                type="btn"
                @click.prevent="submitPost"
                class="btn btn-success"
            >
                Submit post
            </button>
        </div>
    </div>
</template>
