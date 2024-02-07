<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, watch } from "vue";
import { Map as LeafletMap, TileLayer, Marker, Icon } from "leaflet";
import { useDateUtils } from "@utils/dateUtils";
import MetroLogo from "@assets/pictures/metro_logo.png";
import LyricLogo from "@assets/pictures/lyrics_logo.png";
import type { EventType } from "@types/eventType";

const props = defineProps(["eventsData", "centerCoordinates"]);
const { formatDate, formatTime } = useDateUtils();

const mapContainer = ref(null);
let map: LeafletMap | null = null;

onMounted(() => {
  if (props.eventsData.length > 0) {
    createMap();
  }
});

onBeforeUnmount(() => {
  if (map) {
    map.remove();
  }
});

function createMap() {
  if (!mapContainer.value || map) {
    return;
  }

  map = new LeafletMap(mapContainer.value).setView(props.centerCoordinates, 13);

  new TileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    minZoom: 1,
    maxZoom: 17,
    ext: "png",
  }).addTo(map);

  const metroMarker = (type: string) => {
    return new Icon({
      iconUrl: type === "métro" ? MetroLogo : LyricLogo,
      iconSize: [30, 30],
      iconAnchor: [15, 15],
    });
  };

  // Add event on map
  props.eventsData.forEach((event: EventType) => {
    const marker = new Marker(
      [event?.eventPlace?.longitude, event?.eventPlace?.latitude],
      {
        icon: metroMarker(event?.eventPlace?.eventType?.label ?? ""),
      }
    ).addTo(map);
    marker.bindPopup(`
    <p>
      <span style="font-size: 1rem; font-weight: bold">
        ${event.eventPlace?.name}
      </span>
      <br/>
      <span style="text-transform: capitalize">
        ${formatDate(event.startAt)}
      </span>
      <span>
        &nbsp;entre&nbsp;${formatTime(event.startAt)}&nbsp;et&nbsp;${formatTime(
      event.endAt
    )}
      </span>
      <hr/>
    </p>
    <p style="font-style: italic">${event.details}</p>
    `);
  });
}

watch(
  () => props.centerCoordinates,
  (newCoordinates) => {
    if (map) {
      map.setView(newCoordinates, 17);
    }
  }
);
watch(
  () => props.eventsData,
  (newEventsData) => {
    if (newEventsData.length > 0) {
      createMap();
    }
  }
);
</script>

<template>
  <div ref="mapContainer" class="map-container" />
</template>

<style scoped>
.map-container {
  height: 400px;
  width: 100%;
}
</style>
