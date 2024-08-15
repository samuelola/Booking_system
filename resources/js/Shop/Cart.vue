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
                           Go to Cart <span class="badge text-bg-primary align-top mr-4">{{ hearSecrettt }}</span>
                       </router-link>
                        
                    </li>
                     <li class="nav-item" style="margin-top: 10px;margin-right: 12px;" v-else>
                       <router-link :to="{name : 'cart'}" style="text-decoration: none;">
                           Go to Cart <span class="badge text-bg-primary align-top mr-4">{{ cart_counter }}</span>
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
                   
                    
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Product</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-right">Price (&#8358;)</th>
                                    <th scope="col" class="text-right">Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="basketlist in basketlists" :key="basketlist">
                                    <td><img :src="basketlist.product.image" width="50" height="50"/> </td>
                                    <td>{{ basketlist.product.title }}</td>
                                    <td><input class="form-control" min="1" type="number"  v-model="basketlist.qty" /></td>
                                    <td class="text-right">&#8358; {{ $filters.formatPrice(basketlist.product.price) }}</td>
                                    <td class="text-right">&#8358; {{ $filters.formatPrice(basketlist.price) }}</td>
                                    
                                    <td class="text-right"><button type="submit"  @click.prevent="updateItems(basketlist.id,basketlist.qty,basketlist.product.price,this.user_idd)" class="btn btn-sm btn-outline-success">Update Cart</button></td>
                                    <td class="text-right"><button type="submit" @click.prevent="deleteItems(basketlist.id,index,this.user_idd,this.subtotal,basketlist.price,basketlist.qty)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                                </tr>
                            
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right">&#8358;{{ $filters.formatPrice(subtotal) }}</td>
                                </tr>
                                <!-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Shipping</td>
                                    <td class="text-right">&#8358;{{ shipping }}</td>
                                </tr> -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong>&#8358;{{ $filters.formatPrice(total) }}</strong></td>
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
import LogoutAction from "../shared/mixins/LogoutAction";

export default {
    mixins : [UserInfo,LogoutAction],
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
            newsubtotal: 0,
            thenewprice: null,
            newprice: null,
            vv: false,
            myqty: 0,
    
        }
         
    },

    created() {
        
        axios.get(`/api/user`, this.User.tokenBearer())
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
                             this.total = this.subtotal;
                             
                         })
                         .catch();

                        axios.get(`/api/count-cart/${this.user_id}`, this.User.tokenBearer())
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

        cent(name,price) {
            var tor = name * price;
          
        },
        
        foo(fgf) {
            this.hearSecrettt = fgf; 
        },

        deleteItems(id, index, user_id, subtotal,price,qty) {
            
            axios.post(`/api/count-cart/${id}/${user_id}`)
                .then(response => {
                    this.cart_counter = response.data.basket_count;
                    this.basketlists.splice(index, 1);

                })
                .catch(); 

            axios.get(`/api/cart/${user_id}`)
                         .then(response => {
                             this.loading = 'true';
                             this.basketlists = response.data.data;

                             this.subtotal = 0;
                             for (let i = 0; i < this.basketlists.length; i++){
                                 this.subtotal = this.subtotal - (-this.basketlists[i].product.price * this.basketlists[i].qty);
                                 
                             }

                             this.total = this.subtotal;

                           
                             
                         })
                .catch();     
                

        },

        updateItems(id, qty, productprice,user_id) {
            this.vv = true;
            var tot = qty * productprice;
            axios.put(`/api/count-cart/${id}/${qty}/${tot}`)
                .then(response => {
                    this.newprice = response.data.cart_updated.price;
                })
                .catch(); 

                axios.get(`/api/cart/${user_id}`)
                         .then(response => {
                             this.loading = 'true';
                             this.basketlists = response.data.data;

                             this.subtotal = 0;
                             for (let i = 0; i < this.basketlists.length; i++){
                                 this.subtotal += this.basketlists[i].product.price * this.basketlists[i].qty;
                             }

                             this.total = this.subtotal;

                           
                             
                         })
                .catch(); 

                axios.get(`/api/count-cart/${user_id}`, this.User.tokenBearer())
                        .then(response => {
                            this.cart_counter = response.data.basket_count;
                        })
                        .catch(); 
        }
       

    },

    mounted() {
        
        this.total = 0;
        this.subtotal = 0;
        this.shipping = 6.95;
        this.user_id = this.user_idd;
        
    
    },

    computed: {
        checkCartCount() {
            this.cart_counter == 0;
        },

        
    }

    
}
</script>