<template>
  <div v-if="isVisible">
    <br> <hr> <br>
    <h1>addpage</h1>
    <input type="hidden" name="parent_id" v-model="Form.parent_id">
    <label for="title">Enter page title</label><br>
    <input type="text" name="title" id="title" v-model="Form.title" style="margin-bottom: 20px;">
    <br>
    <label for="content" >Enter page content</label><br>
    <textarea name="content" id="content" cols="30" rows="10" v-model="Form.content"></textarea>
    <br> <hr> <br>
    {{Form}}
  </div>
</template>

<script>
export default {
  name: 'AddPage',
  data: () => ({
    isVisible: false,
    Form: {
      parent_id: undefined,
      title: '',
      content: '',
    },
  }),
  methods: {
    open(opts = {}) {
      this.Form.parent_id = opts.parent_id;
      this.isVisible = true
    },
    close() {
      this.isVisible = false
    },
  },
}
</script>
