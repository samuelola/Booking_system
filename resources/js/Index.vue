<template>
    <div>
        <!-- <nav class="navbar bg-white border-bottom navbar-light">
            <router-link class="navbar-brand mr-auto" :to="{name:'bookables'}">Home</router-link>
        </nav> -->
        <nav class="navbar navbar-expand-sm bg-white border-bottom navbar-light">
             <div class="container-fluid">
                 <router-link class="navbar-brand" :to="{name:'bookables'}">Logo</router-link>

                 <button class="navbar-toggler" type="button" data-bs-toogle="collapse"
                    data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                 </button>
                 <div class="collapse navbar-collapse" id="collapsibleNavbar">
                     <ul class="navbar-nav">
                         <li class="nav-item">
                             <router-link class="nav-link" :to="{name:'bookables'}">Home</router-link>
                         </li>
                     </ul>
                 </div>
             </div>
             
                 <div v-if="fgg">
                    
                 </div>
                 
                <div v-else>
                    
                </div>

                <div class="d-flex" role="search">
                        <ul class="navbar-nav">
                            <li class="nav-item">

                                <button type="submit" class="btn btn-outline-primary" @click="logoutAction">Logout</button>
                            </li>
                        </ul>
            
                    </div>
            
             
             
        </nav>
        <!-- <nav class="navbar navbar-expand-sm bg-white fixed-top border-bottom navbar-light">
             <div class="container-fluid">
                 <router-link class="navbar-brand" :to="{name:'bookables'}">Logo</router-link>

                 <b-button 
                    v-b-toggle.collapse-1   
                    variant="primary"
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#menuItems"
                    aria-controls="menuItems"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                  >
                    <span class="navbar-toggler-icon"></span>
                 </b-button>
                 <b-collapse id="collapse-1" class="mt-2 collapse navbar-collapse">
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item">
                                  <router-link class="nav-link" :to="{name:'bookables'}">Home</router-link>
                          </li>
                      </ul>
                 </b-collapse>
             </div>
             
        </nav> -->
        <div class="container mt-4 mb-4 pr-4 pl-4">
            <router-view/>
        </div>
        
    </div>
    
</template>

<script>
export default {

    data() {

        return {
            fgg: false
        }
    },

    mounted(){
        this.fgg = false;
        if (localStorage.getItem('token') == "" || localStorage.getItem('token') == null) {
                this.fgg = true;
                console.log(this.fgg);
            }
        
    },
    methods: {
        logoutAction() {
            axios.post('/api/logout', {}, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
                .then(res => {
                    localStorage.setItem('token', '');
                    this.$router.push('/login')
                })
                .catch(e => {
                    return e;
                })
        },

        
        
    },

   
      
   }
   
</script>