<template>
        <nav class="navbar navbar-expand-lg border-bottom navbar-light bg-light">
        <div class="container-fluid">
             <router-link class="navbar-brand" :to="{name:'bookables'}">Logo</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'bookables'}">Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'shop'}">Shop</router-link>
                    </li>
                    <li class="nav-item" v-if="check">
                        <router-link class="nav-link" :to="{name:'admin'}">Admin</router-link>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Pricing</a>
                    </li> -->
                    <li class="nav-item">
                        <button type="submit" class="btn btn-outline-primary" @click="logoutAction">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        
</template>

<script>
import LogoutAction from "../shared/mixins/LogoutAction";
import UserInfo from "../shared/mixins/UserInfo";
export default {
    mixins: [LogoutAction, UserInfo],

    computed: {

        check() {
           return this.user?.role != '' && this.user?.role == 1;
        }
    }
       
   }

</script>