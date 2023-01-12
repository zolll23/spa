<template>
<header class="header">
<div class="flex">
  <div class="logo"><img alt="Vue logo" src="./assets/logo.svg"></div>
  <div class="title">Company title</div>
</div>
</header>
<main class="main container py-1">

  <Post>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
    aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
    sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
  </Post>

</main>
<footer class="footer">
<div class="p-1">
  &copy; 2023 All rights reserved
</div>
</footer>
</template>

<script>
import Post from './components/Post.vue'

export default {
  name: 'App',
  components: {
    Post
  }
}
</script>

<style>
</style>
