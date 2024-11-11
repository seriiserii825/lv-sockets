<template>
    <div class="container py-5">
        <h1 class="text-3xl my-5 font-bold underline">Hello world!</h1>
        <div class="mb-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <router-link class="nav-link" to="/"
                                    >Home</router-link
                                >
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/page"
                                    >Page</router-link
                                >
                            </li>
                            <li class="nav-item">
                                <router-link
                                    class="nav-link"
                                    :to="{ name: 'user.login' }"
                                    >Login</router-link
                                >
                            </li>
                            <li class="nav-item">
                                <router-link
                                    class="nav-link"
                                    :to="{ name: 'user.registration' }"
                                    >Registration</router-link
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <router-view />
    </div>
</template>
