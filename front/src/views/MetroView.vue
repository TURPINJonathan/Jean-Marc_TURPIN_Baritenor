<script setup lang="ts">
import { ref } from "vue";
import type { EventType } from "@/types/eventType";
import { useDateUtils } from "@/utils/dateUtils";
import HomeButton from "@components/common/HomeButton.vue";
import Calendar from "@components/Calendar.vue";
import MapVue from "@components/Map.vue";

const { isSameDay } = useDateUtils();

let eventsData: EventType[] = [
  {
    label: "Gare Saint lazare",
    details: "A côté de l'épicerie",
    geoCoordinates: [48.8566, 2.3522],
    type: "metro",
    date: new Date(2024, 0, 31),
    startAt: "15:00",
    endAt: "18:00",
  },
  {
    label: "Fête de la musique",
    details: "Salle des fêtes de Wavrin",
    geoCoordinates: [50.5677047, 2.9407297],
    type: "concert",
    date: new Date(2024, 1, 24),
    startAt: "10:30",
    endAt: "13:00",
  },
  {
    label: "Trocadéro",
    details:
      "Retrouvez moi à l'intersection entre l'épicerie et les distributeurs de tickets !",
    geoCoordinates: [48.865, 2.355],
    type: "metro",
    date: new Date(2024, 1, 11),
    startAt: "13:00",
    endAt: "15:00",
  },
];

let mapCenterCoordinates = ref([48.8566, 2.3522]);

const updateMapPosition = (selectedDate: Date) => {
  const currentEvent = eventsData.find((event) =>
    isSameDay(selectedDate, event.date)
  );

  if (currentEvent) {
    mapCenterCoordinates.value = currentEvent.geoCoordinates;
  }
};
</script>

<template>
  <main>
    <section id="metro_introduction">
      <article>
        <p>
          Dans les années 80, l’immense chanteur lyrique José Van Dam disait
          lors d’une interview sur une célèbre radio : « on n’est pas chanteur
          international parce qu’on chante partout dans le monde, mais parce
          qu’on sait chanter en français, en italien, en anglais, en allemand,
          en russe … »
        </p>

        <p>
          J’aimerai ajouter que chanter devant un public qui vient des quatre
          coins du monde, c’est aussi ça être chanteur international ! Alors
          pour toutes ces raisons, le Métro est une immense scène mondiale !
        </p>
      </article>
    </section>

    <section id="metro_container">
      <article style="justify-content: space-evenly">
        <div>
          <Calendar :eventsData="eventsData" @dateClicked="updateMapPosition" />
        </div>
        <img src="https://placehold.co/600x400" alt="" srcset="" />
      </article>

      <article>
        <img src="https://placehold.co/600x400" alt="" srcset="" />
        <div>
          <MapVue
            :eventsData="eventsData"
            :centerCoordinates="mapCenterCoordinates"
          />
        </div>
      </article>
    </section>

    <HomeButton />
  </main>
</template>

<style scoped lang="scss">
main {
  padding: 2rem;

  #metro_introduction p {
    font-size: 20px;
    margin-bottom: 1rem;
  }

  #metro_container {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;

    article {
      padding: 0.5rem;
      flex: 50 1 300px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
  }
}
</style>
