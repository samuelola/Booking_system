<template>
    <div>
        <div class="container">
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
                    </div>
                    <div class="col-md-2"></div>
            </div>
            
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