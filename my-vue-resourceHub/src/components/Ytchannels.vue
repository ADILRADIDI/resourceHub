<script setup>
import { ref, computed } from 'vue'; // Ensure computed is imported

// Sample data for YouTube channels
const channels = ref([
  { id: 1, channel_name: 'Frontend Mastery', channel_url: 'https://www.youtube.com/channel/UC1', category: 'Front-end Dev' },
  { id: 2, channel_name: 'Backend Experts', channel_url: 'https://www.youtube.com/channel/UC2', category: 'Back-end Dev' },
  { id: 3, channel_name: 'Cloud Gurus', channel_url: 'https://www.youtube.com/channel/UC3', category: 'Cloud Computing' },
  { id: 4, channel_name: 'Full-Stack Overflow', channel_url: 'https://www.youtube.com/channel/UC4', category: 'Full-stack Dev' },
  { id: 5, channel_name: 'Machine Learning Masters', channel_url: 'https://www.youtube.com/channel/UC5', category: 'Machine Learning' },
  { id: 6, channel_name: 'Code with Aymen', channel_url: 'https://www.youtube.com/channel/UC6', category: 'Front-end Dev' },
  { id: 7, channel_name: 'Ninja Masters', channel_url: 'https://www.youtube.com/channel/UC7', category: 'Front-end Dev' },
]);

const categories = ref([
  'Front-end Dev',
  'Back-end Dev',
  'Cloud Computing',
  'Full-stack Dev',
  'Machine Learning',
  'Devops & Big Data',
  'Mobile Dev',
  'Cybersecurity',
  'UI/UX Design'
]);

const selectedCategory = ref('');
const searchQuery = ref('');
const showSuggestForm = ref(false); // State to control the visibility of the form

const filteredChannels = computed(() => {
  return channels.value.filter(channel => {
    return (
      (selectedCategory.value === '' || channel.category === selectedCategory.value) &&
      (searchQuery.value === '' || channel.channel_name.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
  });
});

const newChannelName = ref('');
const newChannelUrl = ref('');
const newChannelCategory = ref('');

const suggestChannel = () => {
  if (newChannelName.value && newChannelUrl.value && newChannelCategory.value) {
    const newId = channels.value.length + 1;
    channels.value.push({
      id: newId,
      channel_name: newChannelName.value,
      channel_url: newChannelUrl.value,
      category: newChannelCategory.value,
    });

    // Reset form
    newChannelName.value = '';
    newChannelUrl.value = '';
    newChannelCategory.value = '';
    
    // Hide the form after submission
    showSuggestForm.value = false;
  }
};
</script>

<template>
  <div class="ytchannels-page container mx-auto py-8">
    <!-- Title -->
    <!-- <h1 class="text-3xl font-bold mb-6 text-center">YouTube Channels</h1> -->
    <div class="mb-6">
        <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-300 animate-pulse">
          YouTube Channels
        </h1>
      </div>
    <!-- Button to show/hide Suggest a Channel Form -->
    <button 
      @click="showSuggestForm = !showSuggestForm" 
      class="mb-4 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-lg">
      {{ showSuggestForm ? 'Hide Suggest Form' : 'Suggest a YouTube Channel' }}
    </button>

    <!-- Suggest a Channel Form -->
    <div v-if="showSuggestForm" class="suggest-channel-form mb-8 p-4 border rounded-lg shadow-lg bg-white">
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
      <div class="mb-4">
        <select v-model="newChannelCategory" class="w-full p-2 border rounded-lg">
          <option disabled value="">Select a Category</option>
          <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
        </select>
      </div>
      <button
        @click="suggestChannel"
        class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
      >
        Suggest Channel
      </button>
    </div>

    <!-- Search Bar -->
    <div class="search-bar mb-6 flex justify-between">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search for a channel"
        class="p-2 border rounded-lg flex-grow mr-4"
      />
      <select v-model="selectedCategory" class="p-2 border rounded-lg">
        <option value="">All Categories</option>
        <option v-for="category in categories" :key="category" :value="category">{{ category }}</option>
      </select>
    </div>

    <!-- Channels List -->
    <div class="channels-list grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="channel in filteredChannels" :key="channel.id" class="channel-card p-4 border rounded-lg shadow-lg bg-white">
        <h3 class="font-semibold text-lg text-red-500">{{ channel.channel_name }}</h3>
        <a :href="channel.channel_url" target="_blank" class="text-blue-600 underline">Visit Channel</a>
        <p class="text-sm text-gray-500 mt-2">{{ channel.category }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.ytchannels-page {
  max-width: 1200px;
}

.suggest-channel-form {
  margin-bottom: 2rem;
}

.search-bar {
  margin-bottom: 2rem;
}

.channel-card {
  background-color: #ffffff;
  padding: 1.5rem;
  border: 1px solid #e2e8f0;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.channel-card h3 {
  color: #e3342f; /* Red color */
}
</style>
