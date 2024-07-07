<template>
    <div>
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
            columns:3
        };
    },
    computed:{
      rows(){
         return this.bookables == null ? 0 : Math.ceil(this.bookables.length/this.columns);
      }
    },
    methods:{

      bookablesInRow(row){
         return this.bookables.slice((row - 1) * this.columns, row * this.columns);
      },

      //this  function you to adjust the last item to be in a single column
      placeholdersInRow(row){
         return this.columns - this.bookablesInRow(row).length;
      }
    
    },
    created() {
        
        const request = axios.get('/api/bookables')

            .then(response => {
                this.loading = 'true';
                this.bookables = response.data.data;
                //this.bookables.push({ title: "x", description: "x" });
                
            });

    },
};
</script>

<style></style>
