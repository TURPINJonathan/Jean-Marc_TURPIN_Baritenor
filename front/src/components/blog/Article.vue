<script setup lang="ts">
import type { ArticleType } from '@types/articleType';
import { onMounted, ref, nextTick } from 'vue';
import { useApi } from '@composables/callRoutes';
import { useRoute } from "vue-router";
import Loader from '@components/common/Loader.vue';

const { get } = useApi();
const route = useRoute();
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

          <div class="article-content" v-html="article.content" />
        </article>
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

    .article-title {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;

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
    
  }

}
</style>
