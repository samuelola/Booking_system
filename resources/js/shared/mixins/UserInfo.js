export default {

    data() {
        
        return {

            user: null,
            user_id : null
        }
    },
    
    created() {
         this.getUser();
        if (localStorage.getItem('token') == "" || localStorage.getItem('token') == null) {
            this.$router.push('/login');
        } else {
            this.getUser();
        }
    },

    methods: {
        getUser() {

            axios.get(`/api/user`, { headers: { Authorization: 'Bearer ' + localStorage.getItem('token') } })
             .then((r) => {
                 this.user = r.data.user_details;
                 this.user_id = r.data.user_details.id
                 //console.log(user);
            })
            .catch((e) => {
            return e
            });
        }, 
    }
}