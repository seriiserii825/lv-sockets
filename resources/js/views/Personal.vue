<script setup>
import { ref } from "vue";
import InputComponent from "../components/forms/InputComponent.vue";
import axios from "axios";

const title = ref("");
const content = ref("");
const file = ref(null);

const submit = async () => {
    const formData = new FormData();
    formData.append("title", title.value);
    formData.append("content", content.value);
    formData.append("image", file.value);
    try {
        const response = await axios.post("/api/post_image", formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });
        console.log(response, "response");
    } catch (error) {
        console.log(error);
    }
};
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
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
                    <InputComponent
                        name="file"
                        placeholder="File"
                        v-model:value="file"
                        type="file"
                    />
                </div>
                <button type="btn" @click="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>
