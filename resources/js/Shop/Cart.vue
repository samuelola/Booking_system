<template>
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
                              Cart <span class="badge text-bg-primary align-top mr-4">{{ cart_counter }}</span>
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
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">
                    <!-- <div v-if="cart_counter = 0">

                    </div>
                    <div v-else>

                    </div> -->
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Product</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-right">Price</th>
                                    <th scope="col" class="text-right">Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="(basketlist,index) in basketlists">
                                    <td><img :src="basketlist.product.image" width="50" height="50"/> </td>
                                    <td>{{ basketlist.product.title }}</td>
                                    <td><input class="form-control" type="text" v-model="basketlist.qty" /></td>
                                    <td class="text-right"># {{ $filters.formatPrice(basketlist.product.price) }}</td>
                                    <td class="text-right"># {{ $filters.formatPrice(basketlist.price) }}</td>
                                    <td class="text-right"><button type="submit" @click.prevent="deleteItems(basketlist.id,index,this.user_idd,this.subtotal,basketlist.price,basketlist.qty)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                                </tr>
                            
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right">#{{ $filters.formatPrice(subtotal) }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Shipping</td>
                                    <td class="text-right">#{{ shipping }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong>#{{ $filters.formatPrice(total) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col mb-2">
                    <div class="row">
                        <div class="col-sm-12  col-md-6">
                            <router-link :to="{name:'shop'}" class="btn btn-block btn-outline-success">Continue Shopping</router-link>
                            <!-- <button class="btn btn-block btn-light">Continue Shopping</button> -->
                        </div>
                        <span v-if="this.cart_counter == 0">
                            
                        </span>
                        
                        <div class="col-sm-12 col-md-6 text-right" v-else>
                          <router-link :to="{name:'checkout'}" class="btn btn-lg btn-block btn-success text-uppercase">Checkout</router-link>
                        
                        </div>   
                         
                        
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <div v-else>
         Loading .....
    </div>
         

</template>

<script>
import UserInfo from "../shared/mixins/UserInfo";
import NavCart from "../Nav/ShopNav.vue";
import axios from "axios";

export default {
    mixins : [UserInfo],
    components: {
        NavCart
    },
    
    data() {
        return {
            shop_details: null,
            image: null,
            title: null,
            user_idd : null,
            basketlists: null,
            subtotal: null,
            total: null,
            shipping: null,
            loading: false,
            cart_counter: null,
            user_id: null,
            newsubtotal : 0
        }
         
    },

    created() {
        const headers = {
            Authorization: 'Bearer ' + localStorage.getItem('token')
        }
        axios.get(`/api/user`, {headers})
             .then((r) => {
                 this.user_idd = r.data.user_details.id;
                 if (this.user_idd) {
                     axios.get(`/api/cart/${this.user_idd}`)
                         .then(response => {
                             this.loading = 'true';
                             this.basketlists = response.data.data;
                             for (let i = 0; i < this.basketlists.length; i++){
                                 this.subtotal += this.basketlists[i].product.price * this.basketlists[i].qty;
                             }

                             this.total = this.subtotal + this.shipping;
                             
                         })
                         .catch();

                        axios.get(`/api/count-cart/${this.user_id}`, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
                        .then(response => {
                            this.cart_counter = response.data.basket_count;
                        })
                        .catch(); 
               
                 }
                 
            })
            .catch((e) => {
            return e
            });
       
    },
    
    methods: {
        foo(fgf) {
            this.hearSecrettt = fgf; 
        },

        deleteItems(id, index, user_id, subtotal,price,qty) {
            
            var subtotas = subtotal - price;
            this.newsubtotal = subtotas;
            axios.post(`/api/count-cart/${id}/${user_id}`)
                .then(response => {
                    this.cart_counter = response.data.basket_count;
                    this.basketlists.splice(index, 1);

                })
                .catch()
        },
       

    },

    mounted() {
        //this.retrieve();
        this.total = 0;
        this.subtotal = 0;
        this.shipping = 6.95;
        this.user_id = this.user_idd;
        
    
    },

    computed: {
        checkCartCount() {

            this.cart_counter == 0;
        }
    }

    
}
</script>