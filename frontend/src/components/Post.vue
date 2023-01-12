<template>
  <div class="post">
    <h1>Lorum Ipsum</h1>
    <slot></slot>
  </div>
  <comment-list />
</template>

<script>
import CommentList from './CommentList.vue'

export default {
  name: 'Post',
  components: {
    CommentList,
  }
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
