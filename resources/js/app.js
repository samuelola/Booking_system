import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import router from "./routes";
import { createApp } from 'vue';
import './bootstrap';

import index from './Index.vue';
import StarRating from "./shared/components/StarRating.vue";
// app.config.globalProperties.$filters = {
//   currencyUSD(value) {
//     return '$' + value
//   }
// }



const app = createApp(index);
app.component('star-rating', StarRating)
app.use(router)
app.mount("#app");

//createApp(index).use(router).mount("#app");

