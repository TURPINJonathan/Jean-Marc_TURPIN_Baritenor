<script setup lang="ts">
import { useDateUtils } from "@utils/dateUtils";

const date = useDateUtils();
</script>

<template>
  <footer>
    &copy;Copyright&nbsp;<span style="text-transform: capitalize">{{
      date.getMonth()
    }}</span>
    &nbsp;{{ date.getYear() }}
  </footer>
</template>

<style scoped lang="scss">
footer {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(33, 33, 33);
  color: rgb(241, 241, 241);
  padding-bottom: 1rem;
  padding-top: 1rem;
}
</style>
