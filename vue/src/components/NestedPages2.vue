<template>
  <div>
    <div class="d-flex justify-content-center">
      <h1>Level 3</h1>
    </div>
    <div class="d-flex justify-content-center">
      <router-link :to="{ name: 'homePage'}">
      <button class="btn btn-sm btn-dark mb-4">Back to homepage</button><br>
    </router-link>
    </div>
      <div class="d-flex justify-content-center">
    <button class="btn btn-primary mb-4" @click="openAddModel(parent_id, this.$route.params.id)">Add Items</button><br>
    </div>
    <add-page ref="addpage"></add-page>
    <edit-page ref="editpage"></edit-page>
    <div v-for="(item) in getPages" :key="item.id" class="card mx-2" style="width: 18rem;display:inline-block">
      <div class="card-body">
        <a href="#"> 
        <h5 class="card-title" style="cursor: pointer;" @click="openPage(item.slug, item.id)">{{item.title}}</h5>
      </a>
        <p class="card-text">{{item.content}}</p>
        <button @click="deleteThis(item.id)" class="btn btn-sm btn-danger float-right">Delete</button>        
        <button @click="editThis(item)" class="btn btn-sm btn-info mx-3 float-right">Edit</button>
      </div>
    </div> 
  </div>
</template>

<script>
import AddPage from '../components/AddPage.vue';
import EditPage from '../components/EditPage.vue';
import store from "../store";
import router from "../router";
export default {
  components: { AddPage, EditPage },
  data() {
    return {      
      parent_id: 3,
      Form: {
        id:undefined,
      },
    }
  },
  methods: {
    editThis(item){
      this.$refs.editpage.open({item});
    },
    deleteThis(id){
      this.Form.id = id;
      store.dispatch("deletePage", this.Form)
      .then((res) => {
        if (res.success) {
          this.$router.go()
        }
      })
      .catch((err) => {
        console.log(err);
      });
    },
    openAddModel(parent_id, id) {
      this.$refs.addpage.open({parent_id, id});
    },
    openPage(slug, id){
      let data = [];
      data['slug'] = slug;
      data['id'] = id;
      store.dispatch("getNestedPages", data)
      .then((res) => {
        if (res.success) {
          router.push({ name: 'Page4', params: { slug: slug, id:id } });
        }
      })
      .catch((err) => {
        console.log(err);
      });
    },
  },
  created: function(){
    let data = [];
    data['id']=3;
    data['p_id']=this.$route.params.id;
    store.dispatch("getPages", data);
  },
  computed: {
    getPages() {
      return this.$store.getters.getPages2;
    },
  },
}
</script>