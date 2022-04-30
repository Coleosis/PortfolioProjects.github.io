<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
      <div class="container-fluid">
        <h3 class="">Guide</h3>

        <div class="" id="navbarColor02">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/Greece">Greece </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/Gods">Gods </router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "Navigation",
};
</script>

<style scoped>
ul {
  margin: 0;
  padding: 0;
}
li {
  display: inline-block;
  padding: 1em 0.5em;
}
</style>