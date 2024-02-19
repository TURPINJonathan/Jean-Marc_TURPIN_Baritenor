<template>
  <div class="loader" />
</template>

<script setup lang="ts"></script>

<style scoped lang="scss">
.loader {
  // position
  margin: auto;

  // size
  width: 100%;

  max-width: 5em;

  // aspect
  aspect-ratio: 1;

  // visual
  border-radius: 50%;
  box-shadow: 0.2em 0.2em rgba(165, 165, 165, 0.5);

  // animation
  animation: rot 2s infinite linear;
}

@keyframes rot {
  to {
    // transform
    transform: rotate(360deg);
  }
}

</style>