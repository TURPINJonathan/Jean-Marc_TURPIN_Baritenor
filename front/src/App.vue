<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
// COMPONENTS
import HeaderLayout from '@components/layout/HeaderLayout.vue'
</script>

<template>
  <HeaderLayout />
  <!-- <header>
    <div class="wrapper">
      <HelloWorld msg="You did it!" />

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header> -->

  <RouterView />
</template>
