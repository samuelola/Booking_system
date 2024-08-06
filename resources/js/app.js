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
import Error from "./shared/components/Error.vue";
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
  .component('success', Success)
  .component('error', Error)
  .component('validation-error', ValidationError)  
  .component("font-awesome-icon", FontAwesomeIcon)

//this register a function globally for filters
app.config.globalProperties.$filters = {
  dateTime(value) {
    return moment(value).fromNow();
  },
  dateformatt(value) {
    return moment(value).format('MMMM Do YYYY');
  },
  formatPrice(num) {
      // let val = (value / 1).toFixed(2).replace(',', '.')
    // return val.toString().replace('/\B(?=(\d{3})+(?!\d))',".");
    var str = num.toString().split('.');
    if (str[0].length >= 4) {
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    }
    if (str[1] && str[1].length >= 4) {
        str[1] = str[1].replace(/(\d{3})/g, '$1 ');
    }
    return str.join('.');
  }
}
app.use(router)
app.mount("#app");

//createApp(index).use(router).mount("#app");

