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
                Data is Loading...
            </div>
         </div>
         <div class="col-md-4 pd-4">
            <Availability></Availability>
         </div>
    </div>
</template>

<script>
import Availability from "./Availability.vue"
export default {
    components: {
        Availability,
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