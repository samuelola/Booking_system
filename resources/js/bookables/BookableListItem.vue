<template>
    <div class="card h-100">
        <div class="card-body">
            <img src="https://www.w3schools.com/html/pic_trulli.jpg" class="card-img-top" alt="...">
            <router-link class="title" :to="{name:'bookable', params:{id}}" target="_blank">
                <h5 class="card-title">{{ title }}</h5>
            </router-link>
             <p class="card-text">{{ description }}</p>
            <b>Created : {{ $filters.dateformatt(created_at)}}</b>
        </div>
    </div>
 </template>
 
 <script>
    export default{
        props : {"title" : String,"description": String,"id": Number,"created_at":Number},
        
    }
 </script>
 
 <style scoped>
    .title{
        text-decoration: none;
    }
    
 </style>