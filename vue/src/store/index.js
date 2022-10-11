import { createStore } from "vuex";
import axiosClient from "../axios";
import createPersistedState from "vuex-persistedstate";


const store = createStore({
  state: {
    pages1:{},
    pages2:{},
    pages3:{},
    pages4:{},
    pages5:{},
  },
  getters: {    
    getPages:(state)=>{return state.pages1; },
    getPages1:(state)=>{return state.pages2; },
    getPages2:(state)=>{return state.pages3; },
    getPages3:(state)=>{return state.pages4; },
    getPages4:(state)=>{return state.pages5; },
  },
  actions: {
    async getPages({commit}, data) {
      return await axiosClient.get('/pages/'+data['id']+'/'+data['p_id'])
      .then(res => {
        if (res.data) {
          if (data['id'] == 1) {
            commit('setPages', res.data.pages);            
          }else if (data['id'] == 2) {
            commit('setNestedPages1', res.data.pages);
          }else if (data['id'] == 3) {
            commit('setNestedPages2', res.data.pages);
          }else if (data['id'] == 4) {
            commit('setNestedPages3', res.data.pages);
          }else if (data['id'] == 5) {
            commit('setNestedPages4', res.data.pages);
          }
        }
        return res.data;
      })
    },
    async getNestedPages({commit}, data) {
      return await axiosClient.get('/pages/nested/'+data['slug'])
      .then(res => {
        if (res.data) {
          // commit('setPages', res.data.pages);
        }
        return res.data;
      })
    },
    async savePage({commit}, data) {
      return await axiosClient.post('/pages/save', data)
      .then(res => {
        return res.data;
      })
    },
  },
  mutations: {
    setPages: (state, pages) => {
      state.pages1 = pages;
    },
    setNestedPages1: (state, pages) => {
      state.pages2 = pages;
    },
    setNestedPages2: (state, pages) => {
      state.pages3 = pages;
    },
    setNestedPages3: (state, pages) => {
      state.pages4 = pages;
    },
    setNestedPages4: (state, pages) => {
      state.pages5 = pages;
    },
  },
  modules: {},
  plugins: [createPersistedState()],
});

export default store;
