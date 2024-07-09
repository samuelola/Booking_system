import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import router from "./routes";
import { createApp } from 'vue';
import './bootstrap';
import moment from 'moment';
import index from './Index.vue';
import StarRating from "./shared/components/StarRating.vue";


const app = createApp(index);

//this register a component globally after importing it
app.component('star-rating', StarRating)

//this register a function globally
app.config.globalProperties.$filters = {
  dateTime(value) {
    return moment(value).startOf('day').fromNow();
  }
}
app.use(router)
app.mount("#app");

//createApp(index).use(router).mount("#app");

