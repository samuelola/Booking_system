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
                            <h2 class="text-center">Register</h2>
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Fullname</label>
                                <input type="text" class="form-control" name="name" :class="[{'is-invalid': this.errorFor('name')}]" v-model="formData.name">
                                <div class="invalid-feedback" v-for="(error,index) in this.errorFor('name')" :key="'name' + index">{{ error }}</div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" :class="[{'is-invalid': this.errorFor('email')}]" v-model="formData.email">
                                
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" :class="[{'is-invalid': this.errorFor('password')}]" v-model="formData.password">
                            </div>
                            
                            <button type="submit" class="btn btn-primary" @click.prevent="register">Register</button>
                        </form>

                        <router-link class="mt-4" :to="{name:'login'}">Login Here</router-link>
                    </div>
                    
                    <div class="col-md-2"></div>
            </div>
            
        </div>
        
    
</template>

<script>
export default {

    data() {
        return {
            formData:{
            name: null,
            email: null,
            password: null,
            },
            
           errors: null,
        }
    },
    methods: {
        register() {
            axios.post(`/api/register`,this.formData)
                .then(response => {
                    this.$router.push("/login")
                })
                .catch(error => {
                    
                });
            
        },
        errorFor(field) {
            return this.errors != null && this.errors[field] ? this.errors[field] : null;
        }
    }
}
</script>