<script setup lang="ts">
const props = defineProps({
    user: Object,
});
</script>

<template>
    <div class="row d-flex justify-content-center">
        <h2 class="col-6 mb-4 p-2 border border-info bg-light">
            User name: <strong>{{ user.name }}</strong> - <strong>{{ user.email }}</strong>:
        </h2>
    </div>
</template>
