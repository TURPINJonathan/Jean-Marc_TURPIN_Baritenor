<script setup lang="ts">
import { RouterLink } from "vue-router";
import { ref } from "vue";

import { useNavStore } from "@stores/useNavStore";

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
@import '@assets/variables.scss';
nav {
  display: flex;
  justify-content: space-evenly;
  gap: 15px;
  margin-top: -3rem;
  background-color: $bg-dark;

  & > * {
    min-width: calc(100% / 9);
    min-height: 70px;
    color: inherit;
    text-decoration: none;
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
      text-transform: uppercase;
      border-radius: 4px;

      &:hover {
        background-color: $bg-dark-opacity;
        color: $ft-light;
      }
    }
  }

  .active-page {
    span {
      color: $ft-light;
      font-weight: bold;
      background-color: $bg-dark_opacity;
    }
  }
}
</style>
