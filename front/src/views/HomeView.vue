<script setup lang="ts">
import JMProfilPicture from "@assets/pictures/jm_profil.jpg";
import { useApi } from "@composables/callRoutes";
import type { ArticleType } from "@types/articleType";
import { onMounted, ref } from "vue";

const { get, getBackURL } = useApi();
const lastArticle = ref<ArticleType | null>(null);

onMounted(async () => {
  const data = await get('article/last_one');
  if (data) {
    console.log(data);
    lastArticle.value = data as ArticleType | unknown;
    console.log(lastArticle);
  }
})
</script>

<template>
  <main>
    <section>
      <article id="jm-message">
        <div id="jm-message_content">
          <h2>Bienvenue sur mon site !</h2>

          <p>C’est avec un immense plaisir que je vous accueille ici.</p>
          <p>
            Le chant et la musique plus généralement est un moyen de partager
            des moments mais aussi de raviver des sentiments, de suspendre le
            temps, de se redécouvrir ou se découvrir, d’aimer, de vibrer…
          </p>
          <p>
            Entrez et promenez-vous dans cet espace virtuel et c’est certain,
            nous allons nous rencontrer …
          </p>
          <p>Jean Marc Turpin</p>
        </div>
        <div
          id="jm-message_picture"
          :style="`background-image: url(${JMProfilPicture})`"
        ></div>
      </article>
    </section>

    <section v-if="lastArticle">
      <article id="last-article">
        <h2>Dernier article</h2>
        <h3>{{ lastArticle.title }}</h3>
        <div class="last-article__categories">
          <template v-for="category in lastArticle.category" :key="category.id">
            <small>{{ category.label }}</small>
          </template>
        </div>
        
        <div class="lastArticle-container">
          <div class="lastArticle-picture">
            <img :src="`${getBackURL()}/articles/${lastArticle.file}`" :alt="lastArticle.picture_description" />
          </div>
          <div class="lastArticle_content-text" v-html="lastArticle.content" />
        </div>
      </article>
    </section>
  </main>
</template>

<style scoped lang="scss">
main section {
  #jm-message {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    width: 100%;
    padding-top: 20px;

    #jm-message_content {
      flex: 75;
      flex-basis: 600px;
      padding-left: 5rem;
      padding-right: 3rem;
      font-size: 20px;

      & > * {
        font-family: "Vujahday Script", cursive !important;
      }

      h2 {
        font-size: 40px;
        font-weight: lighter;
      }

      p {
        padding-left: 2rem;
      }

      p:last-child {
        text-align: end;
        font-size: 40px;
      }
    }

    #jm-message_picture {
      border-radius: 50% 0 0 50%;
      min-height: 400px;
      flex: 25;
      flex-basis: 200px;
      display: flex;
      justify-content: flex-end;
      background-position: top right;
      background-repeat: no-repeat;
      background-size: cover;
      box-shadow: -4px 4px 33px -3px rgba(0, 0, 0, 0.75);
      -webkit-box-shadow: -4px 4px 33px -3px rgba(0, 0, 0, 0.75);
      -moz-box-shadow: -4px 4px 33px -3px rgba(0, 0, 0, 0.75);
    }
  }

  #last-article {
    margin-top: 20px;
    padding-bottom: 3rem;
    padding-left: 5rem;

    .last-article__categories {
      display: flex;
      gap: 10px;
      margin: 0.5rem auto;

      small {
        padding: 0.1rem 0.8rem;
        border: 1px solid rgb(241, 241, 241);
        border-radius: 50px;
      }
    }

    .lastArticle-container {
      min-height: 300px;

      .lastArticle-picture {
        float: left;
        max-width: 40svw;
        height: 300px;
        display: flex;
        justify-content: center;
        align-items: flex-start;

        img {
          height: auto;
          max-height: 300px;
          width: 100%;
        }
      }

      .lastArticle_content-text {
          padding: 0 20px;
          overflow: hidden;
          display: -webkit-box;
          -webkit-line-clamp: 5;
          -webkit-box-orient: vertical;
          text-overflow: ellipsis;
      }
    }
  }
}

@media (max-width: 1150px) {
  main section #jm-message #jm-message_picture {
    border-radius: 0;
  }
}

@media (max-width: 800px) {
  main section #last-article {
    padding: 0 2rem;
  
    .lastArticle-container {
      display: flex;
      flex-direction: column;
      gap: 10px;

      .lastArticle-picture {
        float: none;
        height: auto;
      }

      .lastArticle_content-text {
        padding: 0;
      }
    }
  }
}
</style>
