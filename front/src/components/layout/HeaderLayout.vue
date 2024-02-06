<script setup lang="ts">
import { ref, onMounted, watch } from "vue";
import NavigationBar from "@components/layout/NavigationBar.vue";
import ScenePicture from "@assets/pictures/scene_resize.jpg";
import { useRoute } from "vue-router";

const route = useRoute();
const title = ref(route.name);
const visibleTitle = ref<string>("");
const isDefinitionShow = ref<boolean>(false);
const revealTitleTimeoutId = ref<number | null>(null);

const showLetter = (index: number): void => {
  if (typeof route.name === "string" && title.value === route.name) {
    visibleTitle.value += title.value.charAt(index as number);
  }
};

const revealTitle = (): void => {
  visibleTitle.value = "" as string;
  let index = 0 as number;
  const interval = [200, 300, 250, 350, 280] as number[];

  const showNextLetter = () => {
    if (
      (title.value as string) &&
      (index as number) < (title.value as string).length
    ) {
      showLetter(index as number);
      index++ as number;
      revealTitleTimeoutId.value = setTimeout(
        showNextLetter,
        interval[Math.floor(Math.random() * interval.length)]
      );
    }
  };

  showNextLetter();
};

onMounted(() => {
  revealTitle();

  // Watch for changes in route.name
  watch(
    () => route.name,
    (newName) => {
      // Reset and restart revealTitle when route.name changes
      title.value = newName;
      // Clear the existing timeout
      if (revealTitleTimeoutId.value !== null) {
        clearTimeout(revealTitleTimeoutId.value);
      }
      revealTitle();
    }
  );
});
</script>

<template>
  <header :style="`background-image: url(${ScenePicture})`">
    <div>
      <h1>{{ visibleTitle }}</h1>
      <template v-if="route.path === '/'">
        <p
          @mouseover="isDefinitionShow = true"
          @mouseleave="isDefinitionShow = false"
        >
          Bariténor
        </p>
        <div>
          <small v-show="isDefinitionShow">
            Voix masculine intermédiaire entre le ténor et la basse.
          </small>
        </div>
      </template>
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
