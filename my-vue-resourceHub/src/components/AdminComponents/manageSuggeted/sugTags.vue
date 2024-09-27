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
                <button @click="viewDetails(tag)" class="text-blue-600 dark:text-blue-500 hover:underline">View Details</button>
                <button @click="editTag(tag)" class="text-yellow-600 hover:underline">Edit</button>
                <button @click="deleteTag(tag)" class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Tag Details Modal -->
      <div v-if="showDetailsModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-xl font-semibold mb-4">Tag Details</h3>
          <p><strong>ID:</strong> {{ currentTag.id }}</p>
          <p><strong>Name:</strong> {{ currentTag.name }}</p>
          <p><strong>Status:</strong> {{ currentTag.status }}</p>
          <p><strong>Created At:</strong> {{ currentTag.created_at }}</p>
  
          <div class="flex justify-end mt-4">
            <button @click="closeDetailsModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Close</button>
          </div>
        </div>
      </div>
  
      <!-- Edit Tag Modal -->
      <div v-if="showEditModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-xl font-semibold mb-4">Edit Tag</h3>
          <form @submit.prevent="updateTag">
            <div class="mb-4">
              <label for="tag-name" class="block text-gray-700">Tag Name</label>
              <input v-model="currentTag.name" id="tag-name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="tag-status" class="block text-gray-700">Status</label>
              <select v-model="currentTag.status" id="tag-status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
              </select>
            </div>
            <div class="flex justify-end">
              <button type="button" @click="closeEditModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
              <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
<script>
export default {
  data() {
    return {
      tags: [
        {
          id: 1,
          name: 'laravel',
          status: 'draft',
          created_at: '2024-09-03 22:37:29',
        },
        {
          id: 1,
          name: 'python',
          status: 'draft',
          created_at: '2024-09-03 22:37:29',
        },
      ],
      showDetailsModal: false,
      showEditModal: false,
      currentTag: {}
    };
  },
  methods: {
    viewDetails(tag) {
      this.currentTag = tag;
      this.showDetailsModal = true;
    },
    closeDetailsModal() {
      this.showDetailsModal = false;
      this.currentTag = {};
    },
    editTag(tag) {
      this.currentTag = { ...tag };
      this.showEditModal = true;
    },
    closeEditModal() {
      this.showEditModal = false;
      this.currentTag = {};
    },
    updateTag() {
      const index = this.tags.findIndex(t => t.id === this.currentTag.id);
      if (index !== -1) {
        this.tags.splice(index, 1, { ...this.currentTag });
        this.closeEditModal();
      }
    },
    deleteTag(tag) {
      this.tags = this.tags.filter(t => t.id !== tag.id);
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
  