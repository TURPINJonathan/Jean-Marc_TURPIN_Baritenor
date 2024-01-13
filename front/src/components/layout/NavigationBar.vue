<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <nav>
    <RouterLink to="/biographie" activeClass="active-page">Bio</RouterLink>
    <RouterLink to="/metro" activeClass="active-page">Métro</RouterLink>
    <RouterLink to="/media" activeClass="active-page">Média</RouterLink>
    <RouterLink to="/projets" activeClass="active-page">Projets</RouterLink>
    <RouterLink to="/liens" activeClass="active-page">Liens</RouterLink>
    <RouterLink to="/blog" activeClass="active-page">Blog</RouterLink>
    <RouterLink to="/boutique" activeClass="active-page">Boutique</RouterLink>
    <RouterLink to="/contact" activeClass="active-page">Contact</RouterLink>
  </nav>
</template>

<style scoped lang="scss">
nav {
  display: flex;
  justify-content: space-evenly;

  & > * {
    min-width: calc(100% / 9);
    min-height: 50px;
    color: inherit;
    text-decoration: none;
    border: 1px solid blue; /* TO DELETE WITH PICTURES */
    border-radius: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .active-page {
    background-color: blue; /* TO DELETE WITH PICTURES */
    color: white;
    font-weight: bold;
    box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.75);
    -webkit-box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.75);
    -moz-box-shadow: 0px 0px 7px 0px rgba(0, 0, 0, 0.75);
  }
}
</style>

<script lang="ts">
export default {
  name: 'NavigationBar'
}
</script>
