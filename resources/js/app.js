import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import router from "./routes";
import { createApp } from 'vue';

import index from './components/Index.vue';

createApp(index).use(router).mount("#app");

