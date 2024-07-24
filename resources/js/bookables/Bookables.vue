<template>
    <div>
        <h3 class="profile">Welcome {{ user?.name }}</h3>
        <div v-if="loading">
              <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-items-stretch" v-for="(bookable, column) in bookablesInRow(row)"
                 :key="'row' + row + column"
                >

                  <BookableListItem
                  v-bind="bookable"
                   ></BookableListItem>
                    
                </div>
                  <div class = "col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
                  
            </div>
         </div>
         
         <div v-else>
             Data is Loading.....
         </div>
    
    </div>
    
</template>

<script>
import BookableListItem from "./BookableListItem.vue";

export default {
    components: {
        BookableListItem,
    },
    data() {
        return {
            bookables: null,
            loading : false,
            columns: 3,
            user:null
        };
    },
    created() {
        this.getUser();
        if (localStorage.getItem('token') == "" || localStorage.getItem('token') == null) {
            this.$router.push('/login');
        } else {
            this.getUser();
        }
        const request = axios.get('/api/bookables')

            .then(response => {
                this.loading = 'true';
                this.bookables = response.data.data;
                //this.bookables.push({ title: "x", description: "x" });
                
            });

    },
    computed:{
      rows(){
         return this.bookables == null ? 0 : Math.ceil(this.bookables.length/this.columns);
      }
    },
    methods: {

      getUser() {

            axios.get(`/api/user`, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
             .then((r) => {
                 this.user = r.data.user_details;
                 console.log(user);
            })
            .catch((e) => {
            return e
            });
      },  

      bookablesInRow(row){
         return this.bookables.slice((row - 1) * this.columns, row * this.columns);
      },

      //this  function you to adjust the last item to be in a single column
      placeholdersInRow(row){
         return this.columns - this.bookablesInRow(row).length;
      }
    
    },
    
};
</script>

<style scoped>
   .profile{
    margin-bottom: 32px;
   }
</style>
