<script setup>
import axios from "axios";
import { ref } from "vue";
import { useRouter } from "vue-router";
import VueCookies from "vue-cookies";

const router = useRouter();

const name = ref("Zezik");
const email = ref("zezik@mail.com");
const password = ref("123123123");
const password_confirmation = ref("123123123");
const errors = ref([]);
function submit() {
    axios.get("/sanctum/csrf-cookie").then((response) => {
        console.log(response.data);
        axios
            .post("/register", {
                name: name.value,
                email: email.value,
                password: password.value,
                password_confirmation: password_confirmation.value,
            })
            .then((response) => {
                localStorage.setItem("token", VueCookies.get("XSRF-TOKEN"));
                window.location.href = "/page";
            })
            .catch((error) => {
                errors.value = error.response.data.errors;
            });
    });
}
</script>

<template>
    <div class="col-lg-6">
        <div class="row mb-3">
            <div class="col-6">
                <input
                    v-model="email"
                    type="email"
                    name="email"
                    placeholder="email"
                    class="form-control"
                />
                <span class="text-danger" v-if="errors['email']">{{
                    errors["email"][0]
                }}</span>
            </div>
            <div class="col-6">
                <input
                    v-model="password"
                    type="text"
                    name="password"
                    placeholder="password"
                    class="form-control"
                />
                <span class="text-danger" v-if="errors['password']">{{
                    errors["password"][0]
                }}</span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <input
                    v-model="name"
                    type="name"
                    name="name"
                    placeholder="name"
                    class="form-control"
                />
                <span class="text-danger" v-if="errors['name']">{{
                    errors["name"][0]
                }}</span>
            </div>
            <div class="col-6">
                <input
                    v-model="password_confirmation"
                    type="text"
                    name="password_confirmation"
                    placeholder="password_confirmation"
                    class="form-control"
                />
                <span
                    class="text-danger"
                    v-if="errors['password_confirmation']"
                    >{{ errors["password_confirmation"][0] }}</span
                >
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button @click="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </div>
</template>
