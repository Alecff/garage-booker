<script setup>
  import { ref } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import { watch } from 'vue';
  import VueDatePicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css';

  const bookings = ref(null);
  const date = ref(null);

  fetch('/api/bookings')
      .then(response => response.json())
      .then(data => bookings.value = data);

  watch(date, (newDate) => {
    // refresh list result for given day, or clear date filter
    const query = newDate !== null ? '?date=' + formatDate(newDate) : '';
    fetch('/api/bookings' + query)
        .then(response => response.json())
        .then(data => {
          console.log(data);
         bookings.value = data;
        });
  });

  function formatDate(date) {
    return [
      date.getFullYear(),
      date.getMonth() + 1,
      date.getDate(),
    ].join('-');
  }

  function displayDate(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('default', { dateStyle: 'long', timeStyle: 'short' }).format(date);
  }
</script>

<template>
  <Head title="All Bookings" />

  <AuthenticatedLayout>

    <div class="p-6">
      <h1 class="header">Upcoming Bookings</h1>

      <VueDatePicker
          v-model="date"
          :enable-time-picker="false"
          :clearable="true"
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
            <td>{{ displayDate(booking.booking_datetime) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

  </AuthenticatedLayout>
</template>

<style scoped>
.header {
  font-weight: 600;
  font-size: 3em;
}
</style>
