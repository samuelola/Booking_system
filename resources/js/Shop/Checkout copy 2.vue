<template>
     <div>
        <NavCart></NavCart>
        <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">Product name</h6>
                    <small class="text-muted">Brief description</small>
                </div>
                <span class="text-muted">$12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">Second product</h6>
                    <small class="text-muted">Brief description</small>
                </div>
                <span class="text-muted">$8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0">Third item</h6>
                    <small class="text-muted">Brief description</small>
                </div>
                <span class="text-muted">$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                <div class="text-success">
                    <h6 class="my-0">Promo code</h6>
                    <small>EXAMPLECODE</small>
                </div>
                <span class="text-success">-$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                <span>Total (USD)</span>
                <strong>$20</strong>
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Promo code">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
                </div>
            </form>
            </div>
            <div class="col-md-8 order-md-1 mb-5">
            <h4 class="mb-3">Billing address</h4>
            <form class="needs-validation" novalidate="">
                <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="firstName">Name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="" v-mode="formData.name" required="">
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
                <input type="email" class="form-control" id="email" v-model="formData.email" placeholder="you@example.com">
                <div class="invalid-feedback">
                    Please enter a valid email address for shipping updates.
                </div>
                </div>

                <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                <div class="invalid-feedback">
                    Please enter your shipping address.
                </div>
                </div>

                

                <div class="row">
                <div class="col-md-5 mb-3">
                    <label for="country">Country</label>
                    <select class="form-control d-block w-100" id="country" required="">
                        <option value="">Choose...</option>
                        <option>United States</option>
                    </select>
                    <div class="invalid-feedback">
                    Please select a valid country.
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="state">State</label>
                    <select class="form-control d-block w-100" id="state" required="">
                    <option value="">Choose...</option>
                    <option>California</option>
                    </select>
                    <div class="invalid-feedback">
                    Please provide a valid state.
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" placeholder="" required="">
                    <div class="invalid-feedback">
                    Zip code required.
                    </div>
                </div>
                </div>
                <hr class="mb-4">
           
                <!-- <h4 class="mb-3">Payment</h4> -->

                <!-- <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                    <label class="custom-control-label" for="credit">Credit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="debit">Debit card</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                    <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
                </div> -->
                <!-- <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Name on card</label>
                    <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                    <small class="text-muted">Full name as displayed on card</small>
                    <div class="invalid-feedback">
                    Name on card is required
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Credit card number</label>
                    <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                    <div class="invalid-feedback">
                    Credit card number is required
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Expiration</label>
                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                    <div class="invalid-feedback">
                    Expiration date required
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">CVV</label>
                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                    <div class="invalid-feedback">
                    Security code required
                    </div>
                </div>
                </div> -->
                <!-- <hr class="mb-4"> -->
                <!-- <button class="btn btn-success btn-lg btn-block w-100" type="submit" @click.prevent="checkout">Place Order</button> -->
            </form>
            </div>
        </div>

        
        </div>
     </div>
</template>

<script>
import axios from "axios";
import NavCart from "../Nav/ShopNav.vue";

export default {

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
                callback_url : null
            }
              
          }
    },

    created() {
          
          const headers = {
              Authorization: 'Bearer ' + localStorage.getItem('token')   
        }

        axios.get(`/api/user`,{headers})
            .then((r) => {
                this.formData.user_id = r.data.user_details.id;
                this.formData.email = r.data.user_details.email;
                this.formData.name = r.data.user_details.name;
              }
            )
            .catch()
    },

     methods: {
         checkout() {
             axios.post(`/api/checkout`,this.formData)
                 .then(response => {
                     console.log(response);
                     var auth_url = response.data.data.authorization_url; 
                     if (auth_url) {
                         window.location = auth_url;
                     }   
                     
                 })
                 .catch();
         },
         
    },

    mounted() {

        //this.formData.reference = '' + Math.floor((Math.random() * 1000000000) + 1);
        this.formData.amount = 20000;
        this.formData.callback_url = "http://localhost:8000/api/payment-callback";
    }
    
    
   }
</script>