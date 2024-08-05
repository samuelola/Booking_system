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
    

<section class="vh-100"  style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;position: relative;top:-1px">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                <form class="mx-1 mx-md-4">
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example1c">Your Name</label>  
                      <input type="text" id="form3Example1c" class="form-control" :class="[{'is-invalid': this.errorFor('name')}]" v-model="formData.name" />
                       <div class="invalid-feedback" v-for="(error,index) in this.errorFor('name')" :key="'name' + index">{{ error }}</div>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <label class="form-label" for="form3Example3c">Your Email</label>  
                      <input type="email" id="form3Example3c" class="form-control" name="email" :class="[{'is-invalid': this.errorFor('email')}]" v-model="formData.email" />
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                       <label class="form-label" for="form3Example4c">Password</label> 
                      <input type="password" id="form3Example4c" class="form-control" name="password" :class="[{'is-invalid': this.errorFor('password')}]" v-model="formData.password" />
                      
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" @click.prevent="register">Register</button>
                  </div>

                </form>
                  <router-link style="margin-left:28px;" :to="{name:'login'}">Login Here</router-link>  
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
         </section>
        
    
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