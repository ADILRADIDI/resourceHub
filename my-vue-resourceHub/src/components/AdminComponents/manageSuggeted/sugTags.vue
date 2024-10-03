<template>
    <div class="mx-10 mt-10">
      <h1 class="text-2xl font-bold mb-6">Manage Tags</h1>
  
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Name</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tag in tags" :key="tag.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4">{{ tag.id }}</td>
              <td class="px-6 py-4">{{ tag.name }}</td>
              <td class="px-6 py-4">
                <span :class="getStatusColor(tag.status)">
                  {{ tag.status }}
                </span>
              </td>
              <td class="px-6 py-4 flex space-x-4">
                <button @click="acceptTag(tag)" class="text-green-600 hover:underline">Accept</button>
                <button @click="deleteChannel(tag)" class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Alert Message -->
      <div v-if="alert.message" :class="`mt-4 p-4 rounded ${alert.type === 'error' ? 'bg-red-200' : 'bg-green-200'}`">
        {{ alert.message }}
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { API_BASE_URL } from '@/config';
  
  export default {
    data() {
      return {
        tags: [],
        alert: {
          type: '',
          message: ''
        }
      };
    },
    mounted() {
      this.fetchTags();
    },
    methods: {
      getAuthToken() {
        return localStorage.getItem('user-token');
      },
      async fetchTags() {
        try {
          const response = await axios.get(`${API_BASE_URL}getAllD`, {
            headers: {
              Authorization: `Bearer ${this.getAuthToken()}`
            }
          });
          this.tags = response.data;
        } catch (error) {
          console.error('Error fetching tags:', error);
          this.showAlert('error', 'Failed to fetch tags.');
        }
      },
      async acceptTag(tag) {
        try {
          await axios.post(`${API_BASE_URL}suggested-tags/${tag.id}/accept`, {}, {
            headers: {
              Authorization: `Bearer ${this.getAuthToken()}`
            }
          });
          this.showAlert('success', 'Tag accepted successfully.');
          this.fetchTags();
        } catch (error) {
          console.error('Error accepting tag:', error);
          this.showAlert('error', 'Failed to accept tag.');
        }
      },
      async deleteChannel(tag) {
            try {
                await axios.delete(`${API_BASE_URL}tags/${tag.id}`, {
                    headers: {
                        Authorization: `Bearer ${this.getAuthToken()}`
                    }
                }); 
                this.fetchTags();
                this.showAlert('success', 'Tag deleted successfully.');
            } catch (error) {
                console.error('Error deleting tag:', error);
                this.showAlert('error', 'Failed to reject tag.');
                
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
      },
      showAlert(type, message) {
        this.alert.type = type;
        this.alert.message = message;
        setTimeout(() => {
          this.alert.message = '';
        }, 3000);
      }
    }
  };
  </script>
  