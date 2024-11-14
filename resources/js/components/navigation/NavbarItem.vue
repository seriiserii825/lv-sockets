<script setup lang="ts">
const props = defineProps({
    name: String,
    title: String,
});
</script>

<template>
    <li class="nav-item">
        <router-link class="nav-link" :to="{ name: name }">{{
            title
        }}</router-link>
    </li>
</template>
