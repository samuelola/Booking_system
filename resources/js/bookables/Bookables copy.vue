<template>
        <Navigation></Navigation>
        <div class="container mt-4 mb-4 pr-4 pl-4">

            <div class="row">
                <div class="col-md-12">
                       <h3 class="profile">Welcome {{ user?.name }}</h3>
                        <div v-if="loading">
                            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                                <div class="col d-flex align-items-stretch" v-for="(bookable, column) in bookablesInRow(row)"
                                :key="'row' + row + column"
                                >

                                <!-- <div class="col d-flex align-items-stretch" v-for="(bookable, column) in bookablesInRow(row)"
                                :key="'row' + row + column"
                                ></div> -->

                                <BookableListItem
                                v-bind="bookable"
                                ></BookableListItem>
                                    
                                </div>
                                <div class = "col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
                                
                            </div>

                            <!--Pagination-->
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
                            <!--end pagiantion button-->
                        </div>
                        
                        <div v-else>
                            Data is Loading.....
                        </div>
                </div>
            </div>

        </div>
        
</template>

<script>
import BookableListItem from "./BookableListItem.vue";
import Navigation from "../Nav/Nav.vue";
export default {
    components: {
        BookableListItem,
        Navigation
    },
    data() {
        return {
            bookables: null,
            loading : false,
            columns: 3,
            user: null,
            currentPage: null,
            itemPerpage: null,
            totalPages : null
        };
    },
    created() {
        this.getUser();
        if (localStorage.getItem('token') == "" || localStorage.getItem('token') == null) {
            this.$router.push('/login');
        } else {
            this.getUser();
        }

        //All bookables start here
        axios.get('/api/bookables',{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })

            .then(response => {
                this.loading = 'true';
                this.bookables = response.data.data;
                this.itemPerpage = response.data.meta.per_page;
                this.currentPage = response.data.meta.current_page;
                this.totalPages =  response.data.meta.last_page;
                //console.log(this.totalPages);
                //this.bookables.push({ title: "x", description: "x" });
                
            });

    },
    computed:{
        rows() {
         console.log(this.bookables.length);
         return this.bookables == null ? 0 : Math.ceil(this.bookables.length/this.columns)
          
        },

        
        visiblePageNumbers() {
            let pageNumbers = [];
            if (this.totalPages <= 9) {
                for (let i = 1; i <= this.totalPages; i++){
                    pageNumbers.push(i);
                 }
            } else {
                if (this.currentPage <= 4) {
                    pageNumbers = [1, 2, 3, 4, 5, ".....", this.totalPages];

                } else if (this.currentPage >= this.totalPages - 3) {
                    pageNumbers = [1, "....", this.totalPages - 4,
                        this.totalPages - 3, this.totalPages - 2, this.totalPages - 1, this.totalPages];
                } else {
                    pageNumbers = [1, "....", this.currentPage - 1, this.currentPage, this.currentPage + 1, ".....", this.totalPages];
               }
            }

            return pageNumbers;
        }
    },
    methods: {

      getUser() {

            axios.get(`/api/user`, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
             .then((r) => {
                 this.user = r.data.user_details;
                 console.log(user);
            })
            .catch((e) => {
            return e
            });
      },  

      bookablesInRow(row){
         return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },

        visibleBookable(row) {
             const startPage = (this.currentPage - 1) * this.itemPerpage;
             const endPage = startPage + this.itemPerpage;
            // return this.bookables.slice((startPage, endPage)) ;
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },

        changePage(page) {
            if (page >=1 && page <= this.totalPages) {
                this.currentPage = page; 
            }
        },

      //this  function you to adjust the last item to be in a single column
      placeholdersInRow(row){
         return this.columns - this.bookablesInRow(row).length;
        },

        
    
    },
    
};
</script>

<style scoped>
   .profile{
    margin-bottom: 32px;
   }
</style>
