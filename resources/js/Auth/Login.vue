<template>
     <nav class="navbar navbar-expand-lg border-bottom navbar-light bg-light">
        <div class="container-fluid">
             <router-link class="navbar-brand" :to="{name:'bookables'}">Logo</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <!-- <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'bookables'}">Home</router-link>
                    </li>
                    
                </ul> -->
                <ul class="navbar-nav ms-auto">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Pricing</a>
                    </li> -->
                    
                </ul>
            </div>
        </div>
    </nav>
    
        
        <div class="container mt-4 mb-4 pr-4 pl-4">
            
            <div class="row">
                   <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form>
                            <h2 class="text-center">Login</h2>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" v-model="formData.email">
                                
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" v-model="formData.password">
                            </div>
                            
                            <button type="submit" class="btn btn-primary" @click.prevent="login" :disabled="isSubmitting">Submit</button>
                        </form>
                        <router-link class="mt-4" :to="{name:'register'}">Register Here</router-link>
                    </div>
                    
                    <div class="col-md-2"></div>
            </div>
            
        </div>
        
    
</template>

<script>
import axios from 'axios';

export default {
    data() {

        return {
            formData: {
                email: null,
                password : null
            },
            isSubmitting:false,
        }
        
    },

    created() {
        if (localStorage.getItem('token') != '' && localStorage.getItem('token') != 'null') {
            this.$router.push('/');
        }
    },

    methods: {
        login() {

            this.isSubmitting = true;
            axios.post(`/api/login`, this.formData)
                .then(response => {

                    if (response.status === 200) {
                        localStorage.setItem('token', response.data.token);
                        this.$router.push('/');
                        //console.log(response.data.user);
                     }
                })
                .catch(error => {
                    this.isSubmitting = false;
                });
        }
    }
       
   }
</script>