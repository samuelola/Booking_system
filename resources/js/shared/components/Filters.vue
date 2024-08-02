<template>
    <div class>
        <div style="float:right;" class="">
             <form>
                 <input type="text"  name="searcher" style="margin-right: 4px;" placeholder="Search Booking ..." v-model="searcher">
                 <button class="btn btn-outline-success" style="margin-right: 4px;    padding-top: 4px;
    padding-bottom: 4px;" type="submit" @click.prevent="searching">Filter</button>
                 <button class="btn btn-outline-danger" style="margin-right: 4px;    padding-top: 4px;
    padding-bottom: 4px;" @click.prevent="clear" type="clear">Clear</button>
             </form>
        </div>
        
    </div>
</template>

<script>
import Pagination from "../../shared/mixins/Pagination";
export default {
    mixins: [Pagination],
    props:{'result': Object},
    data() {
        return {
            searcher: null,
            result : null
        }
    },
    methods: {

        searching() {

            //alert(this.searcher);

            axios.get(`/api/search/${this.searcher}`)
                .then(response => {
                    this.result = response.data.data;
                    //console.log(this.result);
                })
                .catch();
        },
        clear() {
            this.searcher = null;
        }
    }

    
}
</script>