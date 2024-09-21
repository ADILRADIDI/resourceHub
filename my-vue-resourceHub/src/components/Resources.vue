<template>
  <div class="app-container">
    <div class="mb-16">
      <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-600 animate-pulse">
        {{ categoryName }} Resources
      </h1>
    </div>

    <!-- Display resources by selected category -->
    <div v-if="selectedCategory">
      <div class="resources grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          class="resource-card"
          v-for="(resource, index) in filteredResources"
          :key="index"
          @click="openResource(resource.url)"
        >
          <img :src="resource.image_url" :alt="resource.title" class="resource-image" />
          <div class="resource-content">
            <h3 class="text-xl font-semibold mb-2">{{ resource.title }}</h3>
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

    <!-- Display all categories for selection -->
    <div v-else>
      <h2 class="text-2xl font-semibold mb-4">Categories</h2>
      <ul class="flex flex-wrap gap-4">
        <li
          v-for="(category, index) in categories"
          :key="index"
          @click="selectCategory(category)"
          class="cursor-pointer bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md"
        >
          {{ category.name }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';
import { API_BASE_URL } from '@/config';

// Define state variables
const resources = ref([]);
const route = useRoute();
const router = useRouter();
const selectedCategory = computed(() => route.params.category);

// Category name mapping based on category ID
const categoryMap = {
  'accessibility': 'Accessibility',
  'ai': 'AI',
  'analytics': 'Analytics',
  'animation': 'Animation',
  'api-building': 'API Building',
  'audio': 'Audio',
  'authentication': 'Authentication',
  'blog': 'Blog',
  'book': 'Book',
  'browser': 'Browser',
  'cdn': 'CDN',
  'cheatsheet': 'Cheatsheet',
  'cloud-computing': 'Cloud Computing',
  'code-challenge': 'Code Challenge',
  'code-generator': 'Code Generator',
  'code-snippet': 'Code Snippet',
  'color': 'Color',
  'conference': 'Conference',
  'database': 'Database',
  'design': 'Design',
  'documentation': 'Documentation'
};

const categoryName = computed(() => categoryMap[selectedCategory.value]);
const token = localStorage.getItem('user-token');

// Fetch resources from the API
const fetchResources = async () => {
  try {
    const response = await axios.get(`${API_BASE_URL}resources`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    resources.value = response.data;
    console.log('Fetched Resources:', response.data);
  } catch (error) {
    console.error('Error fetching resources:', error);
  }
};

// Run the fetch function on component mount
onMounted(fetchResources);

// Filter resources by selected category
const filteredResources = computed(() => {
  if (!resources.value || resources.value.length === 0) return [];

  return resources.value.filter(resource => resource.category.slug === selectedCategory.value);
});

// Open resource link in a new tab
const openResource = (url) => {
  window.open(url, '_blank');
};

// List of all categories
const categories = computed(() => {
  return Object.keys(categoryMap).map(key => ({
    slug: key,
    name: categoryMap[key]
  }));
});

// Function to select a category
const selectCategory = (category) => {
  // Navigate to selected category route
  router.push({ name: 'category', params: { category: category.slug } });
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
