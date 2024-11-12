<script setup lang="ts">
import { ref } from "vue";

const emits = defineEmits(["update:value", "emit_file"]);

const props = defineProps({
    name: String,
    placeholder: String,
    value: {
        type: [String, File],
        default: "",
    },
    type: {
        type: String,
        default: "text",
    },
});

function inputHandler(e: any) {
    if (!e.target) return;
    let value = e.target.value;
    emits("update:value", value);
}

function changeHandler(e: any) {
    if (!e.target) return;
    let value = e.target.files[0];
    emits("emit_file", value);
}
</script>

<template>
    <input
        :type="type"
        :name="name"
        class="form-control"
        :placeholder="placeholder"
        :value="value"
        @input="inputHandler"
        @change="changeHandler"
    />
</template>
