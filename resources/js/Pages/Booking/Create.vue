<script setup>
  import { ref } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import { watch } from 'vue';
  import VueDatePicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css';
  import GuestLayout from "@/Layouts/GuestLayout.vue";

  const bookings = ref(null);
  const date = new Date();
  date.setHours(date.getHours() + 1, 0,0,0);

  fetch('/api/bookings')
      .then(response => response.json())
      .then(data => bookings.value = data);

  watch(date, (newDate) => {
    console.log(newDate);
  });

  function formatDate(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('default', { dateStyle: 'long', timeStyle: 'short' }).format(date);
  }
</script>

<template>
  <Head title="All Bookings" />

  <GuestLayout>

    <div class="p-6">
      <h1 class="header">Upcoming Bookings</h1>

      <VueDatePicker
          v-model="date"
          enable-time-picker="false"
      />

      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Make and Model</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="booking in bookings">
            <td>{{ booking.name }}</td>
            <td>{{ booking.vehicle_make_model }}</td>
            <td>{{ formatDate(booking.booking_datetime) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

  </GuestLayout>
</template>

<style scoped>
.header {
  font-weight: 600;
  font-size: 3em;
}
</style>
