<template>
  <div>
    <h1>HomePage</h1>
    <button @click="openAddModel(parent_id)">Add New Page</button>
    <button @click="closeAddModel()">Close</button>
    <add-page ref="addpage"></add-page>
  </div>
</template>

<script>
import AddPage from '../components/AddPage.vue';
import store from "../store";
export default {
  components: { AddPage },
  data() {
    return {      
      parent_id: 1,
    }
  },
  methods: {
    openAddModel(parent_id) {
      this.$refs.addpage.open({parent_id});
    },
    closeAddModel() {
      this.$refs.addpage.close();
    },
  },
  created: function(){
    store.dispatch("getPages", 4);
  },
}
</script>