<script setup>
import axios from "axios";
import { onMounted } from "vue";

async function init() {
    try {
        const data = await axios.get("/api/get", {
            headers: {
                Accept: "application/json",
            },
        });
        // console.log(data, "data");
    } catch (error) {
        console.log(error);
    }
}
onMounted(async () => {
    await init();
});
</script>

<template>
    <div>Page</div>
</template>
