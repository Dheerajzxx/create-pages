import { createStore } from "vuex";
import axiosClient from "../axios";
import createPersistedState from "vuex-persistedstate";


const store = createStore({
  state: {
    pages:{},
  },
  getters: {},
  actions: {
    async getPages({commit}, id) {
      return await axiosClient.get('/pages/'+id)
      .then(res => {
        console.log(res.date);
        // if (res.data.success) {
        //   commit('setPages', res.data.pages);
        // }
        return res.data;
      })
    },
  },
  mutations: {
    setPages: (state, pages) => {
      state.pages = pages;
    },
  },
  modules: {},
  plugins: [createPersistedState()],
});

export default store;
