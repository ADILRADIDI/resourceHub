<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '../config';

// State to store YouTube channels
const channels = ref([]);

// State for search query
const searchQuery = ref('');
const showSuggestForm = ref(false); // State to control the visibility of the form

// Form data for suggesting a new channel
const newChannelName = ref('');
const newChannelUrl = ref('');

// Get the token from localStorage (or replace with your method)
const token = localStorage.getItem('user-token');

// Axios instance with default headers for the token
const axiosInstance = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    Authorization: `Bearer ${token}`,
  },
});

// Fetch YouTube channels when the component is mounted
const fetchChannels = async () => {
  try {
    const response = await axiosInstance.get('youtubeChannels');
    channels.value = response.data;
  } catch (error) {
    console.error('Error fetching channels:', error);
  }
};

// Filtered channels based on the search query
const filteredChannels = computed(() => {
  return channels.value.filter(channel =>
    searchQuery.value === '' || channel.channel_name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Suggest a new YouTube channel
const suggestChannel = async () => {
  if (newChannelName.value && newChannelUrl.value) {
    try {
      const newChannel = {
        channel_name: newChannelName.value,
        channel_url: newChannelUrl.value,
      };

      const response = await axiosInstance.post('/suggested-yt-channels', newChannel);

      // Add the new suggested channel to the list
      channels.value.push(response.data);

      // Reset the form
      newChannelName.value = '';
      newChannelUrl.value = '';
      showSuggestForm.value = false; // Hide the form after submission
    } catch (error) {
      console.error('Error suggesting channel:', error);
    }
  }
};

// Fetch channels when the component is mounted
onMounted(() => {
  fetchChannels();
});
</script>

<template>
  <div class="ytchannels-page container mx-auto py-8">
    <div class="mb-6">
      <h1 class="text-4xl font-bold flex items-center justify-center my-5 text-blue-300 animate-pulse">
        YouTube Channels
      </h1>
    </div>

    <!-- Search Bar -->
    <div class="search-bar mb-6 flex items-center justify-between gap-3">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search for a channel"
        class="p-2 border rounded-lg flex-grow"
      />
      <button
        @click="showSuggestForm = !showSuggestForm"
        class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-lg"
      >
        {{ showSuggestForm ? 'Hide Suggest' : 'Suggest a YT-Channel' }}
      </button>
    </div>

    <!-- Suggest a Channel Form -->
    <div v-if="showSuggestForm" class="modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50">
      <div class="modal-content bg-white p-6 rounded-lg w-11/12 max-w-md relative">
        <button @click="showSuggestForm = false" class="absolute top-2 right-2 text-black text-2xl">
          <span class="material-symbols-outlined">close</span>
        </button>
        <h2 class="text-xl font-semibold mb-4">Suggest a YouTube Channel</h2>
        <div class="mb-4">
          <input
            v-model="newChannelName"
            type="text"
            placeholder="Channel Name"
            class="w-full p-2 border rounded-lg"
          />
        </div>
        <div class="mb-4">
          <input
            v-model="newChannelUrl"
            type="url"
            placeholder="Channel URL"
            class="w-full p-2 border rounded-lg"
          />
        </div>
        <button
          @click="suggestChannel"
          class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
        >
          Suggest Channel
        </button>
      </div>
    </div>

    <!-- Channels List -->
    <div class="channels-list grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="channel in filteredChannels" :key="channel.id" class="p-4 border rounded-lg shadow-md">
        <h3 class="text-xl font-semibold mb-5">{{ channel.channel_name }}</h3>
        <a :href="channel.channel_url" target="_blank" class="text-blue-500 underline">Visit Channel</a>
      </div>
    </div>
  </div>
</template>

<style scoped>
.modal {
  backdrop-filter: blur(5px);
}

.modal-content {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
