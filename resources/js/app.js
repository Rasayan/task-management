import { createApp } from 'vue';
import App from './App.vue';
import axios from './axios'; // Adjust the path as needed

const app = createApp(App);

// Optionally, provide axios globally
app.config.globalProperties.$axios = axios;

app.mount('#app');
