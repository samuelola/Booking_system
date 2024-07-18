import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap"; // this bootstrap is for the online bootstrap
import router from "./routes";
import { createApp } from 'vue';
import './bootstrap';
import moment from 'moment';
import index from './Index.vue';
import StarRating from "./shared/components/StarRating.vue";
import FatalError from "./shared/components/FatalError.vue";
import ValidationError from "./shared/components/ValidationError.vue";
import Success from "./shared/components/Success.vue";
import { library, dom } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(fas, far, fab)
dom.watch();



const app = createApp(index);

//this register a component globally after importing it
app.component('star-rating', StarRating)
  .component('fatal-error', FatalError)
  .component('success',Success)
  .component('validation-error', ValidationError)  
  .component("font-awesome-icon", FontAwesomeIcon)
//this register a function globally
app.config.globalProperties.$filters = {
  dateTime(value) {
    return moment(value).fromNow();
  },
  dateformatt(value) {
    return moment(value).format('MMMM Do YYYY');
  }
}
app.use(router)
app.mount("#app");

//createApp(index).use(router).mount("#app");

