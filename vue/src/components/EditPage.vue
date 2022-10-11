<template>
  <div v-if="isVisible" class="mb-4">
    <div class="card">
  <div class="card-header">
    Edit page
  </div>
  <div class="card-body">
      <input type="hidden" name="parent_id" v-model="Form.parent_id">
      <input type="hidden" name="id" v-model="Form.id">
      <div class="mb-3">
        <label for="title" class="form-label">Enter page title</label>
        <input type="email" class="form-control" name="title" id="title" placeholder="Enter title" v-model="Form.title">
        <span v-if="errors.title" class="text-danger">{{errors.title}}</span>
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Enter page content</label>
        <textarea class="form-control" id="content" name="content" rows="3" v-model="Form.content"></textarea>
        <span v-if="errors.content" class="text-danger">{{errors.content}}</span>
      </div>
    <a href="#" class="btn btn-info" @click="savePage()">Save Page</a>
    <a href="#" class="btn btn-danger mx-4" @click="close()">Cancel</a>
  </div>
</div>
  </div>
</template>

<script>
import store from "../store";
export default {
  name: 'EditPage',
  data: () => ({
    isVisible: false,
    Form: {
      parent_id: undefined,
      id: undefined,
      title: '',
      content: '',
    },
    errors: [],
  }),
  methods: {
    open(opts = {}) {
      this.Form.parent_id = opts.item.parent_id;
      this.Form.id = opts.item.id;
      this.Form.title = opts.item.title;
      this.Form.content = opts.item.content;
      this.isVisible = true
    },
    close() {
      this.isVisible = false
    },
    savePage() {
      store.dispatch("updatePage", this.Form)
      .then((res) => {
        if (res.success) {
          this.$router.go()
        }
        else{
          let errors = Object.entries(res.errors);
          this.errors = [];
          errors.forEach(element => {
            this.errors[element[0]] = element[1][0];
          });
        }
      })
      .catch((err) => {
        console.log(err);
      });
    }
  },
}
</script>
