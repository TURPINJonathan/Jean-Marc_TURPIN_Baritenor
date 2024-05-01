<script setup lang="ts">
import type { ArticleType } from '@types/articleType';
import { ref } from 'vue';
import { useApi } from '@composables/callRoutes';
import { useRoute } from "vue-router";
import Loader from '@components/common/Loader.vue';
import HomeButton from '@components/common/HomeButton.vue';
import VideoPlayer from '@components/common/VideoPlayer.vue';
import { useDateUtils } from '@utils/dateUtils';
import MapVue from "@components/Map.vue";

const { get, getBackURL } = useApi();
const route = useRoute();
const { formatDate, formatTime } = useDateUtils();
const isLoading = ref<boolean>(false)

const article = ref<ArticleType | null>(null)


const loadArticle = async () => {
  const id = route.params.id;
  try {
    isLoading.value = true
    const data = await get(`article/${id}`);
    if (data) {
      article.value = data;
    }
  } catch (error) {
    console.error("Data loading error :", error);
  } finally {
    isLoading.value = false
  }
};

loadArticle();
</script>

<template>
  <main>
    <section id="article">
      <template v-if="isLoading">
        <Loader />
      </template>

      <template v-else-if="article">
        <article>
          <div class="article-title">
            <h2>
              {{ article.title }}
            </h2>
            <span>
              <template v-for="category in article.category" :key="category.id">
                <small>{{ category.label }}</small>
              </template>
            </span>
          </div>

          <div class="article-container">
            <div class="article-picture">
              <img :src="`${getBackURL()}/articles/${article.file}`" :alt="article.picture_description" />
            </div>
            <div class="article-content" v-html="article.content" />
          
            <template v-if="article.videoURL">
              <VideoPlayer :video-url="article.videoURL" />
            </template>

            <template v-if="article.event?.length">
              <template v-for="event in article.event" :key="event.id">
                <div class="article-event">
                  <h3>
                    {{ event.name }}
                    <template v-if="formatDate(event.startAt) === formatDate(event.endAt)">
                      <small>Le {{ formatDate(event.startAt) }} de {{ formatTime(event.startAt) }} à {{ formatTime(event.endAt) }}</small>
                    </template>

                    <template v-else>
                      <small>Du {{ formatDate(event.startAt) }} à {{ formatTime(event.startAt) }} au {{ formatDate(event.endAt) }} à {{ formatTime(event.endAt) }}</small>
                    </template>

                    <small v-if="event.eventPlace?.name || event.eventPlace?.city">{{ event.eventPlace.name }}, {{ event.eventPlace?.city }}</small>
                  </h3>
                  
                  <div class="event-container">
                    <div class="event-description">
                      <div v-html="event.details"/>
                    </div>

                    <div class="event-map">
                      <MapVue :eventsData="[event]" :centerCoordinates="[event.eventPlace?.longitude, event.eventPlace?.latitude]" />
                    </div>
                  </div>
                </div>
              </template>
            </template>
          </div>
        </article>

        <HomeButton />
      </template>

      <template v-else>
        <article>
          Une erreur est survenue
        </article>
      </template>
    </section>
  </main>
</template>

<style scoped lang="scss">
main {
  display: flex;
  padding: 20px 3rem 3rem 3rem;

  #article {
    width: 100%;

    article {
      display: flex;
      flex-direction: column;
      gap: 20px;

      .article-title {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 0 20px;

        h2 {
          text-align: center;
          text-transform: uppercase;
          justify-self: center;
        }

        span {
          display: flex;
          gap: 10px;

          small {
            padding: 0.1rem 0.8rem;
            border: 1px solid rgb(241, 241, 241);
            border-radius: 50px;
          }
        }
      }

      .article-container {
        .article-picture {
          float: left;
          max-width: 40svw;
          padding: 0 20px 20px 0;

          img {
            width: 100%;
          }
        }

        .article-event {
          display: flex;
          flex-direction: column;
          gap: 10px;
          padding: 20px;
          margin-top: 20px;
          border: 1px solid rgb(241, 241, 241);

          h3 {
            text-transform: uppercase;
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
            align-items: center;

            small {
              text-transform: none;
              font-weight: normal !important;
              font-size: 0.9rem;
              font-style: italic;
            }
          }
        
          .event-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding-top: 1rem;

            .event-description {
              flex: 60 1 300px;
            }

            .event-map {
              flex: 40 1 250px;
            }
          }

        }
      }
    }
  }
}

@media (max-width: 1000px) {
  main #article article .article-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
    .article-picture {
      float: none;
      max-width: 100%;
      padding: 0;
    }
  }
}
</style>
