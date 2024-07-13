<template>
    <div>
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
                <div class="col-md-2"></div>
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
                <div class="col-md-2"></div>
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
            loading:false
        }
    },

    created() {
            this.loading = true;
            axios.get(`/api/reviews/${this.$route.params.id}`)
            .then(response => {
                this.existingReview = response.data.data
            })
            .catch(err => {

            })
            .then(() => {
                this.loading=false
            }); 


    },

    computed: {
        alreadyReviewed() {
            return this.existingReview != null;
        }
    }
}
</script>