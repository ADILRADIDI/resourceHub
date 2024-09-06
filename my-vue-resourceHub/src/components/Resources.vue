<template>
    <div class="app-container">
      <!-- Search Bar -->
      <div class="mb-6">
        <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-600 animate-pulse">
          DEV Resources
        </h1>
      </div>
      <div class="flex items-center mb-8">
        <router-link to="/">
            <button class="mr-4 text-black ml-10">
                <span class="material-symbols-outlined">keyboard_return</span>
            </button>
        </router-link>
        <form class="w-full max-w-lg mx-auto" @submit.prevent="handleSearch">
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg
                class="w-5 h-5 text-gray-400"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
            </div>
            <input
              type="search"
              id="default-search"
              class="block w-full py-3 pl-12 pr-4 text-sm text-gray-200 bg-gray-900 border border-gray-700 rounded-full focus:ring-blue-500 focus:border-blue-500"
              placeholder="Search resources..."
              v-model="searchQuery"
              required
            />
            <button
              type="submit"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-full text-sm px-4 py-2"
            >
              Search
            </button>
          </div>
        </form>
      </div>
  
      <!-- Resources Grid -->
      <div class="resources">
        <div
          class="resource-card"
          v-for="resource in filteredResources"
          :key="resource.id"
          @click="openResource(resource.url)"
        >
          <img :src="resource.image" :alt="resource.title" />
          <div class="resource-content">
            <h2>{{ resource.title }}</h2>
            <p>{{ resource.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
import { ref, computed } from 'vue';

// Sample Resources Data
const resources = ref([
  {
    id: 1,
    image: 'https://devresourc.es/_next/image?url=https%3A%2F%2Fres.cloudinary.com%2Fdev-resources%2Fimage%2Fupload%2Fresources%2Fscreenshots%2F9797c202-78a4-443b-af29-e632a45cd574.png&w=1200&q=75',
    title: 'Resource One',
    description: 'Description for resource one.',
    url: 'https://example.com/resource-one',
  },
  {
    id: 1,
    image: 'https://devresourc.es/_next/image?url=https%3A%2F%2Fres.cloudinary.com%2Fdev-resources%2Fimage%2Fupload%2Fresources%2Fscreenshots%2F9797c202-78a4-443b-af29-e632a45cd574.png&w=1200&q=75',
    title: 'Resource One',
    description: 'Description pp resource one.',
    url: 'https://example.com/resource-one',
  },
  {
    id: 1,
    image: 'https://devresourc.es/_next/image?url=https%3A%2F%2Fres.cloudinary.com%2Fdev-resources%2Fimage%2Fupload%2Fresources%2Fscreenshots%2F9797c202-78a4-443b-af29-e632a45cd574.png&w=1200&q=75',
    title: 'Resource One',
    description: 'Description mm resource one.',
    url: 'https://example.com/resource-one',
  },
  {
    id: 1,
    image: 'https://devresourc.es/_next/image?url=https%3A%2F%2Fres.cloudinary.com%2Fdev-resources%2Fimage%2Fupload%2Fresources%2Fscreenshots%2F9797c202-78a4-443b-af29-e632a45cd574.png&w=1200&q=75',
    title: 'Resource One',
    description: 'Description hh resource one.',
    url: 'https://example.com/resource-one',
  },
  {
    id: 1,
    image: 'https://devresourc.es/_next/image?url=https%3A%2F%2Fres.cloudinary.com%2Fdev-resources%2Fimage%2Fupload%2Fresources%2Fscreenshots%2F9797c202-78a4-443b-af29-e632a45cd574.png&w=1200&q=75',
    title: 'Resource gg',
    description: 'Description for resource one.',
    url: 'https://example.com/resource-one',
  },
  // Add more resources as needed
]);

const searchQuery = ref('');

// Computed property for filtered resources based on search query
const filteredResources = computed(() => {
  if (!searchQuery.value) return resources.value;
  return resources.value.filter((resource) =>
    resource.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    resource.description.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Method to handle search form submission
const handleSearch = () => {
  // The filteredResources computed property already handles the filtering
  // Additional logic can be added here if needed
};

// Method to open resource URL in a new tab
const openResource = (url) => {
  window.open(url, '_blank');
};
</script>

<style>
/* Import Fonts */
@import url('https://fonts.googleapis.com/css?family=Lato:100,300,400,700');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

/* Reset and Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


.app-container {
  height: 100%;
  font-family: 'Lato', sans-serif;
  background-color: #1a1a1a;
  color: #000000;
}

/* Container */
.app-container {
  min-height: 100vh;
  padding: 40px 20px;
}

/* Resources Grid */
.resources {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}

.resource-card {
  background-color: #24292e;
  border-radius: 12px;
  overflow: hidden;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
  height: 45vh;
}

.resource-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
}

.resource-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-bottom: 2px solid #444;
}

.resource-content {
  padding: 15px;
}

.resource-card h2 {
  font-size: 1.25rem;
  margin-bottom: 10px;
  color: #e6e6e6;
}

.resource-card p {
  font-size: 0.95rem;
  color: #ccc;
}

/* Responsive Adjustments */
@media (max-width: 600px) {
  .resource-card h2 {
    font-size: 1.1rem;
  }

  .resource-card p {
    font-size: 0.9rem;
  }
}
</style>
