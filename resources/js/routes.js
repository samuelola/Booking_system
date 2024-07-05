import {createRouter, createWebHistory } from "vue-router";
import Bookables from "./bookables/Bookables.vue";
import Example2 from "./components/Home2.vue";


const routes = [
    {

        path: "/",
        component: Bookables,
        name : "bookables"

    },

    {

        path: "/example2",
        component: Example2,
        name : "example2"

    }
];

const router = createRouter({

    history: createWebHistory(),
    
    routes

})

export default router