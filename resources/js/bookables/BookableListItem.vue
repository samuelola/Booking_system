<template>
    <div class="card w-100">
        <div class="card-body">
            <router-link class="title" :to="{name:'bookable', params:{id}}">
                <h5 class="card-title">{{ title }}</h5>
            </router-link>
            
            <p class="card-text">{{ description }}</p>
            <!-- <p><b>{{ id }}</b></p> -->
            <!-- <b>Created : {{ created_at }}</b> -->
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