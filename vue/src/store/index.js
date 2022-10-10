import { createStore } from "vuex";
import axiosClient from "../axios";
import createPersistedState from "vuex-persistedstate";


const store = createStore({
  state: {},
  getters: {},
  actions: {},
  mutations: {},
  modules: {},
  plugins: [createPersistedState()],
});

export default store;
