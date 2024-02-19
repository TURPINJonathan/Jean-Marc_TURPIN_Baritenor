<script setup lang="ts">
import { onMounted, ref, defineEmits } from 'vue';
import { useApi } from '@composables/callRoutes';
import type { CategoryType } from '@types/articleType';
import type { ArticleSearchType } from '@types/searchType';

const { get } = useApi();

const categories = ref<CategoryType[]>([]);
const globalSearch = ref('')
const categorySearch = ref('')
const search = ref<ArticleSearchType>({
  content: "",
  category_label: "",
  title: "",
  event_name: "",
});

const emit = defineEmits<{
  (e: "search-updated", search: ArticleSearchType): void;
}>();

onMounted(async () => {
  const data = await get('article_category/list');
  if (data && Array.isArray(data)) {
    categories.value = data as CategoryType[];
  } else {
    console.error("The category data is not in the expected format:", data);
  }
});

const searchFields: string[] = ['content', 'title', 'category_label', 'event_name'];

function updateSearch() {
  searchFields.forEach((field: string) => {
    search.value[field] = field === 'category_label' ? categorySearch.value : globalSearch.value;
  });
  emit('search-updated', search.value);
}
</script>

<template>
  <section id="blog_search">
    <form action="GET">
      <label for="blog_content">
        Rechercher
        <input
          v-model="globalSearch"
          @input="updateSearch"
          type="text"
          name="blog_search"
          autofocus
          autocomplete="on"
        />
      </label>

      <label for="blog_category">
        Catégorie
        <select
          v-model="categorySearch"
          @change="updateSearch()"
          name="blog_category"
          autofocus
          autocomplete="on"
        >
          <template v-for="category in categories" :key="category.id">
            <option :value="category.label" style="text-transform: capitalize;">{{ category.label }}</option>
          </template>
        </select>
      </label>
    </form>
  </section>
</template>

<style scoped lang="scss">
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
  }
}
</style>
