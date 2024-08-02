import {createRouter, createWebHistory } from "vue-router";
// import Bookables from "./bookables/Bookables.vue";
import Bookable from "./bookable/Bookable.vue";
import Review from "./Review/Review.vue";
import Login from "./Auth/Login.vue";
import Register from "./Auth/Register.vue";
import Shop from "./Shop/shop.vue";
import Summary from "./Shop/Summary.vue";
import Admin from "./Admin/Admin.vue";
import Cart from "./Shop/Cart.vue";


const routes = [
    {

        path: "/",
        component: () => import("./bookables/Bookables.vue"), //this section Implementing Lazy Loading for Improved Performance
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
    {

        path: "/shop",
        component: Shop,
        name : "shop"

    },
    {

        path: "/summary/:id",
        component: Summary,
        name : "summary"

    },
    {

        path: "/admin/",
        component: Admin,
        name : "admin"

    },
    {

        path: "/cart",
        component: Cart,
        name : "cart"

    },
    
   
];

const router = createRouter({

    history: createWebHistory(),
    
    routes

})

export default router