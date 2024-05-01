<script setup lang="ts">
import { useDateUtils } from "@utils/dateUtils";
import { useApi } from '@composables/callRoutes';
import { useRouter } from 'vue-router';
import { useNavStore } from "@stores/useNavStore";

const { formatDate } = useDateUtils()

const props = defineProps(['articlesList'])
const { get, getBackURL } = useApi();
const navStore = useNavStore();

const handleClickOnArticle = async (slug: string) => {
  const data = await get(`article/${slug}`);
  if (data && data.title) {
    navStore.setTitle(data.title)
  }
  
};
</script>

<template>
  <section id="blog_article">
    <router-link v-for="(article, index) in props.articlesList" :key="article.id" :to="'/blog/' + article.slug" @click="handleClickOnArticle(article.slug)">
      <article>
        <div class="article_title">
          <h3>{{ article.title }}</h3>
          <small>{{ formatDate(article.createdAt) }}</small>
        </div>
        
        <div class="article_content">
          <div class="article_content-picture">
            <img :src="`${getBackURL()}/articles/${article.file}`" :alt="article.picture_description" />
          </div>
          <div :style="{ order: index % 2 === 0 ? -1 : 'auto' }" class="article_content-text" v-html="article.content" />
        </div>
      </article>
    </router-link>
  </section>
</template>

<style scoped lang="scss">
  a {
    text-decoration: none;
    color: inherit;
  }
  #blog_article {
    flex: 80 1 450px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;

    article {
      border: 1px solid rgb(241, 241, 241);
      flex: 20 1 300px;
      padding: 0 0.5rem 1rem;

      &:hover {
        cursor: pointer;
        background-color: rgba(241, 241, 241, 0.056);
      }

      .article_title {
        margin: 1rem 0.5rem;
        text-align: center;

        small {
          text-transform: capitalize;
        }
      }

      .article_content {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;

        .article_content-picture {
          flex: 50 1 200px;
          display: flex;
          justify-content: center;
          align-items: center;

          img {
            height: auto;
            width:  auto;
            max-height: 200px;
          }
        }

        .article_content-text {
          flex: 50 1 200px;
          overflow: hidden;
          display: -webkit-box;
          -webkit-line-clamp: 5;
          -webkit-box-orient: vertical;
          text-overflow: ellipsis;
        }
      }
    }
  }
</style>
