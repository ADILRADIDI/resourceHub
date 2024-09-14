<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-gray-900 opacity-60" @click="$emit('close')"></div>
      <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Add New Resource</h2>
        <form @submit.prevent="addResource">
          <!-- Title -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input v-model="resource.title" type="text" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          </div>
            <!-- Image Upload -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Image Upload</label>
          <input
            type="file"
            @change="handleImageUpload"
            class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
        </div>
          <!-- Body -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Body</label>
            <textarea v-model="resource.body" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
          </div>
          <!-- URL -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Resource URL</label>
            <input v-model="resource.url" type="text" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
          </div>
          <!-- Status -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select v-model="resource.status" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
            </select>
          </div>
          <!-- Submit -->
          <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Resource</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      isOpen: {
        type: Boolean,
        required: true
      }
    },
    data() {
      return {
        resource: {
          title: '',
          image: '',
          body: '',
          image: null, // Updated to hold file object
          status: 'published'
        }
      };
    },
    methods: {
      async addResource() {
        // Here you'd typically call your API to add the resource
        // For example:
        // await axios.post('/api/resources', this.resource);
        // After successful post, emit the 'added' event
        this.$emit('added');
        this.$emit('close');
      }
    }
  };
  </script>
  