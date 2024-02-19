<script setup lang="ts">
import { useApi } from '@composables/callRoutes';
import type { ArticleType } from '@types/articleType';
import { onMounted, ref } from 'vue';
import ArticleSearch from '@components/blog/ArticleSearch.vue'
import ArticlesList from '@components/blog/ArticlesList.vue'
import Loader from '@components/common/Loader.vue'

const articleList = ref<ArticleType[]>([])
const isLoading = ref<boolean>(false)

const { get } = useApi()

onMounted(async () => {
  const data = await get('article/last_five')
  if (data && Array.isArray(data)) {
    articleList.value = data as ArticleType[];
  } else {
    console.error("The articles data is not in the expected format:", data);
  }
})

let searchTimeout: number;

const handleNewSearch = (searchParams: string[]) => {
  clearTimeout(searchTimeout);
  isLoading.value = true
  searchTimeout = setTimeout(async () => {
    const data = await get('article/search', searchParams);
    if (data && Array.isArray(data)) {
      articleList.value = data as ArticleType[];
    } else {
      console.error("The articles data is not in the expected format:", data);
    }
    isLoading.value = false
  }, 1000);
}
</script>

<template>
  <main id="blog">
    <ArticleSearch @search-updated="handleNewSearch" />
    
    <template v-if="isLoading">
      <div id="blog_article" class="loaders">
        <Loader />
      </div>
    </template>

    <template v-else>
      <ArticlesList :articlesList="articleList" />
    </template>
  </main>
</template>

<style scoped lang="scss">
main {
  display: flex;
  flex-wrap: wrap;
  padding: 20px 3rem 0 3rem;

  #blog_search {
    flex: 20 1 250px;
    padding: 15px;

    form {
      display: flex;
      flex-direction: column;

      label {
        display: flex;
        flex-direction: column;

        input, select {
          margin-top: 5px;
          margin-bottom: 10px;
        }
      }



      button {
        margin: 20px 0;
      }
    }
  }

  .loaders {
    flex: 80 1 450px !important;
  }


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
}
</style>
