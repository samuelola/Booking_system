<template>
    <Navigation></Navigation>
    <div class="container mt-4 mb-4 pr-4 pl-4">
            <success v-if="success"></success>
    <div v-else>
            <div class="row">
        <!-- <fatal-error v-if="true"></fatal-error> -->
        <!-- <div :class="[{'col-md-4' : loading  ||  !alreadyReviewed},{'d-none': !loading && alreadyReviewed}]">First Column</div>
        <div :class="[{'col-md-8': loading || !alreadyReviewed},{'col-md-12' : !loading && alreadyReviewed}]"></div> -->
        <div v-if="loading">
            Loading...
        </div>
        <div v-else>
            <div v-if="alreadyReviewed">
              <h3 class="text-center">You have already left a review for this booking</h3>
              
               <div style="text-align:center">
                 ​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​<router-link style="text-align:center"  :to="{name:'bookables'}">Back to Home</router-link>
               </div>
            </div>
            <div v-else>

               
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div v-if="loading">Loading...</div>
                                <div v-else>
                                    <p>Stayed at <router-link class="review_link" :to="{name:'bookable', params:{id:booking.bookable.bookable_id}}">{{ booking.bookable.title }}</router-link></p>
                                    <p>From <span class="badge text-bg-success">{{ booking.from }}</span>  To  <span class="badge text-bg-success">{{ booking.to }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                                <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
                                <star-rating :value="review.rating" class="fa-3x"
                                v-on:rating:changed="review.rating=$event"
                                v-model="review.rating"
                                ></star-rating>
                        </div>
                        <div class="form-group">
                            <label for="content" class="text-muted">Describe you experience with</label>
                            <textarea :class="[{'is-invalid': this.errorFor('content')}]" name="content" cols="30" rows="10" v-model="review.content" class="form-control"></textarea>
                            <!--reuse code here-->
                            <validation-error :errors="errorFor('content')"></validation-error>
                            <!--reuse code here-->
                             

                        </div>
                        <button class="btn btn-primary mt-2 w-100" @click.prevent="submit" :disabled="sending">Submit</button>
                        
                    </div> 
                    
                </div>
               
            </div>
        </div>
        
       
    </div>
    </div>
    </div>
    
    
</template>

<script>
import axios from 'axios';
import { is404, is422, is500 } from '../shared/Utils/response';
import validation_errorss from '../shared/mixins/ValidationErrors';
import Navigation from "../Nav/Nav.vue";

export default {
    mixins: [validation_errorss],
    components: {
        Navigation
    },
    data() {
        return {
            review: {
                uuid : null,
                rating: 5,
                content: null
            },
            existingReview: null,
            loading: false,
            booking: null,
            error: false,
            // errors: null,
            sending: false,
            success : false
        }
    },

   async created() {
       this.review.uuid = this.$route.params.id;
       this.loading = true;
       try {
          this.existingReview = (await axios.get(`/api/reviews/${this.review.uuid}`,this.User.tokenBearer())).data.data;
       } catch(err) {
           if (is404(err)) {

               this.booking = (await axios.get(`/api/booking-by-review/${this.review.uuid}`)).data.data;
            
         } else {

            this.error = true;
          }

           
       }
       this.loading = false; 

    },

    computed: {
        alreadyReviewed() {
            return this.hasReview;
            //return this.existingReview != null;
        },
        hasReview() {
            return this.existingReview != null;
        },
        hasBooking() {
            return this.booking != null;
        }
    },

    methods: {
   async submit() {
            this.errors = null;
            //this.sending = true;
            this.success = false;

            try {
                this.success = (await axios.post(`/api/reviews`, this.review,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })).status;
                if (this.success == 201) {
                    this.success = true;
                }
            }
            catch (error) {

                if (is422(error)) {
                    const errors = error.response.data.errors;
                    if (errors["content"]) {
                            this.errors = errors;
                            return;
                        }

                } else {
                    this.error = true;
                }
                
            }
            // this.sending = false;

            // axios.post(`/api/reviews`, this.review)
            //     .then(response => {
            //         if (response.status == 201) {
            //             this.success = true;
            //          }
            //     })
            //     .catch(error => {
            //         if (is422(error)) {
            //             const errors = error.response.data.errors;

            //             if (errors["content"]) {
            //                 this.errors = errors;
            //                 return;
            //             }

            //         }

            //         this.error = true;
            //     })
            //     .then(() => {
            //         this.sending = false;
            //     });
        },
        // errorFor(field) {
        //     return this.errors != null && this.errors[field] ? this.errors[field] : null;
        // }
    }
}
</script>

<style scoped>
   .review_link{
     text-decoration: none !important;
   }
   
</style>