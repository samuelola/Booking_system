<template>
    <a href="#" @click.prevent="addToCart" class="btn btn-sm btn-outline-success">Add To Cart</a>
</template>

<script>
export default {
    
    props: { 'productID': Number,'priceCart': Number},
    data() {
        return {
            formData: {
                product_id: this.productID, 
                user_id: null,
                price : this.priceCart
            },
            basketCountValue: null
            
        }
    },
    created() {

        axios.get(`/api/user`, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
             .then((r) => {
                 this.formData.user_id = r.data.user_details.id;
                 
            })
            .catch((e) => {
            return e
            });
        
    },
    methods: {
       
    addToCart() {
            axios.post(`/api/cart`, this.formData, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
                .then(response => {
                    this.basketCountValue = response.data.basket_count;
                    this.$emit('changeBasketCount', this.basketCountValue);  
                })
                .catch();

        },
        
    }
}
</script>