<script setup lang="ts">
const props = defineProps({
    errors: Array,
});
</script>

<template>
    <ul class="errors">
        <li class="text-danger" v-for="(error, index) in errors" :key="index">{{ error }}</li>
    </ul>
</template>
