<template>
    <div>
        <h1 class="text-3xl font-bold underline">Hello world!</h1>
        <router-link to="/">Home</router-link>
        <router-link to="/page">Page</router-link>
        <router-link :to="{name: 'user.login'}">Login</router-link>
        <router-link :to="{name: 'user.registration'}">Registration</router-link>
        <router-view />
    </div>
</template>
