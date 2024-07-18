<template>
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
            </div>
            <div v-else>

            <div class="container">
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

                            <div>
                                <div class="invalid-feedback" v-for="(error,index) in this.errorFor('content')" :key="'content' + index">{{ error }}</div>
                            </div>  

                        </div>
                        <button class="btn btn-primary mt-2 w-100" @click.prevent="submit" :disabled="sending">Submit</button>
                        
                    </div> 
                    
                </div>
            </div>
            </div>
        </div>
        
       
    </div>
</template>

<script>
import axios from 'axios';
import { is404,is422,is500 } from '../shared/Utils/response';

export default {

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
            errors: null,
            sending:false
        }
    },

    created() {
            this.review.uuid = this.$route.params.id;
            this.loading = true;
            axios.get(`/api/reviews/${this.review.uuid}`)
            .then(response => {
                this.existingReview = response.data.data
            })
                .catch(err => {
                    if (is404(err)) {
                        axios.get(`/api/booking-by-review/${this.review.uuid}`)
                            .then(response => {
                                this.booking = response.data.data;
                            })
                            .catch(err=>{
                                
                            });

                     }

                    this.error = true;
            })
            .then(() => {
                this.loading=false
            }); 

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
        submit() {
            this.errors = null;
            this.sending = true;
            axios.post(`/api/reviews`, this.review)
                .then(response => {
                    console.log(response)
                })
                .catch(error => {
                    if (is422(error)) {
                        const errors = error.response.data.errors;

                        if (errors["content"]) {
                            this.errors = errors;
                            return;
                        }

                    }

                    this.error = true;
                })
                .then(() => {
                    this.sending = false;
                });
        },
        errorFor(field) {
            return this.errors != null && this.errors[field] ? this.errors[field] : null;
        }
    }
}
</script>

<style scoped>
   .review_link{
     text-decoration: none !important;
   }
   .form-control.is-invalid ~ div > .invalid-feedback{
      display:block;
   }
</style>