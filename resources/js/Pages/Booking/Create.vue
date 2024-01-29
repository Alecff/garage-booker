<script setup>
  import { ref } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import { watch } from 'vue';
  import VueDatePicker from '@vuepic/vue-datepicker';
  import '@vuepic/vue-datepicker/dist/main.css';
  import GuestLayout from "@/Layouts/GuestLayout.vue";

  const date = ref(null);
  const formData = {
      name: '',
      email: '',
      phone_number: '',
      vehicle_make_model: '',
      booking_datetime: null,
  };

  watch(date, (newDate) => {
    formData.booking_datetime = newDate.toISOString();
  });

  function submit() {
      fetch('/api/booking', {
          method: 'POST',
          body: JSON.stringify(formData),
          headers: {
              'Content-type': 'application/json; charset=UTF-8',
          },
      }).then(response => response.json())
          .then(data => {
              console.log(data);
          });
  }
</script>

<template>
  <Head title="All Bookings" />

  <GuestLayout>

    <div class="booking-form">
      <h1 class="header">Book a Slot</h1>

        <span class="datepicker">
            <VueDatePicker
                v-model="date"
                minutes-increment="30"
                minutes-grid-increment="30"
                :max-time="{ hours:17, minutes: 30 }"
                :min-time="{ hours:9, minutes: 0 }"
                placeholder="Select Date and Time"
                :start-time="{hours: 12, minutes: 0}"
            />
        </span>

        <input class="form-input" v-model="formData.name" placeholder="Name" />
        <input class="form-input" v-model="formData.email" placeholder="Email" />
        <input class="form-input" v-model="formData.phone_number" placeholder="Phone Number" />
        <input class="form-input" v-model="formData.vehicle_make_model" placeholder="Vehicle Make and Model" />
        <button class="form-input form-button" @click="submit">SUBMIT</button>
    </div>

  </GuestLayout>
</template>

<style scoped>
.header {
  font-weight: 600;
  font-size: 2em;
}

.booking-form {
    display: flex;
    flex-direction: column;
    padding: 2em;
    align-items: center;
}

.datepicker {
    margin: 0.6em 0 0.6em 0;
    width: 100%;
}

.form-input {
    padding: 1em;
    border-radius: 0.5em;
    margin: 0.6em 0 0.6em 0;
    width: 100%;
}

.form-button {
    color: white;
    font-weight: 400;
    background-color: #2a2f42;
    width: 10em;
    border-color: white;
}
</style>
