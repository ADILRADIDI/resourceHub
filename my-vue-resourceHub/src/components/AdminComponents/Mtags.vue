<template>
  <div class="flex">
    <!-- Sidebar -->
    <Sidebar class="w-56" />
    
    <!-- Main Content -->
    <div class="flex-1 ml-56 p-4 mt-20">
      <h1 class="font-bold text-2xl mb-5">Manage Tags</h1>

      <!-- Add Tag Button -->
      <button @click="showAddModal = true" class="mb-5 px-4 py-2 bg-blue-500 text-white rounded-lg">
        Add Tag
      </button>

      <!-- Tags Table -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Name</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tag in tags" :key="tag.id" class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700">
              <td class="px-6 py-4">{{ tag.id }}</td>
              <td class="px-6 py-4">{{ tag.name }}</td>
              <td class="px-6 py-4">{{ tag.status }}</td>
              <td class="px-6 py-4">
                <button @click="editTag(tag)" class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                  Edit
                </button>
                <button v-if="tag.status === 'draft'" @click="publishTag(tag.id)" class="font-medium mr-2 text-green-600 dark:text-green-500 hover:underline">
                  Publish
                </button>
                <button @click="deleteTag(tag.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add Tag Modal -->
      <div v-if="showAddModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-gray-900 opacity-60" @click="showAddModal = false"></div>
        <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
          <h2 class="text-xl font-semibold mb-4">Add New Tag</h2>
          <form @submit.prevent="addTag">
            <!-- Tag Name -->
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
              <input v-model="newTag.name" type="text" class="p-3 border border-gray-300 rounded-lg w-full" required />
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Tag</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Edit Tag Modal -->
      <div v-if="showEditModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-gray-900 opacity-60" @click="showEditModal = false"></div>
        <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
          <h2 class="text-xl font-semibold mb-4">Edit Tag</h2>
          <form @submit.prevent="updateTag">
            <!-- Tag Name -->
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
              <input v-model="currentTag.name" type="text" class="p-3 border border-gray-300 rounded-lg w-full" required />
            </div>
            <!-- Submit -->
            <div class="flex justify-end">
              <button type="submit"  class="px-4 py-2 bg-blue-500 text-white rounded-lg">Update Tag</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Sidebar from '@/components/AdminComponents/Sidebar.vue';
import { API_BASE_URL } from '@/config';

export default {
  components: {
    Sidebar,
  },
  data() {
    return {
      tags: [],
      showAddModal: false,
      showEditModal: false,
      currentTag: null,
      newTag: {
        name: '',
      },
    };
  },
  mounted() {
    this.fetchTags(); // Fetch tags when the component is mounted
  },
  methods: {
    // Fetch all tags from the API
    async fetchTags() {
      try {
        const response = await axios.get(`${API_BASE_URL}getAllTags`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        this.tags = response.data;
      } catch (error) {
        console.error('Error fetching tags:', error);
      }
    },

    // Publish a tag
    async publishTag(tagId) {
      try {
        const response = await axios.patch(`${API_BASE_URL}tags/${tagId}/publish`, null, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        this.fetchTags(); // Reload the tags after successful publish
        this.$toast.success(response.data.message); // Display success message
      } catch (error) {
        console.error(error.response.data);
        this.$toast.error(error.response.data.error || 'An error occurred'); // Display error message
      }
    },

    // Add a new tag
    async addTag() {
      try {
        const response = await axios.post(`${API_BASE_URL}tags`, this.newTag, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        this.fetchTags(); // Reload the tags after adding a new one
        this.showAddModal = false;
        this.$toast.success(response.data.message); // Display success message
        this.newTag.name = ''; // Reset the input field
      } catch (error) {
        console.error('Error adding tag:', error);
        this.$toast.error('Failed to add tag'); // Display error message
      }
    },

    // Edit an existing tag
    async editTag(tag) {
      this.currentTag = { ...tag };
      this.showEditModal = true;
    },

    // Update the tag
    async updateTag() {
      try {
        const response = await axios.put(`${API_BASE_URL}tags/${this.currentTag.id}`, this.currentTag, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        this.fetchTags();
        this.showEditModal = false;
        this.$toast.success(response.data.message);
      } catch (error) {
        console.error('Error updating tag:', error);
        this.$toast.error('Failed to update tag'); // Display error message
      }
    },

    // Delete a tag
    async deleteTag(tagId) {
      try {
        await axios.delete(`${API_BASE_URL}tags/${tagId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        this.tags = this.tags.filter(tag => tag.id !== tagId); // Remove tag from the list
        this.$toast.success('Tag deleted successfully'); // Display success message
      } catch (error) {
        console.error('Error deleting tag:', error);
        this.$toast.error('Failed to delete tag'); // Display error message
      }
    },
  },
};
</script>

<style scoped>
@media (max-width: 768px) {
  .ml-56 {
    margin-left: 0;
  }
  .w-56 {
    width: 100%;
  }
  .flex-1 {
    margin-left: 0;
  }
}
</style>
