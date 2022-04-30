<template>
  <div id="app">
    <navigation />
    <router-view></router-view>
  </div>
</template>

<script>
import Navigation from "./components/Navigation.vue";
export default {
  name: "App",
  data() {
    return {};
  },
  components: {
    Navigation,
  },
};
</script>

<style>
</style>
