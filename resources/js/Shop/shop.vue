<template>
    <div>
        <nav class="navbar navbar-expand-lg border-bottom navbar-light bg-light">
        <div class="container-fluid">
             <router-link class="navbar-brand" :to="{name:'bookables'}">Logo</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'bookables'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'shop'}">Shop</router-link>
                    </li>
                    <li class="nav-item" v-if="check">
                        <router-link class="nav-link" :to="{name:'admin'}">Admin</router-link>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                    
                    <li class="nav-item" style="margin-top: 10px;
    margin-right: 12px;" v-if="hearSecrettt">
                       <router-link :to="{name : 'cart'}" style="text-decoration: none;">
                              Cart <span class="badge text-bg-primary align-top mr-4">{{ hearSecrettt }}</span>
                       </router-link>
                        
                    </li>
                     <li class="nav-item" style="margin-top: 10px;margin-right: 12px;" v-else>
                       <!--
                        <a href="#" style="text-decoration: none;">
                           Cart <span class="badge text-bg-primary align-top mr-4">0</span>
                       </a>
                        -->
                       <router-link :to="{name : 'cart'}" style="text-decoration: none;">
                              Cart <span class="badge text-bg-primary align-top mr-4">0</span>
                       </router-link>
                        
                    </li>
                      
                    <li class="nav-item">
                        <button type="submit" class="btn btn-outline-primary" @click="logoutAction">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <div v-if="loading">
             <div class="container">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="row align-self-stretch">
                                    
                                    <div class="col-md-3 mt-4" v-for="shop in visiblePaginationRows" :key="shop"> 
                                        <ShopListItem
                                          @anothershop="foo"
                                          v-bind="shop"
                                        ></ShopListItem>
                                    </div>       
                                </div>
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
        
       
        
        
    </div>
</template>


<script>
import NavCart from "../Nav/ShopNav.vue";
import ShopListItem from "./ShopListItem.vue";
import Pagination from "../shared/mixins/Pagination";
import LogoutAction from "../shared/mixins/LogoutAction";

export default {
    mixins : [Pagination,LogoutAction],
    components: {
        NavCart,
        ShopListItem
    },

    data() {

        return {
            shops: null,
            loading: false,
            hearSecrettt: null
            
        }
    },

    created() {

        axios.get('/api/shops',{ headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })

            .then(response => {
                this.loading = 'true';
                this.shops = response.data.data;
                //console.log(this.shops);
            });

           
    },

    methods: {
        foo(fgf) {
            this.hearSecrettt = fgf; 
            console.log(this.hearSecrettt);
        },

        

    }

  
 
}
</script>
