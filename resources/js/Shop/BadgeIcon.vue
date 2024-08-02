<template>
    <span class="badge text-bg-primary align-top mr-4">0</span>
</template>

<script>
export default {

    props:{'review': String},

    data() {
        return {
            basketCount:this.review ,
            changeBasketCount : null
       } 
    },

    methods: {

       countBasket(n) {
            console.log(n);
        }
   }
}
</script>