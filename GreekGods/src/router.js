import Vue from "vue";
import VueRouter from "vue-router";
import Navigation from "./components/Navigation.vue";
import Greece from "./components/Greece.vue";
import Gods from "./components/Gods.vue";
import ZeusCard from "./components/Zeus.vue";
import PoseidonCard from "./components/Poseidon.vue";
import HadesCard from "./components/Hades.vue";
import DemeterCard from "./components/Demeter.vue";
import ArtimisCard from "./components/Artimis.vue";
import AresCard from "./components/Ares.vue";
import ApolloCard from "./components/Apollo.vue";
import AphroditeCard from "./components/Aphrodite.vue";

Vue.use(VueRouter);

const routes = [
  { path: "/navigation", component: Navigation },
  { path: "/greece", component: Greece },
  { path: "/gods", component: Gods },
  { path: "/zeus", component: ZeusCard },
  { path: "/poseidon", component: PoseidonCard },
  { path: "/hades", component: HadesCard },
  { path: "/demeter", component: DemeterCard },
  { path: "/artimis", component: ArtimisCard },
  { path: "/ares", component: AresCard },
  { path: "/apollo", component: ApolloCard },
  { path: "/aphrodite", component: AphroditeCard }
];

export default new VueRouter({
  mode: "history",
  routes
});
