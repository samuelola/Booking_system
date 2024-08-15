export default {
    
    methods: {
        logoutAction() {
            axios.post('/api/logout', {}, this.User.tokenBearer())
                .then(res => {
                    localStorage.setItem('token', '');
                    this.$router.push('/login')
                })
                .catch(e => {
                    return e;
                })
        }
    }
}