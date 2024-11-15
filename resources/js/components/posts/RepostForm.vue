<script setup lang="ts">
import { watch } from "vue";
import { ref } from "vue";
import InputComponent from "../forms/InputComponent.vue";

const emits = defineEmits(["emit_title", "emit_content"]);

const title = ref("");
const content = ref("");

watch(title, (newVal) => {
    emits("emit_title", newVal);
});

watch(content, (newVal) => {
    emits("emit_content", newVal);
});
</script>

<template>
    <div class="p-3">
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
                rows="4"
            ></textarea>
        </div>
    </div>
</template>
