<!-- AddPodcastModal.vue -->
<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-gray-900 opacity-60" @click="$emit('close')"></div>
      <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Add New Podcast</h2>
        <form @submit.prevent="addPodcast">
          <!-- Podcast Title -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input v-model="podcast.title" type="text" class="p-3 border border-gray-300 rounded-lg w-full" required />
          </div>
          <!-- Podcast Description -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea v-model="podcast.description" class="p-3 border border-gray-300 rounded-lg w-full" required></textarea>
          </div>
          <!-- Logo File -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
            <input type="file" @change="handleLogoUpload" class="p-3 border border-gray-300 rounded-lg w-full" />
          </div>
          <!-- Audio File -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Audio</label>
            <input type="file" @change="handleAudioUpload" class="p-3 border border-gray-300 rounded-lg w-full" />
          </div>
          <!-- Status -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select v-model="podcast.status" class="p-3 border border-gray-300 rounded-lg w-full" required>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
            </select>
          </div>
          <!-- Submit -->
          <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Podcast</button>
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
        required: true,
      },
    },
    data() {
      return {
        podcast: {
          title: "",
          description: "",
          logo: null,
          audio: null,
          status: "draft",
        },
      };
    },
    methods: {
      handleLogoUpload(event) {
        this.podcast.logo = event.target.files[0];
      },
      handleAudioUpload(event) {
        this.podcast.audio = event.target.files[0];
      },
      async addPodcast() {
        const formData = new FormData();
        formData.append('title', this.podcast.title);
        formData.append('description', this.podcast.description);
        formData.append('logo', this.podcast.logo);
        formData.append('audio', this.podcast.audio);
        formData.append('status', this.podcast.status);
        
        try {
          // Replace with your API endpoint
          await axios.post('/api/podcasts', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          });
          this.$emit("added");
          this.$emit("close");
        } catch (error) {
          console.error("Failed to add podcast", error);
        }
      },
    },
  };
  </script>
  