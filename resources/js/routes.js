import {createRouter, createWebHistory } from "vue-router";
import Bookables from "./bookables/Bookables.vue";
import Bookable from "./bookable/Bookable.vue";
import Review from "./Review/Review.vue";
import Login from "./Auth/Login.vue";
import Register from "./Auth/Register.vue";



const routes = [
    {

        path: "/",
        component: Bookables,
        name : "bookables"

    },
    {

        path: "/bookable/:id",
        component: Bookable,
        name : "bookable"

    },
    {

        path: "/review/:id",
        component: Review,
        name : "review"

    },
    {

        path: "/login",
        component: Login,
        name : "login"

    },
    {

        path: "/register",
        component: Register,
        name : "register"

    },
    
   
];

const router = createRouter({

    history: createWebHistory(),
    
    routes

})

export default router