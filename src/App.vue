<!-- App.vue -->
<template>
  <div id="app">
    <ListItem />
  </div>
</template>

<script>
import ListItem from './components/ListItem.vue';

export default {
  name: 'App',
  components: {
    ListItem
  }
};
</script>

<style>
/* Global CSS styling for the entire app */
</style>
