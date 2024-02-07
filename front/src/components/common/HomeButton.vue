<script setup lang="ts">
import { useScrollTo } from "@utils/scrollToUtils";
import { RouterLink } from "vue-router";

const { scrollToTopPage } = useScrollTo();
</script>

<template>
  <section>
    <RouterLink to="/" @click="scrollToTopPage">Accueil</RouterLink>
  </section>
</template>

<style scoped lang="scss">
section {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-bottom: 2rem;
  padding-top: 2rem;

  & > * {
    width: 250px;
    height: 50px;
    color: rgb(241, 241, 241);
    border: 1px solid rgb(241, 241, 241);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    text-transform: uppercase;
  }
}
</style>
