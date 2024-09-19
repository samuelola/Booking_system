import Vuex from 'vuex';

const store = new Vuex.Store({
  // state: {
  //   count: 0
  // },
  // mutations: {
  //   increment (state) {
  //     state.count++
  //   }
  // }

  state: {
    lastSearch: {
      from: null,
      to:null
    }
  },
  mutations: {
    setLastSearch (state,payload) {
      state.lastSearch = payload;
    }
  },
  

})

export default store