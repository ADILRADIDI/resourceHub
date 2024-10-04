<template>
  <div class="container mx-auto px-4 py-6 bg-gray-100">
    <!-- Welcome Section -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-blue-600 mt-10 mb-20">Welcome to RDEV Admin Panel</h1>
    </div>

    <!-- Key Metrics Section -->
    <h1 class="text-3xl mb-3 font-mono">-> Accepted</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Active Section -->
      <div class="p-6 bg-white rounded-xl animate__animated animate__fadeIn animate__delay-1s shadow-2xl text-black hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Posts (Active)</h2>
        <p class="text-2xl mt-2">{{ totalPosts }}</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-2s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Podcasts (Active)</h2>
        <p class="text-2xl mt-2">{{ totalPodcasts }}</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-3s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Events (Active)</h2>
        <p class="text-2xl mt-2">{{ totalEvents }}</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-4s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Tags (Active)</h2>
        <p class="text-2xl mt-2">{{ totalTags }}</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-5s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total YouTube Channels (Active)</h2>
        <p class="text-2xl mt-2">{{ totalYouTubeChannels }}</p>
      </div>
    </div>

    <h1 class="text-3xl mb-3 font-mono mt-20">-> Not Accepted</h1>
    <!-- Not Accepted Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
      <div class="p-6 bg-red-100 rounded-xl animate__animated animate__fadeIn animate__delay-1s shadow-2xl text-black hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Posts (Not Accepted)</h2>
        <p class="text-2xl mt-2">{{ draftPosts }}</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-2s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Podcasts (Not Accepted)</h2>
        <p class="text-2xl mt-2">{{ draftPodcasts }}</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-3s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Events (Not Accepted)</h2>
        <p class="text-2xl mt-2">{{ draftEvents }}</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-4s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Tags (Not Accepted)</h2>
        <p class="text-2xl mt-2">{{ draftTags }}</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-5s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total YouTube Channels (Not Accepted)</h2>
        <p class="text-2xl mt-2">{{ draftYouTubeChannels }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '@/config';

// Define reactive variables to store data
const totalPosts = ref(0);
const totalPodcasts = ref(0);
const totalEvents = ref(0);
const totalTags = ref(0);
const totalYouTubeChannels = ref(0);

const draftPosts = ref(0);
const draftPodcasts = ref(0);
const draftEvents = ref(0);
const draftTags = ref(0);
const draftYouTubeChannels = ref(0);

// Fetch data when the component is mounted
onMounted(() => {
  // Fetch total active items
  axios.get(`${ API_BASE_URL }getTotalPosts`)
    .then(response => {
      totalPosts.value = response.data.total_posts;
      totalPodcasts.value = response.data.total_podcasts;
      totalEvents.value = response.data.total_events;
      totalTags.value = response.data.total_tag;
      totalYouTubeChannels.value = response.data.total_youTubeChannel;
    })
    .catch(error => {
      console.error("Error fetching total posts:", error);
    });

  // Fetch total draft items
  axios.get(`${ API_BASE_URL }getDraftItems`)
    .then(response => {
      draftPosts.value = response.data.draft_posts;
      draftPodcasts.value = response.data.draft_podcasts;
      draftEvents.value = response.data.draft_events;
      draftTags.value = response.data.draft_tags;
      draftYouTubeChannels.value = response.data.draft_youTubeChannels;
    })
    .catch(error => {
      console.error("Error fetching draft items:", error);
    });
});
</script>

<style scoped>
</style>
