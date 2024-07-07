import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import router from "./routes";
import { createApp } from 'vue';
import './bootstrap';

import index from './Index.vue';

createApp(index).use(router).mount("#app");

