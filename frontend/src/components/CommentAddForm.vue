<template>
  <div v-if="serverError" class="errors" v-html="serverError" />
  <form class="commentAddForm" @submit="sendCommentForm" ref="commentForm">
    <div class="line"><b>Введите ваше сообщение:</b></div>
    <div class="line">
      <input
          class="input"
          type="text"
          v-model="userName"
          placeholder="Введите ваше имя"
          required="required"
          @invalid="invalidateForm"
      >
    </div>
    <div class="line">
      <input
          class="input"
          type="email"
          v-model="userEmail"
          placeholder="Введите ваш E-mail"
          required="required"
          @invalid="invalidateForm"
      >
    </div>
    <div class="line">
      <input
          class="input"
          type="text"
          v-model="title"
          placeholder="Введите тему сообщения"
          required="required"
          @invalid="invalidateForm"
      >
    </div>
    <div class="line">
      <textarea
          class="input"
          v-model="content"
          placeholder="Введите текст сообщения"
          required="required"
          @invalid="invalidateForm"
      ></textarea>
    </div>
    <div class="line">
    <input type="submit" />
    </div>
  </form>
</template>

<script>
import axios from 'axios'

export default {
  name: "CommentAddForm",
  data: function () {
    return {
      serverErrorStatus: false,
      serverError: '',
      userName: '',
      userEmail: '',
      title: '',
      content: '',
      errors: false
    };
  },
  methods: {
    invalidateForm() {
      this.errors = true;
    },
    sendCommentForm(e) {
      e.preventDefault()
      const newPost = {
        userName: this.userName,
        userEmail: this.userEmail,
        title: this.title,
        content: this.content,
      };
      const app = this;
      axios.post('http://api.spa.local:3180/api/v1/post/comment/add', newPost)
          .then(function (response) {
            app.$emit('event-comment-added', response.data);
            app.clearForm();
          })
          .catch(function (response) {
            app.serverErrorStatus = true;
            app.serverError = response.response.data.error;
          });
      return false;
    },
    clearForm() {
      this.$refs.commentForm.reset();
    }
  }
}
</script>

<style scoped>
.errors {
  border: 1px solid #7a1717;
  background-color: #f5c7c7;
  padding: 1rem;
  margin-top: 1rem;
  margin-bottom: 1rem;
  border-radius: 5px;
}

.line {
  padding: 0.5rem 0 0.5rem 0;
  width: 100%;
}

.commentAddForm {
  text-align: center;
  margin-top: 1rem;
  border-top: 1px solid var(--border-color);
  background-color: var(--form-bg-color);
  padding: 1rem;
}

.input {
  display: inline-block;
  width: 60%;
  padding: 0.4rem;
  border:1px solid var(--border-dark-color);
  border-radius: 3px;
}

textarea {
  height: 100px;
}
</style>