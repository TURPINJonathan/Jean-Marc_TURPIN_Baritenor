<script setup lang="ts">
import { RouterLink } from "vue-router";
import { ref } from "vue";

import { useNavStore } from "@/stores/useNavStore";

const navigationStore = useNavStore();
const activeButton = ref<string>("");
</script>

<template>
  <nav>
    <RouterLink
      v-for="(module, index) in navigationStore.modules"
      :key="index"
      :to="module.path"
      activeClass="active-page"
      :style="`background-image: url(${module.pictureURL})`"
      @mouseover="activeButton = module.label"
      @mouseleave="activeButton = ''"
    >
      <span v-if="activeButton === module.label || $route.path === module.path">
        {{ module.label }}
      </span>
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
