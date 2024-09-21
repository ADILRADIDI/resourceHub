<template>
  <div class="app-container">
    <div class="mb-6">
      <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-600 animate-pulse">
        {{ categoryName }} Resources
      </h1>
    </div>
    <div class="flex items-center mb-8">
      <form class="w-full max-w-lg mx-auto" @submit.prevent="handleSearch">
        <div class="relative">
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
import { ref, computed, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const resources = ref([]);
const searchQuery = ref('');
const route = useRoute();
const selectedCategory = computed(() => parseInt(route.params.categoryId));

const categoryName = computed(() => {
  const categoryMap = {
    4: 'Accessibility',
    5: 'AI',
    // Add mappings for other category IDs
  };
  return categoryMap[selectedCategory.value] || 'All Categories';
});


const fetchResources = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/resources', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    });
    resources.value = response.data.filter(resource => resource.category_id === selectedCategory.value);
    console.log(resources.value);
  } catch (error) {
    console.error('Error fetching resources:', error);
  }
};


onMounted(fetchResources);

const filteredResources = computed(() => {
  if (!searchQuery.value) return resources.value;
  return resources.value.filter(resource =>
    resource.title.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
    resource.description.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

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
