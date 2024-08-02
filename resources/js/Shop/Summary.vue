<template>
      <Navigation></Navigation>
      <div class="container mt-5">
          <div class="row">
              <div class="col-md-8">
                  <h4>User Info</h4> 
                  <div class="card h-100">
                       <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Fullname</label>
                                    <input type="text" class="form-control" name="name" v-model="user.name" readonly>
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" v-model="user.email" readonly>
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control"  name="address" v-model="user.address">
                                    
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control"  name="phone" v-model="user.phone">
                                    
                                </div>
                            </form>
                       </div>
                  </div>
                    
              </div>
              <div class="col-md-4">
                <h4>Order Details</h4> 
                <div class="card h-100">
                    <div class="card-body">
                        <img :src="image" alt="" class="card-img-top">
                        <h5 class="card-title">Title :{{ title }}</h5>
                        <p>Price : <b># {{ price }}.00</b></p>
                        <button type="submit" class="btn btn-sm btn-outline-success" @click.prevent="submit">Checkout</button>
                    </div>
                </div>
                  
                   

              </div>
          </div>
      </div> 
</template>

<script>
import UserInfo from "../shared/mixins/UserInfo";
import Navigation from "../Nav/Nav.vue"
import axios from "axios";
export default {
    mixins: [UserInfo],
    components: {
        Navigation
    },
    data() {
        return {
            shop_details: null,
            image: null,
            title: null,
            price : null,
            user: {
                name: null,
                email: null,
                address: null,
                phone : null,
            },
             
        }
         
    },

    created() {

        axios.get(`/api/shops/${this.$route.params.id}`)
            .then(resp => {
                this.shop_details = resp.data.data;
                this.image = this.shop_details.image;
                this.title = this.shop_details.title;
                this.price = this.shop_details.price;
                //console.log(this.shop_details);
            })
            .catch();
    },
    methods:{

        submit(){

            axios.post(`/api/shop/${this.$route.params.id}`,user)
                .then()
                .catch();

        },
        
    }
 }
</script>