<script setup>
import { ref, computed } from 'vue';

// Events data
const events = ref([
  { id: 9, user_id: 2, title: 'Event A', description: 'Details about event A.', city: 'Casablanca', location: 'Casablanca', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 10, user_id: 2, title: 'Event B', description: 'Details about event B.', city: 'Agadir', location: 'Agadir', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 11, user_id: 2, title: 'Event C', description: 'Details about event C.', city: 'Tangier', location: 'Tangier', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 9, user_id: 2, title: 'Event A', description: 'Details about event A.', city: 'Casablanca', location: 'Casablanca', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 10, user_id: 2, title: 'Event B', description: 'Details about event B.', city: 'Agadir', location: 'Agadir', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 11, user_id: 2, title: 'Event C', description: 'Details about event C.', city: 'Tangier', location: 'Tangier', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 12, user_id: 2, title: 'Event D', description: 'Details about event D.', city: 'Rabat', location: 'Rabat', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 13, user_id: 2, title: 'Event E', description: 'Details about event E.', city: 'Casablanca', location: 'Casablanca', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'En cour', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
]);

// Filter and search states
const selectedLocation = ref('All');
const searchQuery = ref('');

// Filtered events based on search and city filter
const filteredEvents = computed(() => {
  return events.value.filter(event => {
    const matchesQuery = event.title.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesLocation = selectedLocation.value === 'All' || event.city === selectedLocation.value;
    return matchesQuery && matchesLocation;
  });
});

// Handle registration logic
const registerForEvent = (eventId) => {
  alert(`You have registered for event ID: ${eventId}`);
};
</script>

<template>
  <section id="events">
    <!-- <div class="events-heading mb-10">
      <h3>Upcoming Events</h3>
      <p>Explore our upcoming events across various locations.</p>
    </div> -->

    <!-- Search and Filter -->
    <div class="filter-container">
      <input type="text" v-model="searchQuery" placeholder="Search events..." class="rounded-xl outline-none	" />
      
      <select v-model="selectedLocation" class="rounded-xl outline-none	">
        <option value="All">All</option>
        <option value="Casablanca">Casablanca</option>
        <option value="Agadir">Agadir</option>
        <option value="Tangier">Tangier</option>
        <option value="Rabat">Rabat</option>
      </select>
    </div>

    <div class="events-box-container ">
      <div class="events-box" v-for="event in filteredEvents" :key="event.id">
        <div class="events-box-inner">
          <!-- Front side of the card -->
          <div class="events-box-front">
            <div class="events-img">
              <img src="https://cdn.guichet.com/events/neon-wave-event.jpeg?w=900&h=600&fit=clip&auto=format,compress&q=80" 
              alt="Event Image" class="event-image" />
            </div>
            <div class="events-text">
              <strong class="mr-8">{{ event.title }}</strong>
              <span class="location ml-8">in {{ event.location }}</span>
            </div>
          </div>

          <!-- Back side of the card -->
          <div class="events-box-back bg-gray-300 ">
            <div class="back-content">
              <strong class="mr-8 text-2xl text-black justify-center items-center">{{ event.title }}</strong>
              <p class="mt-2 text-black">{{ event.description }}</p>
              <p class="bg-blue-400 text-white text-center py-1 mb-5 px-4 rounded-full mt-8 mx-auto w-fit">{{ event.status }}</p>              
              <p class="text-black"><strong>from:</strong> {{ event.start_time }} <strong> to:</strong></p>
              <!-- <p><strong>End:</strong> {{ event.end_time }}</p> -->
              <!-- Register Button -->
              <button @click="registerForEvent(event.id)" class="register-button rounded-full 
              bg-blue-700 hover:bg-blue-800">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

#events {
  max-width: 1200px;
  width: 100%;
  margin: 80px auto;
}

.events-heading {
  text-align: center;
}

.events-heading h3 {
  font-size: 2.4rem;
  color: #027179;
  font-weight: 900;
}

.events-heading p {
  color: #535353;
  font-size: 0.9rem;
}

.filter-container {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.filter-container input {
  padding: 10px;
  font-size: 1rem;
  width: 60%;
}

.filter-container select {
  padding: 10px;
  font-size: 1rem;
  width: 30%;
}

.events-box-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  justify-items: center;
  margin-top: 2.5rem; 
}

.events-box {
  max-width: 275px;
  width: 100%;
  margin: 10px;
  perspective: 1000px;
}

.events-box-inner {
  position: relative;
  width: 100%;
  height: 350px;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.events-box:hover .events-box-inner {
  transform: rotateY(180deg);
}

.events-box-front, .events-box-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.events-box-front {
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.events-img {
  background-color: #f5f7fb;
  padding: 10px;
  height: 300px;
  display: flex;
  align-items: flex-end;
  border-radius: 10px 10px 0 0;
}

.event-image {
  width: 100%;
  height: 99%;
  object-fit: cover;
  object-position: center;
  border-radius: 8px;
  box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
}

.events-text {
  padding: 10px;
}

.events-text strong {
  color: #027179;
  font-size: 1.3rem;
  font-weight: 600;
}

.events-text .location {
  color: #303030;
  font-size: 1rem;
  margin-top: 8px;
}

.events-box-back {
  /* background-color: gray; */
  color: white;
  transform: rotateY(180deg);
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
}

.back-content {
  padding: 20px;
}

.back-content p {
  font-size: 0.9rem;
}

.register-button {
  margin-top: 10px;
  /* background-color: #ff5722; */
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  font-size: 1rem;
}

</style>
