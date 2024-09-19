<template>
    <Navigation></Navigation>
    <div class="container mt-4 mb-4 pr-4 pl-4">
        <div class="row">
         <div class="col-md-8 pb-4">
            <div v-if="loading">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ bookable.title }}</h5>
                        <hr/>
                        <article>{{ bookable.description }}</article>
                    </div>
                </div>
            
             </div>
             <!-- <div v-else>
                Loading...
            </div> -->
            <ReviewList :bookable-id="this.$route.params.id"></ReviewList>
         </div>
         <div class="col-md-4 pd-4">
            <!-- <Availability :bookable-id="this.$route.params.id" v-on:availability="checkPrice($event)"></Availability> -->
            <Availability 
            :bookable-id="this.$route.params.id" 
            @availability="checkPrice($event)" 
            class="mb-4">
            </Availability>
            <transition name="fade">
                <PriceBreakdown v-if="price" :price="price"></PriceBreakdown>
            </transition>
            
            <transition name="fade">
                  <button class="btn btn-outline-secondary btn-block w-100" v-if="price">Book Now</button>
            </transition>
            
         </div>
    </div>
    </div>
</template>

<script>
import Availability from "./Availability.vue";
import ReviewList from "./ReviewList.vue";
import PriceBreakdown from "./PriceBreakdown.vue";
import Navigation from "../Nav/Nav.vue";
import { mapState } from 'vuex';

export default {
    components: {
        Availability,
        ReviewList,
        Navigation,
        PriceBreakdown
     },
     data() {
        return {
            bookable: null,
            loading: false,
            price:null
        };
    },

    created() {

        axios.get(`/api/bookables/${this.$route.params.id}`,this.User.tokenBearer())
            .then(response => {
                this.loading = 'true';
                this.bookable = response.data.data;
                
            });
    },

    // computed: mapState({

    //     lastSearchh: "lastSearch"

    // }),
    computed: {
         ...mapState({
           lastSearchh : "lastSearch"
        })
    },
    methods:{
        async checkPrice(hasAvailabilityy) {
            console.log(this.lastSearchh);
            if (!hasAvailabilityy) {
                this.price = null;
                return;
            }
            try {
                this.price = (await axios.get(`/api/bookables/${this.bookable.id}/price?from=${this.lastSearchh.from}&to=${this.lastSearchh.to}`)).data.data
            } catch (error) {
                this.price = null;
            }
       }
    }

   
}
</script>