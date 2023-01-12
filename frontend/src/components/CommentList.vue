<template>
  <comment-add-form @event-comment-added="loadComments"/>
  <ul class="commentList">
    <comment v-for="(comment, index) in commentList" :key="index" :info="comment"/>
  </ul>
</template>

<script>
import axios from 'axios'
import Comment from './Comment.vue'
import CommentAddForm from './CommentAddForm.vue'

export default {
  name: "CommentList",
  components: {
    Comment,
    CommentAddForm,
  },
  data: function() {
    return {
      commentList: [],
    };
  },
  mounted() {
    this.loadComments();
  },
  methods: {
    loadComments() {
      var app = this;
      axios.get('http://api.spa.local:3180/api/v1/post/comments')
          .then(function (resp) {
            app.commentList = resp.data;
          })
          .catch(function () {
            console.log("Loading error");
          });
    }
  }
}
</script>

<style scoped>
</style>