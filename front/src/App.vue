<script setup lang="ts">
import { RouterView } from 'vue-router'
// COMPONENTS
import HeaderLayout from '@components/layout/HeaderLayout.vue'
import FooterLayout from '@components/layout/FooterLayout.vue'
</script>

<template>
  <HeaderLayout />
  <RouterView />
  <FooterLayout />
</template>

<style lang="scss">
h3 {
  font-size: 1.5rem;
  font-weight: bold;
}
</style>