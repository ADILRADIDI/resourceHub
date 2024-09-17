<template>
  <div class="app-container">
    <!-- Search Bar -->
    <div class="mb-6">
      <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-600 animate-pulse">
        {{ categoryName }} Resources
      </h1>
    </div>
    <div class="flex items-center mb-8">
      <form class="w-full max-w-lg mx-auto" @submit.prevent="handleSearch">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
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
    <div class="resources grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        class="resource-card"
        v-for="resource in filteredResources"
        :key="resource.id"
      >
        <img :src="resource.image" :alt="resource.title" class="resource-image" />
        <div class="resource-content">
          <h2 class="text-xl font-semibold mb-2">{{ resource.title }}</h2>
          <p class="text-gray-600 mb-4">{{ resource.description }}</p>
          <button
            class="visit-button bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-full px-4 py-2"
            @click="openResource(resource.url)"
          >
            Visit Now
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script setup>
import { ref, computed } from 'vue';
import { useRoute } from 'vue-router';

// Static Resources Data
const resources = ref({
  webdev: [
    {
      id: 1,
      title: 'Vue.js Documentation',
      description: 'Official Vue.js documentation for getting started with Vue.',
      image: 'https://vuejs.org/images/logo.png',
      url: 'https://vuejs.org/',
    },
    {
      id: 3,
      title: 'Tailwind CSS Documentation',
      description: 'Comprehensive guide for Tailwind CSS.',
      image: 'https://vuejs.org/images/logo.png',
      url: 'https://tailwindcss.com/docs',
    },
    {
      id: 3,
      title: 'Tailwind CSS Documentation',
      description: 'Comprehensive guide for Tailwind CSS.',
      image: 'https://vuejs.org/images/logo.png',
      url: 'https://tailwindcss.com/docs',
    },
    {
      id: 3,
      title: 'Tailwind CSS Documentation',
      description: 'Comprehensive guide for Tailwind CSS.',
      image: 'https://vuejs.org/images/logo.png',
      url: 'https://tailwindcss.com/docs',
    },
    {
      id: 3,
      title: 'Tailwind CSS Documentation',
      description: 'Comprehensive guide for Tailwind CSS.',
      image: 'https://vuejs.org/images/logo.png',
      url: 'https://tailwindcss.com/docs',
    },
  ],
  php: [
    {
      id: 2,
      title: 'Laravel Documentation',
      description: 'Official Laravel documentation for learning Laravel framework.',
      image: 'https://laravel.com/img/logotype.min.svg',
      url: 'https://laravel.com/docs',
    },
  ],
  javascript: [
    {
      id: 2,
      title: 'javascript Documentation',
      description: 'Official Laravel documentation for learning Laravel framework.',
      image: 'https://laravel.com/img/logotype.min.svg',
      url: 'https://laravel.com/docs',
    },
  ],
});

const searchQuery = ref('');
const route = useRoute();
const selectedCategory = computed(() => route.params.category);
const categoryName = computed(() => {
  switch (selectedCategory.value) {
    case 'webdev':
      return 'Web Development';
    case 'php':
      return 'PHP';
    case 'javascript':
      return 'Javascript';
    default:
      return 'All Categories';
  }
});

// Computed property for filtered resources based on search query and category
const filteredResources = computed(() => {
  const categoryResources = resources.value[selectedCategory.value] || [];
  if (!searchQuery.value) return categoryResources;
  return categoryResources.filter(resource =>
    resource.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    resource.description.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

// Method to handle search form submission
const handleSearch = () => {
  // The filteredResources computed property already handles the filtering
};

// Method to open resource URL in a new tab
const openResource = (url) => {
  window.open(url, '_blank');
};
</script>

<style scoped>
.resource-card {
  cursor: pointer;
  border: 1px solid #ddd;
  border-radius: 12px;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.resource-card:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}
.resource-image {
  width: 100%;
  height: 150px;
  object-fit: cover;
}
.resource-content {
  padding: 1rem;
}
.visit-button {
  transition: background-color 0.3s;
}
.visit-button:hover {
  background-color: #1d4ed8; /* Darker blue for hover effect */
}
</style>
