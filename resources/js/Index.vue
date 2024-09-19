<template>
    <div>
        <router-view/>
    </div>
    
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            lastSearch:this.$store.state.lastSearch
        }
    },

    computed: {
        ...mapState({
           lastSearchComputed : "lastSearch"
        }),
        somethingElse() {
            return 1 + 2;
        }
    },

    beforeCreate() {
        this.$store.dispatch("loadStoredState");
    }
}
</script>
