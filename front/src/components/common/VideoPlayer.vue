<script setup lang="ts">
import VueYoutube from 'vue3-youtube';

const props = defineProps(['videoUrl'])
</script>

<template>
  <div class="player">
    <VueYoutube :src="props.videoUrl" />
  </div>
</template>

<style scoped lang="scss">
.player {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}
</style>