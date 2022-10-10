 import axios from "axios";
 import store from "./store";
 import router from "./router";
 
 const axiosClient = axios.create({
  //  baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`
   baseURL: `http://localhost:8000/api`
 })
 
 axiosClient.interceptors.request.use(config => {
   config.headers.Accept = `application/json`
   return config;
 })
 
 axiosClient.interceptors.response.use(response => {
   return response;
 }, error => {
   if (error.response.status === 404) {
     router.push({name: 'NotFound'})
   }
   return error;
 })
 
 export default axiosClient;
 