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
                <button @click="viewDetails(podcast)" class="text-blue-600 dark:text-blue-500 hover:underline">View Details</button>
                <button @click="publishPodcast(podcast)" class="text-green-600 hover:underline">Publish</button>
                <button @click="archivePodcast(podcast)" class="text-red-600 hover:underline">Archive</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Podcast Details Modal -->
      <div v-if="showDetailsModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-xl font-semibold mb-4">Podcast Details</h3>
          <p><strong>ID:</strong> {{ currentPodcast.id }}</p>
          <p><strong>Title:</strong> {{ currentPodcast.title }}</p>
          <p><strong>Description:</strong> {{ currentPodcast.description }}</p>
          <p><strong>Logo:</strong> <img :src="currentPodcast.logo" alt="Podcast Logo" class="w-20 h-20"/></p>
          <p><strong>Audio URL:</strong> <a :href="currentPodcast.audio_url" target="_blank" class="text-blue-600 hover:underline">{{ currentPodcast.audio_url }}</a></p>
          <p><strong>Status:</strong> {{ currentPodcast.status }}</p>
          <p><strong>Created At:</strong> {{ currentPodcast.created_at }}</p>
          <p><strong>Updated At:</strong> {{ currentPodcast.updated_at }}</p>
  
          <div class="flex justify-end mt-4">
            <button @click="closeDetailsModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Close</button>
          </div>
        </div>
      </div>
    </div>
  </template>
<script>
export default {
  data() {
    return {
      podcasts: [
        {
          id: 17,
          title: 'pofffsss',
          description: 'ExploringsssPodcastsddss',
          logo: 'uploads/logos/Zco3s6lQ4N1xfAYwQ0rILw1bPIxTvXAX38WA...',
          audio_url: null, // Add actual audio URL
          status: 'draft',
          created_at: '2024-09-03 22:37:29',
          updated_at: '2024-09-03 22:37:29',
        },
        // Additional podcast objects...
      ],
      showDetailsModal: false,
      currentPodcast: {}
    };
  },
  methods: {
    viewDetails(podcast) {
      this.currentPodcast = podcast;
      this.showDetailsModal = true;
    },
    closeDetailsModal() {
      this.showDetailsModal = false;
      this.currentPodcast = {};
    },
    publishPodcast(podcast) {
      if (podcast.status !== 'published') {
        podcast.status = 'published';
        alert(`Podcast "${podcast.title}" has been published.`);
      } else {
        alert(`Podcast "${podcast.title}" is already published.`);
      }
    },
    archivePodcast(podcast) {
      if (podcast.status !== 'archived') {
        podcast.status = 'archived';
        alert(`Podcast "${podcast.title}" has been archived.`);
      } else {
        alert(`Podcast "${podcast.title}" is already archived.`);
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
  