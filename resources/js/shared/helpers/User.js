class User{

    
    getToken(){
        return localStorage.getItem('token');
    }
        
    userid() {
        return this.payload().sub
    }
        
    payload(){
        const payload =  this.getToken().split('.')[1];
        return this.decode(payload)
    }
    
    decode(payload){
        return JSON.parse(atob(payload))
    }

    isUrl(){
        return window.location.origin
    }
    
    logoutUser() {
       return localStorage.setItem('token', '');
    }

    tokenBearer() {
        const headers = { headers: { Authorization: 'Bearer ' + this.getToken() } }

        return headers;
    }

    setToken(token) {
        
       return localStorage.setItem('token', token);
    }

    isValid(){
        return this.getToken != '' && this.getToken != 'null'
    }

    isCallBackUrl() {
        return "http://localhost:8000/api/payment-callback";
    }
    isShipping() {
        
        return 6.95;
    }
    
}

export default User = new User();