<template>
    <div class="d-flex">
        <!-- <i class="fas fa-star" v-for = "star in fullStars" :key="'full' + star"
         @click="$emit('rating:changed',star)"></i> -->
         <button class="btn btn-sm rating_button" v-for = "star in fullStars" :key="'full' + star" @click="$emit('rating:changed',star)">
            <i class="fas fa-star"></i>
         </button>
         <button class="btn btn-sm rating_button" v-if="halfStar"><i class="fas fa-star-half-alt" ></i></button>
        
         <button class="btn btn-sm rating_button" v-for = "star in emptyStar" :key="'empty' + star"
        
        @click="$emit('rating:changed',fullStars + star)"><i class="far fa-star" ></i></button>
        
    </div>
</template>

<script>

export default {

    props: {
        value:Number
    }
    ,
    computed: {
        halfStar() {
            const fraction = Math.round(this.value - Math.floor(this.value)*100);
            //console.log(fraction);
            fraction > 0 && fraction < 50;
        },
        fullStars() {
            // > 4.5  = 5 stars
            // > 4.3 = 4  and half
            return Math.round(this.value);
        },
        emptyStar() {
            // if rating is 1.9  for ceil(1.9) = 2 ie 5-2 therefore render 3 stars
            return 5 - Math.ceil(this.value);
        }
    },

    // created() {
    //     const numbers = [0.9, 4.0,4.4, 4.5, 4.6, 4.9];

    //     numbers.forEach(n => {
    //         console.log(`round for ${n} is ${Math.round(n)}`);
    //         console.log(`floor for ${n} is ${Math.floor(n)}`);
    //         console.log(`ceil for ${n} is ${Math.ceil(n)}`);
    //         console.log("==================================");
    //     });
    // }
}

</script>

<style scoped>
    .rating_button{
        border:transparent !important ;
         cursor: default;
    }
    .fa-star{
        font-size: xx-large !important;
        cursor: default;
    }
</style>