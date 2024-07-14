<template>
    <div class="row">
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
                            <star-rating :value="review.ratingg" class="fa-3x"
                             v-on:rating:changed="review.ratingg=$event"
                              v-model="review.ratingg"
                             ></star-rating>
                    </div>
                    <div class="form-group">
                        <label for="content" class="text-muted">Describe you experience with</label>
                        <textarea name="content" cols="30" rows="10" v-model="review.content" class="form-control"></textarea>

                    </div>
                    <button class="btn btn-primary mt-2 w-100">Submit</button>
                    
                </div> 
                
            </div>
          </div>
        </div>
        </div>
        
       
    </div>
</template>

<script>
import axios from 'axios';

export default {

    data() {
        return {
            review: {
                ratingg: 5,
                content: null
            },
            existingReview: null,
            loading: false,
            booking : null
        }
    },

    created() {
            this.loading = true;
            axios.get(`/api/reviews/${this.$route.params.id}`)
            .then(response => {
                this.existingReview = response.data.data
            })
            .catch(err => {
                if (err.response && err.response.status && 404 == err.response.status) {
                    axios.get(`/api/booking-by-review/${this.$route.params.id}`)
                    .then(response => {
                        this.booking = response.data.data;
                    })
                }
            })
            .then(() => {
                this.loading=false
            }); 

    },

    computed: {
        alreadyReviewed() {
            //return this.hasReview || !this.booking;
            return this.existingReview != null;
        },
        // hasReview() {
        //     return this.existingReview != null;
        // },
        hasBooking() {
            return this.booking != null;
        }
    }
}
</script>

<style scoped>
   .review_link{
     text-decoration: none !important;
   }
</style>