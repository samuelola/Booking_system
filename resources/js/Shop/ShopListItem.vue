<template>
     <div class="card h-100">
        <div class="card-body">
            <img :src="image" class="card-img-top" alt="...">
            <h5 class="card-title">{{ title }}</h5>
            <p>{{ description }}</p>
            <p>#{{ price }}.00</p>
            <!-- <p>{{ hearSecrettt }}</p> -->
            <!-- <router-link class="btn btn-sm btn-outline-success" :to="{name:'cart',params:{id:uuid}}" target="_blank">Add To Cart</router-link> -->
             <AddToCart @changeBasketCount="hearSecret" :productID="id" :priceCart="price"></AddToCart>
        </div>
    </div>
</template>

<script>
import AddToCart from './AddToCart.vue';
export default{

    props: {
            "image": String,
            "title": String,
            "description": String,
            "price": Number,
            "id": Number,
        "uuid": String,
    },
    components: {
        AddToCart
    },

    data() {
        return {
           hearSecrettt:null
        }
    },

    created() {
       // this.sendToAnother();
    },

    methods: {
        hearSecret(secret) {
            this.hearSecrettt = secret;
            this.sendToAnother('anotherShop',this.hearSecrettt);
        },

        sendToAnother(name,uuu) {
            this.$emit('anothershop', this.hearSecrettt); 
        }
    },



}
</script>
