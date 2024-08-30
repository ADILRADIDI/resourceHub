<script setup>
import { ref, computed } from 'vue';

const events = ref([
  { id: 9, user_id: 2, title: 'events sjndn asjdn ', description: 'dddd', city: 'cuuuu', location: 'Casablanca', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 10, user_id: 2, title: 'ef', description: 'dddd', city: 'cuuuu', location: 'Agadir', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 11, user_id: 2, title: 'ddddd', description: 'dddd', city: 'cuuuu', location: 'Tangier', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 12, user_id: 2, title: 'events sjndn asjdn ', description: 'dddd', city: 'cuuuu', location: 'Rabat', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 13, user_id: 2, title: 'ddddd', description: '4dddd 4dddd 4dddd 4dddd 4dddd 4dddd4dddd4dddd4dddd4dddd 4dddd', city: 'cuuuu', location: 'Casablanca', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'terminé', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
  { id: 14, user_id: 2, title: ' events sjndn asjdn', description: 'dddd', city: 'cuuuu', location: 'Agadir', start_time: '2024-08-21 12:57:44', end_time: '2024-08-21 12:58:44', status: 'En cour', created_at: null, updated_at: '2024-08-21T12:08:16.000000Z' },
]);

const locations = ['All', 'Casablanca', 'Agadir', 'Tangier', 'Rabat'];
const selectedLocation = ref('All');
const searchQuery = ref('');
const selectedEvent = ref(null);
const showModal = ref(false);
const showModal2 = ref(false);

const filteredEvents = computed(() => {
  return events.value.filter(event => {
    const matchesQuery = event.title.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesLocation = selectedLocation.value === 'All' || event.location === selectedLocation.value;
    return matchesQuery && matchesLocation;
  });
});

const openModal = (event) => {
  selectedEvent.value = event;
  showModal.value = true;
};

const openModal2 = (event) => {
  selectedEvent.value = event;
  showModal2.value = true;
};

const closeModal = () => {
  showModal.value = false;
  showModal2.value = false;
};
</script>

<template>
  <main class="main-container">
    <div class="content">
      <!-- Search Bar -->
      <div class="search-bar mb-8 p-4 flex flex-col sm:flex-row items-center gap-4">
        <div class="location-filter flex items-center mb-4 sm:mb-0">
          <h3 class="text-lg font-semibold mr-0 sm:mr-10">Filter by Location</h3>
          <ul class="flex flex-wrap gap-4">
            <li v-for="location in locations" :key="location" @click="selectedLocation = location" :class="{'font-bold text-blue-500': selectedLocation === location}" class="cursor-pointer hover:text-blue-400">
              {{ location }}
            </li>
          </ul>
        </div>
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search events..."
          class="p-2 border rounded-lg w-full sm:w-auto focus:border-blue-400"
        />
      </div>

      <!-- Events Grid -->
      <div class="events-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        <div v-for="event in filteredEvents" :key="event.id" class="event-card bg-white shadow-lg rounded-lg p-4 hover:shadow-xl transition-shadow">
          <h2 class="text-xl font-semibold mb-2 text-center">{{ event.title }}</h2>
          <p class="text-gray-500 mb-10 text-center">{{ event.location }}</p>
          <!-- <div class="flex items-center justify-between gap-5"> -->
            <button
              @click="openModal(event)"
              class="register-btn bg-blue-500
               text-white py-2 px-4 mb-3 w-full rounded hover:bg-blue-600 transition-colors">
              Register Now
            </button>
            <button
              @click="openModal2(event)"
              class="details-btn bg-gray-200
               text-gray-700 py-2 px-4 w-full rounded hover:bg-gray-300 transition-colors">
              More Details
            </button>
          <!-- </div> -->
        </div>
      </div>

      <!-- Modal for Registration -->
      <div v-if="showModal" class="modal fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
        <div class="modal-content bg-blue-400 p-6 rounded-lg shadow-lg w-1/2">
          <h2 class="text-xl font-semibold mb-4 text-white text-center">Registration Successful</h2>
          <p class="mb-4 text-white text-center">You have registered successfully. Please check your email for your ticket.</p>
          <button @click="closeModal" class=" bg-gray-500 text-white py-2 px-5 rounded hover:bg-transparent transition-colors rounded-full">
            Close
          </button>
        </div>
      </div>

      <!-- Modal for More Details -->
      <div v-if="showModal2" class="modal fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
        <div class="modal-content bg-blue-400 p-6 rounded-lg shadow-lg w-1/2">
          <h2 class="text-xl font-semibold mb-4 text-white text-center">{{ selectedEvent?.title }}</h2>
          <p class="text-white mb-2 text-center"><strong>Description:</strong> {{ selectedEvent?.description }}</p>
          <p class="text-white mb-2 text-center"><strong>Date:</strong> {{ new Date(selectedEvent?.start_time).toLocaleDateString() }}</p>
          <p class="text-white mb-4 text-center"><strong>Location:</strong> {{ selectedEvent?.location }}</p>
          <p class="text-white mb-4 text-center"><strong>Status:</strong> {{ selectedEvent?.status }}</p>
          <button @click="closeModal" class="bg-gray-500 text-white py-2 px-5 rounded-full hover:bg-transparent transition-colors">
            Close
          </button>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}

.content {
  padding: 2rem;
}

.search-bar {
  max-width: 100%;
}

.location-filter ul {
  display: flex;
  flex-wrap: wrap;
}

.events-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 1.5rem;
}

.event-card {
  border: 1px solid #e2e8f0;
}

.register-btn, .details-btn {
  transition: background-color 0.3s ease;
}

.modal {
  z-index: 1000;
}

.modal-content {
  max-width: 50%;
  width: 50%;
  margin: 0 auto;
}

.modal-content h2, .modal-content p {
  text-align: center;
}

button {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
