<template>
        <Navigation></Navigation>
        
        <div v-if="loading">
              <div class="container mt-4 mb-4 pr-4 pl-4">
                <div class="row">
                    <div class="col-md-6">
                            <h3 class="profile">Welcome {{ user?.name }}</h3>
                    </div>
                    <div class="col-md-6">
                         
                         <!-- <Filters></Filters> -->
                           <div  class="">
                                <form>
                                    <input type="text" class="form-control"  name="searcher" style="margin-right: 4px;display: inline;width: 50%;margin-left: 128px;" placeholder="Search Booking ..." v-model="searcher">
                                    <button class="btn btn-outline-success" style="margin-right: 4px;margin-top: -5px;padding-top: 4px;
                        padding-bottom: 4px;" type="submit" @click.prevent="searching">Filter</button>
                                    <button class="btn btn-outline-danger" style="margin-right: 4px;padding-top: 4px;margin-top: -5px;
                        padding-bottom: 4px;" @click.prevent="clear" type="clear">Clear</button>
                                </form>
                            </div>
                    </div>
                </div>
                    
                     
                <div class="row align-self-stretch">
                
                    <div class="col-md-3 mt-4" v-for="bookable in visiblePaginationRows" :key="bookable"> 
                        <BookableListItem
                            v-bind="bookable"
                            ></BookableListItem>     
                    </div>   
                            
                    
                </div>
                     
                    

                </div>
                    
                

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                             <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center mt-4">
                                        <li class="page-item">
                                            <a class="page-link" href="#"
                                            @click="changePage(currentPage - 1)"
                                            :disabled = "currentPage === 1"
                                            >Previous</a>
                                        </li>
                                        
                                        <li class="page-item"
                                            v-for="pageNumber in visiblePageNumbers"
                                            :key="pageNumber"
                                            :class="{active : currentPage == pageNumber || pageNumber === '....'}"
                                        >
                                            
                                        <a class="page-link" href="#" @click="changePage(pageNumber)">{{ pageNumber }}</a>
                                        </li>

                                        <li class="page-item">
                                            <a class="page-link" href="#"
                                            @click="changePage(currentPage + 1)"
                                            :disabled = "currentPage === 1"
                                            >Next</a>
                                        </li>
                                    </ul>
                                </nav>
                        </div>
                    </div>
                </div>
                      
        </div>
        <div v-else>
            Data is Loading.....
        </div>
        
        
</template>

<script>
import BookableListItem from "./BookableListItem.vue";
import Navigation from "../Nav/Nav.vue";
import Pagination from "../shared/mixins/Pagination";
import Filters from "../shared/components/Filters.vue";
import { is404 } from '../shared/Utils/response';
import UserInfo from "../shared/mixins/UserInfo";
export default {
    mixins : [Pagination,UserInfo],
    components: {
        BookableListItem,
        Navigation,
        Filters
    },
    data() {
        return {
            bookables: null,
            loading : false,
            columns: 3,
            searcher: null,
            searchResult: null,
            error: false,
        };
    },
    created() {
       
        //All bookables start here
        axios.get('/api/bookables',{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })

            .then(response => {
                this.loading = 'true';
                this.bookables = response.data.data;
            
            });

    },
    
    methods: {

        searching() {
            this.error= false;
            axios.get(`/api/search/${this.searcher}`,{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
                .then(response => {
                    this.searchResult = response.data.data;
                    console.log(this.searchResult);
                })
                .catch(error => {
                    if (is404(error)) {
                        this.error = true;
                        alert("No result  found");
                        this.$router.push('/');
                    }

                    
                });
        },
        clear() {

            window.location.reload();
            this.searcher = null;
        }

    },

};
</script>

<style scoped>
   .profile{
    margin-bottom: 32px;
   }
</style>
