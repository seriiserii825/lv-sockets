import "./bootstrap";

import {createApp} from 'vue'

import App from './App.vue'

const app = createApp(App)

import router from './routes/routes'

app.use(router)
app.mount("#app")
