<template>
    <NavCart></NavCart>
    
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
                                <td class="text-right">255,90 €</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Shipping</td>
                                <td class="text-right">6,90 €</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td class="text-right"><strong>346,90 €</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <button class="btn btn-block btn-light">Continue Shopping</button>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
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
                             this.basketlists = response.data.data;
                             
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