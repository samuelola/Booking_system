<template>
    <div>
      <h6 class="text-uppercase text-secondary font-weight-bolder">Check Availability
        <transition>
            <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
            <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>  
        </transition>
      </h6>
      <div class="form-row">
         <div class="form-group col-md-6">
            <label for="from">From</label>
            <input type="text" name="from" class="form-control form-control-sm" placeholder="Start Date"
             v-model="from"
             @keyup.enter="check"
             :class="[{'is-invalid': this.errorFor('from')}]"
             >
              <!--<div class="invalid-feedback" v-for="(error,index) in this.errorFor('from')" :key="'from' + index">{{ error }}</div>-->
              <validation-error :errors="errorFor('from')"></validation-error>
         </div>
         <div class="form-group col-md-6">
            <label for="to">To</label>
            <input type="text" name="to" class="form-control form-control-sm" placeholder="End Date" 
            v-model="to"
            @keyup.enter="check"
            :class="[{'is-invalid': this.errorFor('to')}]"
            >
             <!--<div class="invalid-feedback" v-for="(error,index) in this.errorFor('to')" :key="'to' + index">{{ error }}</div>-->
            <validation-error :errors="errorFor('to')"></validation-error>
           
         </div>
      </div>
      <button class="btn btn-secondary mt-2 w-100" @click="check" :disabled="loading">
       <span v-if="!loading">Check</span> 
       <span v-if="loading"><i class="fas fa-circle-notch fa-spin"></i> Checking...</span>
    </button>
    </div>
</template>

<script>
import { is422 } from '../shared/Utils/response';
import validation_errorss from '../shared/mixins/ValidationErrors';
export default {
    mixins: [validation_errorss],
    props: {
        bookableId : String
    },
    data() {
        return {
            from: this.$store.state.lastSearch.from,
            to: this.$store.state.lastSearch.to,
            loading: false,
            status: null,
            // errors : null
        }
    },

    methods: {
        check() {
            this.loading = true;
            this.errors = null;
            this.$store.dispatch('setLastSearch',{
                from: this.from,
                to : this.to
            })
            //console.log(this.$store.state.lastSearch)
            axios.get(`/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`)
                .then(response => {
                    this.status = response.status
                })
                .catch(error => {
                    if (is422(error)) {
                        this.errors = error.response.data.errors;
                    }
                    this.status = error.response.status;
                })
                .then(() => (this.loading = false));
        },

        // errorFor(field) {
        //     return this.hasErrors && this.errors[field] ? this.errors[field] : null;
        // }
    },

    computed: {
        
        hasErrors() {
            return 422 == this.status && this.errors != null;
        },
        hasAvailability() {
            return 200 == this.status;
        },
        noAvailability() {
            return 404 == this.status;
        }
    },
    
    
}

</script>

<style scoped>
     label{
        font-size: 0.7rem;
        text-transform: uppercase;
        color: gray;
        font-weight: bolder;
     }
     .form-row{
        display:flex;
     }
     .is-invalid{
        border-color: #b22222;
        background-image: none;
     }
     .invalid-feedback{
        color: #b22222;
     }

 

.v-enter-active, .v-leave-active{
    transition: opacity 0.5;
}

.v-enter,
.v-leave-to {
    opacity: 0;
}


</style>



