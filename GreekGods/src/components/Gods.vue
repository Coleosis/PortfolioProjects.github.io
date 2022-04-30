<template>
  <div class="container-fluid">
    <div>
      <router-view></router-view>

      <div class="row justify-content-center">
        <div class="col-3">
          <router-link to="/zeus"><h1>Zeus</h1></router-link><br />
          <router-link to="/hades"><h1>Hades</h1></router-link><br />
          <router-link to="/poseidon"><h1>Poseidon</h1></router-link><br />
          <router-link to="/ares"><h1>Ares</h1></router-link><br />
          <router-link to="/demeter"><h1>Demeter</h1></router-link><br />
          <router-link to="/artimis"><h1>Artimis</h1></router-link><br />
          <router-link to="/aphrodite"><h1>Aphrodite</h1></router-link><br />
          <router-link to="/apollo"><h1>Apollo</h1></router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Gods",
};
</script>

<style scoped>
.completed {
  color: gray;
  text-decoration: line-through;
}

ul {
  margin-top: 2em;
  margin-left: 1em;
}

li {
  list-style: square;
}
</style>