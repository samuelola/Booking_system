<template>
    <div class="text-center success">
       <i class="fas fa-thumbs-up"></i>
       <h1 class="mt-4">Congratulations !</h1>
       <h2>You have successfully completed a review</h2>
       <p style="text-align:center">
                 ​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​​<router-link style="text-align:center;font-size: 20px;"  :to="{name:'bookables'}">Back to Home</router-link>
       </p>
    </div>
</template>

<script>
export default {

    
  }
</script>

<style scoped>
  .success{
    color:#999;
    font-size: 10rem;
  }
</style>