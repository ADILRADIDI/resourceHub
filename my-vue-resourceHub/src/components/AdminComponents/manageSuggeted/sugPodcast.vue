<template>
  <div class="mx-10 mt-10">
    <h1 class="text-2xl font-bold mb-6">Manage Podcasts</h1>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">ID</th>
            <th scope="col" class="px-6 py-3">Title</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="podcast in podcasts" :key="podcast.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">{{ podcast.id }}</td>
            <td class="px-6 py-4">{{ podcast.title }}</td>
            <td class="px-6 py-4">
              <span :class="getStatusColor(podcast.status)">
                {{ podcast.status }}
              </span>
            </td>
            <td class="px-6 py-4 flex space-x-4">
              <button @click="confirmDelete(podcast.id)" class="text-red-600 hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Confirmation Delete Modal -->
    <div v-if="showDeleteModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Confirm Deletion</h3>
        <p>Are you sure you want to delete this podcast?</p>
        <div class="flex justify-end mt-4">
          <button @click="deletePodcast(currentPodcastId)" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">Yes, Delete</button>
          <button @click="cancelDelete" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 ml-2">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { API_BASE_URL } from '@/config';

export default {
  data() {
    return {
      podcasts: [],
      showDeleteModal: false, // State for delete confirmation modal
      currentPodcastId: null // Store the ID of the podcast to delete
    };
  },
  created() {
    this.fetchPodcasts();
  },
  methods: {
    getAuthToken() {
      return localStorage.getItem('user-token');
    },
    async fetchPodcasts() {
      try {
        const response = await axios.get(`${API_BASE_URL}suggested-podcasts`, {
          headers: {
            Authorization: `Bearer ${this.getAuthToken()}`
          }
        });
        this.podcasts = response.data;
      } catch (error) {
        console.error('Error fetching podcasts:', error);
      }
    },
    confirmDelete(id) {
      this.currentPodcastId = id; // Set the current podcast ID
      this.showDeleteModal = true; // Show the delete confirmation modal
    },
    cancelDelete() {
      this.showDeleteModal = false; // Hide the delete confirmation modal
      this.currentPodcastId = null; // Reset the current podcast ID
    },
    async deletePodcast(id) {
      try {
        await axios.delete(`${API_BASE_URL}suggested-podcasts/${id}`, {
          headers: {
            Authorization: `Bearer ${this.getAuthToken()}`
          }
        });
        this.fetchPodcasts(); // Refresh the list after deletion
        // alert('Podcast deleted successfully.');
      } catch (error) {
        console.error('Error deleting podcast:', error);
        alert('Failed to delete podcast.');
      } finally {
        this.cancelDelete();
      }
    },
    getStatusColor(status) {
      switch (status) {
        case 'published':
          return 'text-green-500';
        case 'archived':
          return 'text-red-500';
        default:
          return 'text-gray-500';
      }
    }
  }
};
</script>
