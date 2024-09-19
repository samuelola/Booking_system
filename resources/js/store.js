import Vuex from 'vuex';
import { isLoggedIn } from './shared/Utils/auth';

const store = new Vuex.Store({
  
  state: {
    lastSearch: {
      from: null,
      to:null
    },
    isLoggedIn: false,
    user: {
      
    }
  },
  mutations: {
    setLastSearch (state,payload) {
      state.lastSearch = payload;
    },
    setUser(state,payload) {
       state.user = payload
    },
    setLoggedIn(state,payload) {
        state.isLoggedIn = payload
    }
  },
  actions: {
    setLastSearch(context,payload) {
      context.commit('setLastSearch',payload);
      localStorage.setItem('lastSearch', JSON.stringify(payload));
    },

     //to load the localstorage to vuex 
    loadStoredState(context) {
    const lastSearch = localStorage.getItem('lastSearch');
     if (lastSearch) {
      context.commit('setLastSearch', JSON.parse(lastSearch));
     }
    },

    async loadUser({commit,dispatch}) {
      if (isLoggedIn) {
          try {
            //const User = (await axios.get(`/user`)).data;
           } catch (error) {
          
           }
        }
     }
  },
 
  
  

})

export default store