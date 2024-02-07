<script setup lang="ts">
import { ref, computed, defineProps, defineEmits } from "vue";
import { useDateUtils } from "@utils/dateUtils";
import type { EventType } from "@types/eventType";

const { getCurrentDate, getMonth, getYear, isSameDay } = useDateUtils();

const currentDate = ref<Date>(getCurrentDate());
const selectedDate = ref<Date | null>(null);
const currentMonth = computed(() => getMonth(currentDate.value));
const currentYear = computed(() => getYear(currentDate.value));
const daysOfWeek = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"];

const emit = defineEmits<{
  (e: "dateClicked", date: Date): void;
}>();

const props = defineProps(["eventsData"]);
const generateCalendar = () => {
  type CalendarMatrix = (Date | null)[][];

  const firstDayOfMonth = new Date(
    currentDate.value.getFullYear(),
    currentDate.value.getMonth(),
    1
  );
  const lastDayOfMonth = new Date(
    currentDate.value.getFullYear(),
    currentDate.value.getMonth() + 1,
    0
  );
  const firstDayOfWeek = (firstDayOfMonth.getDay() + 6) % 7;

  let calendarMatrix: CalendarMatrix = [[]];
  let currentWeek = 0;

  for (let i = 1; i <= lastDayOfMonth.getDate(); i++) {
    const currentDay = new Date(
      currentDate.value.getFullYear(),
      currentDate.value.getMonth(),
      i
    );

    if (i === 1 && firstDayOfWeek > 0) {
      calendarMatrix[currentWeek] = new Array(firstDayOfWeek).fill(null);
    }

    calendarMatrix[currentWeek].push(new Date(currentDay));

    if (currentDay.getDay() === 0 && i < lastDayOfMonth.getDate()) {
      currentWeek++;
      calendarMatrix.push([]);
    }
  }

  return calendarMatrix;
};

const calendar = ref(generateCalendar());

const navigateToPreviousMonth = () => {
  currentDate.value = new Date(
    currentDate.value.getFullYear(),
    currentDate.value.getMonth() - 1,
    currentDate.value.getDate()
  );
  calendar.value = generateCalendar();
};
true;

const navigateToNextMonth = () => {
  currentDate.value = new Date(
    currentDate.value.getFullYear(),
    currentDate.value.getMonth() + 1,
    currentDate.value.getDate()
  );
  calendar.value = generateCalendar();
};

const isCurrentDay = (date: Date) => {
  const today = getCurrentDate();
  return (
    date.getDate() === today.getDate() &&
    date.getMonth() === today.getMonth() &&
    date.getFullYear() === today.getFullYear()
  );
};

const isPastDays = (date: Date) => {
  return date < getCurrentDate();
};

const handleDateClick = (date: Date) => {
  emit("dateClicked", date);
  selectedDate.value = date;
};

const isEventDate = (date: Date) => {
  return props.eventsData.some((event: EventType) =>
    isSameDay(date, event.date)
  );
};
</script>

<template>
  <div>
    <h2>
      <font-awesome-icon
        :icon="['fas', 'chevron-left']"
        @click="navigateToPreviousMonth"
        class="calendar_navigation"
      />
      <span>{{ currentMonth }} {{ currentYear }}</span>
      <font-awesome-icon
        :icon="['fas', 'chevron-right']"
        @click="navigateToNextMonth"
        class="calendar_navigation"
      />
    </h2>

    <table>
      <thead>
        <tr>
          <th v-for="day in daysOfWeek" :key="day">{{ day }}</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(week, index) in calendar" :key="index">
          <td
            v-for="(date, dateIndex) in week"
            :key="date ? `${(date as Date).getDate()}_${index}` : dateIndex"
            :class="{
              date_today: date && isCurrentDay(date),
              date_past: date && isPastDays(date),
              date_event: date && isEventDate(date),
              date_selected:
                date && selectedDate && isSameDay(date, selectedDate),
            }"
            @click="handleDateClick(date as Date)"
          >
            <span>{{ date ? (date as Date).getDate() : "" }}</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped lang="scss">
div {
  h2 {
    text-transform: capitalize;
    display: flex;
    justify-content: space-evenly;
    align-items: center;

    span {
      width: 30%;
      text-align: center;
    }

    .calendar_navigation {
      font-size: 1rem;
      cursor: pointer;
    }
  }

  table {
    width: 100%;

    thead tr th {
      border-bottom: 1px solid rgb(241, 241, 241);
    }

    tbody tr td {
      text-align: center;
      cursor: not-allowed;
    }

    .date_today {
      color: blue !important;
    }

    .date_past {
      color: rgb(118, 118, 118);
    }

    .date_event {
      cursor: pointer;
    }

    .date_event span {
      border-radius: 50%;
      margin: auto;
      border: red 1px solid;
      font-weight: bold;
      width: 1.3rem;
      height: 1.3rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .date_selected span {
      background-color: red;
    }
  }
}
</style>
