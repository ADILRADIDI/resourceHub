<template>
  <div class="ad-container">
    <div v-if="loading">Loading ads...</div>
    <div v-if="errorMessage">{{ errorMessage }}</div>
    <div v-for="ad in ads" :key="ad.id" class="ad-item mt-5 mb-5 mx-3">
      <img :src="ad.image_url || 'path/to/placeholder-image.png'" :alt="ad.title" class="ad-image">
      <div class="ad-content">
        <h3 class="ad-heading">{{ ad.title }}</h3>
        <p class="ad-text">{{ ad.description }}</p>
        <a :href="ad.url" class="ad-button">Get Now</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '@/config'; // Adjust this path as necessary

const ads = ref([]);
const loading = ref(true);
const errorMessage = ref(null);

// Fetch ads from the API
const fetchAds = async () => {
  loading.value = true;
  errorMessage.value = null;
  
  const token = localStorage.getItem('user-token');

  try {
    const response = await axios.get(`${API_BASE_URL}ads`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });

    // Log the fetched ads
    console.log("Fetched ads:", response.data);

    // Remove duplicates based on ad id
    const uniqueAds = response.data.filter((ad, index, self) =>
      index === self.findIndex((a) => a.id === ad.id)
    );

    ads.value = uniqueAds;
  } catch (error) {
    console.error('Error fetching ads:', error);
    errorMessage.value = 'Failed to fetch ads. Please try again.';
  } finally {
    loading.value = false;
  }
};

// Run the fetch function on component mount
onMounted(fetchAds);
</script>

<style scoped>
.ad-container {
  gap: 1rem;
  margin: 2rem auto;
  max-width: 1200px;
}

.ad-item {
  display: flex;
  flex-direction: column;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  overflow: hidden;
  background-color: #ffffff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.ad-image {
  width: 100%;
  height: auto;
}

.ad-content {
  padding: 1rem;
}

.ad-heading {
  font-size: 1.25rem;
  font-weight: bold;
  color: #1f2937;
}

.ad-text {
  font-size: 1rem;
  color: #4b5563;
  margin: 0.5rem 0;
}

.ad-button {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  font-weight: bold;
  color: #ffffff;
  background-color: #3b82f6;
  border-radius: 0.375rem;
  text-align: center;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.ad-button:hover {
  background-color: #2563eb;
  transform: scale(1.05);
}

@media (min-width: 768px) {
  .ad-container {
    flex-direction: row;
    flex-wrap: wrap;
    gap: 1.5rem;
  }
  .ad-item {
    flex: 1;
    max-width: 100%;
  }
}
</style>
