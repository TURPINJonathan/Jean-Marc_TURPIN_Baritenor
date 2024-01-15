<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
import { ref } from 'vue'

import MetropolitainButton from '@assets/pictures/navigationButtons/metropolitain_resize.jpg'
import ContactButton from '@assets/pictures/navigationButtons/contact_resize.jpg'
import IncommingButton from '@assets/pictures/navigationButtons/coming-soon_resize.jpg'

const activeButton = ref('')
</script>

<template>
  <nav>
    <RouterLink to="/biographie" activeClass="active-page">Bio</RouterLink>
    <RouterLink
      to="/metro"
      activeClass="active-page"
      :style="`background-image: url(${MetropolitainButton})`"
      @mouseover="activeButton = 'metro'"
      @mouseleave="activeButton = ''"
    >
      <span v-if="activeButton === 'metro' || $route.path === '/metro'">Métropolitain</span>
    </RouterLink>
    <RouterLink to="/media" activeClass="active-page">Média</RouterLink>
    <RouterLink
      to="/projets"
      activeClass="active-page"
      :style="`background-image: url(${IncommingButton})`"
      @mouseover="activeButton = 'coming-soon'"
      @mouseleave="activeButton = ''"
    >
      <span v-if="activeButton === 'coming-soon' || $route.path === '/projets'">à venir</span>
    </RouterLink>
    <RouterLink to="/liens" activeClass="active-page">Liens</RouterLink>
    <RouterLink to="/blog" activeClass="active-page">Blog</RouterLink>
    <RouterLink to="/boutique" activeClass="active-page">Boutique</RouterLink>
    <RouterLink
      to="/contact"
      activeClass="active-page"
      :style="`background-image: url(${ContactButton})`"
      @mouseover="activeButton = 'contact'"
      @mouseleave="activeButton = ''"
    >
      <span v-if="activeButton === 'contact' || $route.path === '/contact'">Contact</span>
    </RouterLink>
  </nav>
</template>

<style scoped lang="scss">
nav {
  display: flex;
  justify-content: space-evenly;
  padding-top: 15px;
  background-color: rgb(17, 17, 17);
  color: rgb(241, 241, 241);
  box-shadow: -1px -7px 26px 25px rgba(17, 17, 17, 1);
  -webkit-box-shadow: -1px -7px 26px 25px rgba(17, 17, 17, 1);
  -moz-box-shadow: -1px -7px 26px 25px rgba(17, 17, 17, 1);

  & > * {
    min-width: calc(100% / 9);
    min-height: 70px;
    color: inherit;
    text-decoration: none;
    border: 1px solid rgb(241, 241, 241); /* TO DELETE WITH PICTURES */
    border-radius: 4px;
    display: flex;
    justify-content: center;
    align-items: center;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;

    span {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: rgba(17, 17, 17, 0.9);
      text-transform: uppercase;
      border-radius: 4px;
    }
  }

  .active-page {
    color: rgb(241, 241, 241);
  }
}
</style>

<script lang="ts">
export default {
  name: 'NavigationBar'
}
</script>
