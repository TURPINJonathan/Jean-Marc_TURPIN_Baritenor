<script setup lang="ts">
import { ref } from 'vue'
import type MessageType from '@types/messageType'
import JMPupitre from '@assets/pictures/jm_pupitre.jpg'
import HomeButton from '@components/common/HomeButton.vue'

const message = ref<MessageType>({
  contactTitle: '',
  contactLastname: '',
  contactFirstname: '',
  contactEmail: '',
  contactSubject: '',
  messageContent: ''
})
const isMessageReadyToSend = ref<boolean>(false)

const submitMessage = (event) => {
  event.preventDefault()
  // try {
  //   // Effectuer une requête fictive vers un backend (remplacez l'URL par la vôtre)
  //   const response = await axios.post('https://votre-backend.com/api/form', message.value);

  //   // Traiter la réponse (exemple : afficher un message de confirmation)
  //   console.log('Réponse du serveur:', response.data);
  // } catch (error) {
  //   console.error('Erreur lors de l\'envoi du formulaire:', error);
  // }
  console.log(message)
}
</script>

<template>
  <main>
    <section>
      <article>
        <form name="contactForm" id="contact_form" @submit.prevent="submitMessage">
          <h2>Contactez-nous</h2>

          <div id="form_client-information">
            <label for="contactTitle">
              Civilité*
              <select
                v-model="message.contactTitle"
                name="contactTitle"
                required
                autofocus
                autocomplete="on"
              >
                <option value="Monsieur">Monsieur</option>
                <option value="Madame">Madame</option>
                <option value="Mademoiselle">Mademoiselle</option>
              </select>
            </label>

            <label for="contactLastname">
              Nom*
              <input
                v-model="message.contactLastname"
                type="text"
                name="contactLastname"
                required
                placeholder="DUPONT"
                autocomplete="on"
                autocapitalize="characters"
              />
            </label>

            <label for="contactFirstname">
              Prénom*
              <input
                v-model="message.contactFirstname"
                type="text"
                name="contactFirstname"
                required
                placeholder="Jean"
                autocomplete="on"
                autocapitalize="words"
              />
            </label>
          </div>

          <label class="contact_full-element" for="contactEmail">
            Email*
            <input
              v-model="message.contactEmail"
              type="email"
              name="contactEmail"
              required
              placeholder="dupont@gmail.com"
              autocomplete="on"
            />
          </label>

          <label class="contact_full-element" for="contactSubject">
            Sujet*
            <input
              v-model="message.contactSubject"
              type="text"
              name="contactSubject"
              required
              placeholder="Demande de prestation"
              autocapitalize="sentences"
            />
          </label>

          <label class="contact_full-element" for="messageContent">
            Votre message*
            <textarea
              v-model="message.messageContent"
              name="messageContent"
              required
              cols="30"
              rows="10"
              placeholder="Votre message ici ..."
              minlength="10"
              wrap="soft"
              autocapitalize="sentences"
              autocomplete="on"
            />
          </label>

          <button class="contact_full-element" type="submit">
            <span>ENVOYER</span>
          </button>
        </form>

        <div id="contact_picture">
          <img
            :src="JMPupitre"
            alt="Aquarelle représentant Jean-Marc TURPIN au pupitre en train de chanter"
          />
        </div>
      </article>
    </section>

    <HomeButton />
  </main>
</template>

<style lang="scss">
main section article {
  display: flex;
  // justify-content: space-between;
  flex-wrap: wrap;
  padding: 20px 3rem 20px 3rem;
  gap: 20px;

  #contact_form {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
    flex: 75;
    margin: auto;

    h2 {
      width: 100%;
      border-bottom: 1px solid rgb(241, 241, 241);
    }

    .contact_full-element {
      display: flex;
      flex-direction: column;
      width: 100%;
      gap: 4px;
    }

    input,
    select {
      height: 30px;
    }

    button span {
      width: 100%;
      text-align: center;
    }

    #form_client-information {
      width: 100%;
      display: flex;
      gap: 16px;
      flex-wrap: wrap;

      label {
        display: flex;
        flex-direction: column;
        flex: 33;
        flex-basis: 174px;
        gap: 4px;
      }
    }
  }

  #contact_picture {
    flex: 25;
    border: 1px solid white;
    padding: 0.5rem;
    flex-basis: 310px;

    img {
      min-height: 420px;
    }
  }
}
</style>
