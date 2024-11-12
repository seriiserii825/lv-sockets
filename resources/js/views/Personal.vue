<script setup>
import { ref } from "vue";
import InputComponent from "../components/forms/InputComponent.vue";

const title = ref("");
const content = ref("");
const file = ref("");
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
                <button type="btn" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</template>
