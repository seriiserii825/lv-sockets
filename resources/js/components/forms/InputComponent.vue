<script setup lang="ts">
const emits = defineEmits(["update:value"]);

const pros = defineProps({
    name: String,
    placeholder: String,
    value: String,
});

function changeHandler(e: any) {
    if (!e.target) return;
    let value = e.target.value;
    emits("update:value", value);
}
</script>

<template>
    <input
        :name="name"
        class="form-control"
        :placeholder="placeholder"
        :value="value"
        @input="changeHandler"
    />
</template>
