<template>
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
             <div v-else>
                Loading...
            </div>
            <ReviewList :bookable-id="this.$route.params.id"></ReviewList>
         </div>
         <div class="col-md-4 pd-4">
            <Availability :bookable-id="this.$route.params.id"></Availability>
         </div>
    </div>
</template>

<script>
import Availability from "./Availability.vue";
import ReviewList from "./ReviewList.vue";
export default {
    components: {
        Availability,
        ReviewList,
     },
     data() {
        return {
            bookable: null,
            loading: false
        };
    },

    created() {

        axios.get(`/api/bookables/${this.$route.params.id}`)
            .then(response => {
                this.loading = 'true';
                this.bookable = response.data.data;
                
            });
    }
}
</script>