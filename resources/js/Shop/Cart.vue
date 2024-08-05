<template>
    <NavCart></NavCart>
    
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
                                    <th scope="col" class="text-right">Price</th>
                                    <th scope="col" class="text-right">Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr  v-for="basketlist in basketlists" :key="basketlist">
                                    <td><img :src="basketlist.product.image" width="50" height="50"/> </td>
                                    <td>{{ basketlist.product.title }}</td>
                                    <td><input class="form-control" type="text" v-model="basketlist.qty" /></td>
                                    <td class="text-right"># {{ $filters.formatPrice(basketlist.product.price) }}</td>
                                    <td class="text-right"># {{ $filters.formatPrice(basketlist.price) }}</td>
                                    <td class="text-right"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> </td>
                                </tr>
                            
                                
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Sub-Total</td>
                                    <td class="text-right">#{{ subtotal }}</td>
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
                                    <td class="text-right"><strong>#{{ total }}</strong></td>
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
                        <div class="col-sm-12 col-md-6 text-right">
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
            price : null,
            user_idd : null,
            basketlists: null,
            subtotal: 0,
            total: 0,
            shipping: 6.95,
            loading: false
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
                     // console.log(this.user_idd);
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
                 }
                 
            })
            .catch((e) => {
            return e
            });
       
    },
    


    
}
</script>