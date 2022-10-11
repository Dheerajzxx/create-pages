<template>
  <div>
    <div class="d-flex justify-content-center">
      <h1>Level 5</h1>
    </div>
      <div class="d-flex justify-content-center">
    <button class="btn btn-primary mb-4" @click="openAddModel(parent_id, this.$route.params.id)">Add Items</button><br>
    </div>
    <add-page ref="addpage"></add-page>
    <div v-for="(item) in getPages" :key="item.id" class="card mx-2" style="width: 18rem;display:inline-block">
      <div class="card-body">
        <h5 class="card-title" style="cursor: pointer;" @click="openPage(item.slug, item.id)">{{item.title}}</h5>
        <p class="card-text">{{item.content}}</p>
        <button @click="deleteThis(item.id)" class="btn btn-sm btn-danger float-right">Delete</button>
      </div>
    </div>
  </div>
</template>

<script>
import AddPage from '../components/AddPage.vue';
import store from "../store";
import router from "../router";
export default {
  components: { AddPage },
  data() {
    return {      
      parent_id: 5,
      Form: {
        id:undefined,
      }
    }
  },
  methods: {
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
          router.push({ name: 'Page5', params: { slug: slug, id:id } });
        }
      })
      .catch((err) => {
        console.log(err);
      });
    },
  },
  created: function(){
    let data = [];
    data['id']=5;
    data['p_id']=this.$route.params.id;
    store.dispatch("getPages", data);
  },
  computed: {
    getPages() {
      return this.$store.getters.getPages4;
    },
  },
}
</script>