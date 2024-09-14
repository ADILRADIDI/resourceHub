<template>
    <div class="mx-20 mt-20">
      <h1 class="mb-5 font-bold text-2xl">Manage Podcasts</h1>
  
      <!-- Add Podcast Button -->
      <button @click="showAddModal = true" class="mb-5 px-4 py-2 bg-blue-500 text-white rounded-lg">
        Add Podcast
      </button>
  
      <!-- Podcasts Table -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <!-- <th scope="col" class="px-6 py-3">Logo</th> -->
              <!-- <th scope="col" class="px-6 py-3">Audio</th> -->
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="podcast in podcasts" :key="podcast.id" class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700">
              <td class="px-6 py-4">{{ podcast.id }}</td>
              <td class="px-6 py-4">{{ podcast.title }}</td>
              <td class="px-6 py-4">{{ podcast.description }}</td>
              <!-- <td class="px-6 py-4">
                <img :src="podcast.logo" alt="Podcast Logo" class="h-10 w-10 object-cover">
              </td> -->
              <!-- <td class="px-6 py-4">
                <audio controls>
                  <source :src="podcast.audio_url" type="audio/mpeg">
                  Your browser does not support the audio element.
                </audio>
              </td> -->
              <td class="px-6 py-4">{{ podcast.status }}</td>
              <td class="px-6 py-4">
                <button @click="editPodcast(podcast)" class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                  Edit
                </button>
                <button @click="deletePodcast(podcast.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Add Podcast Modal -->
      <AddPodcastModal :isOpen="showAddModal" @close="showAddModal = false" @added="fetchPodcasts" />
  
      <!-- Edit Podcast Modal -->
      <EditPodcastModal :isOpen="showEditModal" :podcast="currentPodcast" @close="showEditModal = false" @updated="fetchPodcasts" />
    </div>
  </template>
  
  <script>
  import AddPodcastModal from "@/components/AdminComponents/AddPodcastModal.vue";
  import EditPodcastModal from "@/components/AdminComponents/EditPodcastModal.vue";
  
  export default {
    components: {
      AddPodcastModal,
      EditPodcastModal,
    },
    data() {
      return {
        podcasts: [
          {
            id: 1,
            title: 'Tech Innovations',
            description: 'Exploring the latest in technology and innovation.',
            logo: 'path/to/logo1.png',
            audio_url: 'path/to/audio1.mp3',
            status: 'draft',
            created_at: '2024-09-03 22:37:39',
            updated_at: '2024-09-03 22:37:39',
          },
          {
            id: 2,
            title: 'Health and Wellness',
            description: 'Tips and advice for a healthier lifestyle.',
            logo: 'path/to/logo2.png',
            audio_url: 'path/to/audio2.mp3',
            status: 'draft',
            created_at: '2024-09-03',
            updated_at: '2024-09-03',
          },
          // Add more static podcasts here
        ],
        showAddModal: false,
        showEditModal: false,
        currentPodcast: null,
      };
    },
    methods: {
      editPodcast(podcast) {
        this.currentPodcast = { ...podcast };
        this.showEditModal = true;
      },
      deletePodcast(podcastId) {
        this.podcasts = this.podcasts.filter(podcast => podcast.id !== podcastId);
      },
      fetchPodcasts() {
        // Fetch podcasts from the server (for now, static data)
        console.log("Fetching podcasts...");
      },
    },
  };
  </script>
  