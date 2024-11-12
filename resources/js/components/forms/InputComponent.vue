<script setup lang="ts">
import { ref } from "vue";

const emits = defineEmits(["update:value"]);

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

function changeHandler(e: any) {
    if (!e.target) return;
    let value = e.target.value;
    if (props.type == "file") {
        value = e.target.files[0];
    }
    console.log(value, "value");
    emits("update:value", value);
}
</script>

<template>
    <input
        :type="type"
        :name="name"
        class="form-control"
        :placeholder="placeholder"
        :value="value"
        @input="changeHandler"
    />
</template>
