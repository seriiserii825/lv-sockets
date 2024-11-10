<script setup></script>

<template>
    <div class="app">
        <h1 class="text-3xl font-bold underline">Hello world!</h1>
        <router-link to="/index">Index</router-link>
        <router-link to="/page">Page</router-link>
        <router-view />
    </div>
</template>
