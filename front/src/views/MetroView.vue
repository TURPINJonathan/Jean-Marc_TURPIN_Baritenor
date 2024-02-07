<script setup lang="ts">
import { ref, onMounted } from "vue";
import type { EventType } from "@types/eventType";
import { useDateUtils } from "@utils/dateUtils";
import HomeButton from "@components/common/HomeButton.vue";
import Calendar from "@components/Calendar.vue";
import MapVue from "@components/Map.vue";
import { useApi } from "@composables/callRoutes";

const { isSameDay } = useDateUtils();
const { get } = useApi();

const eventsData = ref<EventType[]>([]);

onMounted(async () => {
  const data = await get("event/future");
  if (data && Array.isArray(data)) {
    eventsData.value = data as EventType[];
  }
});

let mapCenterCoordinates = ref([48.8566, 2.3522]);

const updateMapPosition = (selectedDate: Date) => {
  const currentEvent = eventsData.value.find((event: EventType) =>
    isSameDay(selectedDate, event.startAt)
  );

  if (
    currentEvent &&
    currentEvent?.eventPlace?.longitude &&
    currentEvent?.eventPlace?.longitude
  ) {
    mapCenterCoordinates.value = [
      currentEvent.eventPlace.longitude,
      currentEvent.eventPlace.latitude,
    ];
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
