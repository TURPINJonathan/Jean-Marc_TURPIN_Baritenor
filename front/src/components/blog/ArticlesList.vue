<script setup lang="ts">
import { useDateUtils } from "@utils/dateUtils";

const { formatDate } = useDateUtils()

const props = defineProps(['articlesList'])
</script>

<template>
  <section id="blog_article">
    <article v-for="article in props.articlesList" :key="article.id">
      <div class="article_title">
        <h3>{{ article.title }}</h3>
        <small>{{ formatDate(article.createdAt) }}</small>
      </div>

      
      <div class="article_content">
        <img src="https://placehold.co/600x400" alt="" srcset="" />
        <div class="article_content-text" v-html="article.content" />
      </div>
    </article>
  </section>
</template>

<style scoped lang="scss">
  #blog_article {
    flex: 80 1 450px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;

    article {
      border: 1px solid rgb(241, 241, 241);
      flex: 20 1 300px;
      padding: 0.5rem;
      padding-top: 0;

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

        img {
          flex: 50 1 200px;
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