<!-- App.vue -->
<template>
  <div id="app">
    <SignIn />
  </div>
</template>

<script>
import SignIn from './components/SignIn.vue';

export default {
  name: 'App',
  components: {
    SignIn
  }
};
</script>

<style>
/* Global CSS styling for the entire app */
</style>
