<template>
    <div>
        
        <div class="container">
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
                    </div>
                    <div class="col-md-2"></div>
            </div>
            
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