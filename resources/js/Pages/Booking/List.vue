<script setup>
  import { ref } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';

  const bookings = ref(null);
  fetch('/api/bookings')
      .then(response => response.json())
      .then(data => bookings.value = data);
</script>

<script>
  export default {
    methods: {
      formatDate(dateString) {
        const date = new Date(dateString);
        console.log(date);
        // Then specify how you want your dates to be formatted
        return new Intl.DateTimeFormat('default', {dateStyle: 'long', timeStyle: 'short'}).format(date);
      }
    }
  }
</script>

<template>
  <Head title="All Bookings" />

  <AuthenticatedLayout>

    <div class="p-6">
      <h1 class="header">Upcoming Bookings</h1>

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
            <td>{{ this.formatDate(booking.booking_datetime) }}</td>
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
