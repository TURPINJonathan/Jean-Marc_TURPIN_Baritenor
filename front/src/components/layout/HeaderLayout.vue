<script lang="ts" setup>
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
  <header>
    <div id="header-title" :style="`background-image: url(${ScenePicture})`">
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

    <div id="header-footer">
      <svg width="100%" height="10%" viewBox="0 0 4242 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>Rectangle</title>
        <defs>
            <path d="M4242,0 C4189.73301,50 4109.41271,80 4001.03908,85 C1922.67878,151.673205 807.28757,183.017744 610.271751,170 C406.832971,156.982256 203.409054,100 0,0 L4242,0 Z" id="path-1"></path>
        </defs>
        <g id="Page-2" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <mask id="mask-2" fill="white">
                <use xlink:href="#path-1"></use>
            </mask>
            <use id="Rectangle" fill="#FDFDFB" xlink:href="#path-1"></use>
            <use id="Rectangle" fill="#FDFDFB" xlink:href="#path-1"></use>
        </g>
      </svg>
    </div>
  </header>
</template>

<style lang="scss" scoped>
@import '@assets/variables.scss';
  header {
    height: 70svh;
    width: 100svw;

    #header-title {
      background-repeat: no-repeat;
      background-size: cover;
      background-position: top right;
      // background-clip: content-box;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 80%;
      box-shadow: 0px -10px 10px 0px rgba(253,254,252,0.89) inset;
      -webkit-box-shadow: 0px -10px 10px 0px rgba(253,254,252,0.89) inset;
      -moz-box-shadow: 0px -10px 10px 0px rgba(253,254,252,0.89) inset;

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

    #header-footer {
      background-color: $bg-dark;
      height: auto;
      width: 100svw;
    }
  }

</style>
