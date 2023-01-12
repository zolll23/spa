<template>
  <li class="comment">
    <small>{{ info.created_at}}</small><br><b>{{ info.title }}</b><br>{{ info.content }}
    <a class="authorCommentInfo" :href="'mailto:'+info.email">{{ info.user_name}}</a>
  </li>
</template>

<script>
export default {
  name: "Comment",
  props: {
    info: Object
  },
}
</script>

<style scoped>
.comment {
  padding: 0.5rem 0 0.5rem 0;
  border-top: 1px solid var(--border-color)
}

.authorCommentInfo {
  display: block;
  padding-top: 0.5rem;
  font-size: 0.8rem;
  color: var(--link-color);
}
</style>