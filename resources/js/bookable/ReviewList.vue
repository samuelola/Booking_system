<template>
    <div style="padding: 1.25rem;">
        <div v-if="error">

        </div>
        <div v-else>
               <router-link class="btn btn-sm btn-primary" :to="{name:'review', params:{id:review_key}}">
                Create a review
              </router-link>
        </div>
        
        <h6 class="text-uppcase text-secondary font-weight-bolder pt-4">Review List</h6>
        <div v-if="loading">
             <div class="border-bottom d-none d-md-block" v-for="(review, index) in reviews" :key="index">
                <div class="row pt-4">
                    <div class="col-md-6">ok</div>
                    <div class="col-md-6 d-flex justify-content-end">
                
                        <star-rating :value="review.rating" class="fa-lg"></star-rating>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ $filters.dateTime(review.created_at)}}
                    </div>
                </div>
                <div class="row pt-4 pb-4">
                    <div class="col-md-12">{{ review.content }}</div>
                </div>
                <div class="row pt-4 pb-4">
                    <div class="col-md-12">Reviewed By : {{ review.content }}</div>
                </div>
            </div>
        </div>
        <div v-else>
             Loading...
        </div>
        
    </div>
</template>

<script>
import { is500 } from '../shared/Utils/response';
export default {
    props: {
        bookableId : String
    },
    data() {
        return {
            loading: false,
            reviews: null,
            review_key: null,
            error: false,
        }
    },

    created() {
        axios.get(`/api/bookables/${this.bookableId}/reviews`,this.User.tokenBearer())
            .then(response => {
                this.loading = 'true';
                this.reviews = response.data.data 
                //console.log(this.reviews);
            });    
     
    },

    mounted() {

        axios.get(`/api/booking-by/${this.bookableId}`)
            .then(response => {
                this.review_key = response.data.data.review
                console.log(this.review_key);
            })
            .catch(error => {

                if (is500(error)) {
                    this.error = true;
                    
                 }
            }); 
    }

    
  
    
}

</script>