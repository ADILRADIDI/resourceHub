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
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
              <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th> -->
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="event in events" :key="event.id">
              <td class="px-6 py-4 whitespace-nowrap ">
                <span class="font-bold">{{ event.title }}</span>  
                <br>
                <span class="text-sm">{{ event.description }}</span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">{{ event.city }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ event.location }}</td>
              <!-- <td class="px-6 py-4 whitespace-nowrap">{{ event.start_time }}</td> -->
              <!-- <td class="px-6 py-4 whitespace-nowrap">{{ event.end_time }}</td> -->
              <td class="px-6 py-4 whitespace-nowrap">{{ event.status }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button @click="openEditModal(event.id)" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                <button @click="confirmDelete(event.id)" class="text-red-600 hover:text-red-900">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add/Edit Event Modal -->
      <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-600 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
          <h2 class="text-lg font-semibold mb-4">{{ isEditing ? 'Edit Event' : 'Add Event' }}</h2>
          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
              <input v-model="form.title" type="text" id="title" class="mt-1 block w-full border-gray-300 rounded-md" required />
            </div>
            <div class="mb-4">
              <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
              <textarea v-model="form.description" id="description" class="mt-1 block w-full border-gray-300 rounded-md" required></textarea>
            </div>
            <div class="mb-4">
              <label for="city" class="block text-sm font-medium text-gray-700">City</label>
              <input v-model="form.city" type="text" id="city" class="mt-1 block w-full border-gray-300 rounded-md" required />
            </div>
            <div class="mb-4">
              <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
              <input v-model="form.location" type="text" id="location" class="mt-1 block w-full border-gray-300 rounded-md" required />
            </div>
            <div class="mb-4">
              <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
              <input v-model="form.start_time" type="datetime-local" id="start_time" class="mt-1 block w-full border-gray-300 rounded-md" required />
            </div>
            <div class="mb-4">
              <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
              <input v-model="form.end_time" type="datetime-local" id="end_time" class="mt-1 block w-full border-gray-300 rounded-md" required />
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select v-model="form.status" id="status" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    <option value="planifié">Planifié</option>
                    <option value="en cours">En Cours</option>
                    <option value="terminé">Terminé</option>
                </select>
            </div>
            <div class="flex justify-end">
              <button type="button" @click="closeModal" class="mr-2 px-4 py-2 bg-gray-300 text-black rounded-lg">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">{{ isEditing ? 'Update Event' : 'Add Event' }}</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import axios from 'axios';
import Sidebar from './Sidebar.vue';
import { API_BASE_URL } from '@/config';

export default {
  components: {
    Sidebar,
  },
  data() {
    return {
      isModalOpen: false,
      isEditing: false,
      editingEventId: null,
      events: [],
      form: {
        title: '',
        description: '',
        city: '',
        location: '',
        start_time: '',
        end_time: '',
      },
    };
  },
  created() {
    this.fetchEvents();
  },
  methods: {
    async fetchEvents() {
      try {
        const token = localStorage.getItem('user-token');
        const response = await axios.get(`${API_BASE_URL}events`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.events = response.data;
      } catch (error) {
        console.error('Error fetching events:', error);
      }
    },
    openAddModal() {
      this.isEditing = false;
      this.resetForm();
      this.isModalOpen = true;
    },
    openEditModal(eventId) {
      this.isEditing = true;
      this.editingEventId = eventId;
      this.fetchEvent(eventId);
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      this.resetForm();
    },
    async fetchEvent(eventId) {
      try {
        const token = localStorage.getItem('user-token');
        const response = await axios.get(`${API_BASE_URL}events/${eventId}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.form = response.data;
      } catch (error) {
        console.error('Error fetching event:', error);
      }
    },
    async submitForm() {
        try {
            const token = localStorage.getItem('user-token');
            if (this.isEditing) {
                await axios.put(`${API_BASE_URL}events/${this.editingEventId}`, this.form, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
            } else {
                await axios.post(`${API_BASE_URL}events`, this.form, {
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                });
            }
            this.fetchEvents();
            this.closeModal();
        } catch (error) {
            if (error.response) {
                console.error('Validation Errors:', error.response.data.errors);
            }
            console.error('Error submitting event:', error);
        }
    }
    ,
    confirmDelete(eventId) {
      if (confirm("Are you sure you want to delete this event?")) {
        this.deleteEvent(eventId);
      }
    },
    async deleteEvent(eventId) {
      try {
        const token = localStorage.getItem('user-token');
        await axios.delete(`${API_BASE_URL}events/${eventId}`, {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.fetchEvents();
      } catch (error) {
        console.error('Error deleting event:', error);
      }
    },
    resetForm() {
      this.form = {
        title: '',
        description: '',
        city: '',
        location: '',
        start_time: '',
        end_time: '',
      };
    },
  },
};
</script>

<style scoped>
aside {
  min-height: 100vh;
}

main {
  margin-left: 16rem;
}
</style>