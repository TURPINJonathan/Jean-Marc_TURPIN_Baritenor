<script setup lang="ts">
import { ref, onMounted } from 'vue'
import NavigationBar from '@components/layout/NavigationBar.vue'
import ScenePicture from '@assets/pictures/scene_resize.jpg'

const title = ref('Jean-Marc TURPIN')
const visibleTitle = ref('')
const isDefinitionShow = ref(false)

const showLetter = (index: number) => {
  visibleTitle.value += title.value.charAt(index)
}

const revealTitle = () => {
  let index = 0
  const interval = [200, 300, 250, 350, 280]

  const showNextLetter = () => {
    if (index < title.value.length) {
      showLetter(index)
      index++
      setTimeout(showNextLetter, interval[Math.floor(Math.random() * interval.length)])
    }
  }

  showNextLetter()
}

onMounted(() => {
  revealTitle()
})
</script>

<template>
  <header :style="`background-image: url(${ScenePicture})`">
    <div>
      <h1>{{ visibleTitle }}</h1>
      <p @mouseover="isDefinitionShow = true" @mouseleave="isDefinitionShow = false">Bariténor</p>
      <div>
        <small v-show="isDefinitionShow">
          Voix masculine intermédiaire entre le ténor et la basse.
        </small>
      </div>
    </div>
  </header>

  <NavigationBar />
</template>

<style scoped lang="scss">
header {
  height: 75vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-position: bottom right;
  background-repeat: no-repeat;
  background-size: cover;
  background-clip: content-box;

  div {
    h1 {
      text-align: center;
      margin-top: 100px;
    }

    p {
      text-align: center;
      letter-spacing: 0.6rem;
      font-size: 2rem;
      text-transform: uppercase;
      &:hover {
        cursor: help;
      }
    }

    div {
      text-align: center;
      font-style: italic;
      margin-top: 1rem;
      font-size: 1.2rem;
      height: 1.5rem;
    }
  }
}
</style>

<script lang="ts">
export default {
  name: 'HeaderLayout'
}
</script>