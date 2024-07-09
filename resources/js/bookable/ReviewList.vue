<template>
    <div style="padding: 1.25rem;">
        <h6 class="text-uppcase text-secondary font-weight-bolder pt-4">Review List</h6>
        <div v-if="loading">
             <div class="border-bottom d-none d-md-block" v-for="(review, index) in reviews" :key="index">
                <div class="row pt-4">
                    <div class="col-md-6">ok</div>
                    <div class="col-md-6 d-flex justify-content-end">
                        {{ review.rating }}
                        <star-rating></star-rating>
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
            </div>
        </div>
        <div v-else>
             Loading...
        </div>
        
    </div>
</template>

<script>

export default {
    props: {
        bookableId : String
    },
    data() {
        return {
            loading: false,
            reviews : null
        }
    },

    created() {
        axios.get(`/api/bookables/${this.bookableId}/reviews`)
            .then(response => {
                this.loading = 'true';
                this.reviews = response.data.data 
                
            });
            
    },

  
    
}

</script>