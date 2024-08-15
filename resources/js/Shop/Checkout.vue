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
                    
                   
                     <li class="nav-item" style="margin-top: 10px;margin-right: 12px;">
                       
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
        <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed" v-for="basketlist in basketlists" :key="basketlist">
                <div>
                    <h6 class="my-0">{{ basketlist.product.title }}</h6>
                    
                </div>
                <span class="text-muted">&#8358; {{ $filters.formatPrice(basketlist.price) }}</span>
                </li>

                <!-- <li class="list-group-item d-flex justify-content-between">
                <span>Shipping (&#8358;)</span>
                <strong>&#8358;{{ shipping }}</strong>
                </li> -->
                
                <li class="list-group-item d-flex justify-content-between">
                <span>Total (&#8358;)</span>
                
                <strong>&#8358;{{ dtotal ? $filters.formatPrice(dtotal) : '' }}</strong>
                </li>
            </ul>
            </div>
            <div class="col-md-8 order-md-1 mb-5">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">Name</label>
                    <input type="text" class="form-control" id="name" v-model="formData.name" placeholder="samuel" readonly>
                    <div class="invalid-feedback">
                    Valid first name is required.
                    </div>
                </div>
                <!-- <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                    <div class="invalid-feedback">
                    Valid last name is required.
                    </div>
                </div> -->
                </div>

                <!-- <div class="mb-3">
                <label for="username">Username</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                    </div>
                    <input type="text" class="form-control" id="username" placeholder="Username" required="">
                    <div class="invalid-feedback" style="width: 100%;">
                    Your username is required.
                    </div>
                </div>
                </div> -->

                <div class="mb-3">
                <label for="email">Email</label>
                <!-- <input type="hidden" class="form-control"  v-model="formData.reference"> -->
                <input type="email" class="form-control" id="email" v-model="formData.email" placeholder="you@example.com" readonly/>
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
                </div>

                <div class="mb-3">
                <label for="address">Shipping Address</label>
                <input type="text" class="form-control" id="address" placeholder="Address" required="" v-model="formData.address"
                 :class="[{'is-invalid': this.errorFor('address')}]"
                >
                <validation-error :errors="errorFor('address')"></validation-error>
                </div>

                <div class="mb-3">
                <label for="address">Phone Number </label>
                <input type="phone" class="form-control" id="address" placeholder="Phone number" required="" v-model="formData.phone_number"
                :class="[{'is-invalid': this.errorFor('phone_number')}]"
                >
                <validation-error :errors="errorFor('phone_number')"></validation-error>
                </div>

                

               
                <hr class="mb-4">
           
                
                <button class="btn btn-success btn-lg btn-block w-100" type="submit" @click.prevent="checkout(this.total)">Place Order</button>
            </form>
            </div>
        </div>

        
        </div>
     </div>
</template>

<script>
import axios from "axios";
import NavCart from "../Nav/ShopNav.vue";
import LogoutAction from "../shared/mixins/LogoutAction";
import { is404, is422, is500 } from '../shared/Utils/response';
import validation_errorss from '../shared/mixins/ValidationErrors';

export default {
    mixins : [LogoutAction,validation_errorss],
    components: {
        NavCart
    },

    data() {
        return {
            formData : {
                user_id: null,
                email: null,
                name: null,
                amount: null,
                callback_url: null,
                address: null,
                phone_number: null,
            },
            newuser_id: null,
            cart_counter : null,
            basketlists: null,
            shipping: null,
            subtotal: null,
            total: null,
            dtotal : null
          }
    },

    created() {
       
        axios.get(`/api/user`, this.User.tokenBearer())
            .then((r) => {
                this.formData.user_id = r.data.user_details.id;
                this.formData.email = r.data.user_details.email;
                this.formData.name = r.data.user_details.name;
                this.newuser_id = r.data.user_details.id;
                
                axios.get(`/api/count-cart/${this.newuser_id}`, this.User.tokenBearer())
                        .then(response => {
                            this.cart_counter = response.data.basket_count;
                            
                        })
                    .catch();

                 axios.get(`/api/cart/${this.newuser_id}`)
                         .then(response => {
                             this.loading = 'true';
                             this.basketlists = response.data.data;
                             for (let i = 0; i < this.basketlists.length; i++){
                                 this.subtotal += this.basketlists[i].product.price * this.basketlists[i].qty;
                             }

                             this.total = this.subtotal;
                             this.dtotal = this.subtotal;
                             
                         })
                         .catch();   
            }
            )
            .catch();
             
    },

     methods: {
         checkout(tottal) {
             this.errors = null;
             this.formData.amount = tottal;
             axios.post(`/api/checkout`,this.formData)
                 .then(response => {
                     console.log(response);
                     var auth_url = response.data.data.authorization_url; 
                     if (auth_url) {
                        window.location = auth_url;
                     }   
                     
                 })
                 .catch((error) => {
                      if (is422(error)) {
                           this.errors = error.response.data.errors;
                      }
                 })
            
         },
         
    },

    mounted() {
        //this.formData.reference = '' + Math.floor((Math.random() * 1000000000) + 1);
        // this.formData.amount = 20000;
        this.formData.callback_url = this.User.isCallBackUrl();
        this.shipping = this.User.isShipping();
        //console.log(this.formData.callback_url);
        
    }
    
    
   }
</script>