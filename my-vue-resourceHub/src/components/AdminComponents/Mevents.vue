<template>
  <div class="flex">
    <!-- Sidebar Component -->
    <Sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6 mt-20 w-[80%]">
      <h1 class="text-2xl font-semibold mb-4">Manage Events</h1>

      <!-- Add Event Button -->
      <div class="mb-4">
        <button @click="openAddModal" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Event</button>
      </div>

      <!-- Table Container with Scroll -->
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title & Description</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="event in events" :key="event.id">
              <td class="px-6 py-4 whitespace-nowrap block">
                {{ event.title }}
                <span class="text-sm">  
                  {{ event.description }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ event.city }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ event.start_time }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ event.end_time }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ event.status }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button @click="openEditModal(event.id)" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                <button @click="confirmDelete(event.id)" class="text-red-600 hover:text-red-900">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add Event Modal -->
      <AddEventModal :isOpen="isAddModalOpen" @close="closeAddModal" @event-added="fetchEvents" />

      <!-- Edit Event Modal -->
      <EditEventModal :isOpen="isEditModalOpen" :eventId="editingEventId" @close="closeEditModal" @event-updated="fetchEvents" />
    </main>
  </div>
</template>

<script>
import axios from 'axios';
import AddEventModal from './AddEventModal.vue';
import EditEventModal from './EditEventModal.vue';
import Sidebar from './Sidebar.vue';
import { API_BASE_URL } from '@/config';

export default {
  components: {
    AddEventModal,
    EditEventModal,
    Sidebar,
  },
  data() {
    return {
      isAddModalOpen: false,
      isEditModalOpen: false,
      editingEventId: null,
      events: [], // Array to hold events
    };
  },
  created() {
    this.fetchEvents(); // Fetch events when the component is created
  },
  methods: {
    async fetchEvents() {
      try {
        const response = await axios.get(`${API_BASE_URL}events`); // Adjust the API endpoint accordingly
        this.events = response.data; // Populate events array
      } catch (error) {
        console.error('Error fetching events:', error);
      }
    },
    openAddModal() {
      this.isAddModalOpen = true;
    },
    closeAddModal() {
      this.isAddModalOpen = false;
    },
    openEditModal(eventId) {
      this.editingEventId = eventId;
      this.isEditModalOpen = true;
    },
    closeEditModal() {
      this.isEditModalOpen = false;
    },
    confirmDelete(eventId) {
      if (confirm("Are you sure you want to delete this event?")) {
        this.deleteEvent(eventId);
      }
    },
    async deleteEvent(eventId) {
      try {
        await axios.delete(`/api/events/${eventId}`); // Adjust the API endpoint accordingly
        this.fetchEvents(); // Refresh events after deletion
      } catch (error) {
        console.error('Error deleting event:', error);
      }
    },
  },
};
</script>

<style scoped>
/* Sidebar styling */
aside {
  min-height: 100vh; /* Ensure sidebar spans full viewport height */
}

/* Main content styling */
main {
  margin-left: 16rem; /* Adjust based on sidebar width */
}
</style>
