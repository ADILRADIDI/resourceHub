<template>
  <div>
    <div class="tags-component mx-8">
      <div class="flex items-center justify-between mx-5 mb-6">
        <h1 class="text-4xl font-bold text-blue-700 animate-pulse">Tags</h1>
        <button 
          @click="showSuggestForm = true"  
          class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-lg"
        >
          Suggest a Tag
        </button>
      </div>

      <div class="search-bar mb-6 flex flex-col sm:flex-row justify-between">
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search for a tag"
          class="p-2 border rounded-lg flex-grow mb-4 sm:mb-0"
        />
      </div>

      <div class="tags-grid"> 
        <div
          class="tag-card bg-white shadow-md border border-gray-200 rounded-lg p-4 flex flex-col items-center"
          v-for="tag in filteredTags"
          :key="tag.id"
        >
          <div class="tag-info flex justify-between w-full mb-4 text-gray-800">
            <span class="tag-name text-lg font-semibold">{{ tag.name }}</span>
            <span class="tag-count bg-green-100 text-green-800 px-2 py-1 rounded-lg text-sm">{{ tag.postCount }} P</span>
          </div>
          <button
            class="follow-btn px-4 mt-4 py-2 rounded-lg text-white font-semibold transition duration-300"
            :class="{ 'bg-blue-500': !tag.isFollowing, 'bg-gray-500': tag.isFollowing }"
            @click="toggleFollow(tag.id)"
          >
            {{ tag.isFollowing ? 'Unfollow' : 'Follow' }}
          </button>
        </div>
      </div>

      <div v-if="showSuggestForm" class="modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50">
        <div class="modal-content bg-white p-6 rounded-lg relative w-full max-w-md">
          <button @click="closeModal" class="absolute top-2 right-2 text-black">
            <span class="material-symbols-outlined">close</span>
          </button>
          <h2 class="text-xl font-semibold mb-4">Suggest a Tag</h2>
          <div class="mb-4">
            <input
              v-model="newTagName"
              type="text"
              placeholder="Tag Name"
              class="w-full p-2 border rounded-lg"
            />
          </div>
          <button
            @click="suggestTag"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
          >
            Add Tag
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '../config';

const tags = ref([]);
const searchQuery = ref('');
const showSuggestForm = ref(false);
const newTagName = ref('');
const token = localStorage.getItem('user-token');

const apiClient = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Authorization': `Bearer ${token}`,
  },
});

const fetchTags = async () => {
  try {
    const response = await apiClient.get('/tags');
    tags.value = response.data;

    // Check follow status for each tag
    await Promise.all(tags.value.map(async (tag) => {
      const isFollowingResponse = await apiClient.get(`/tags/${tag.id}/is-following`);
      tag.isFollowing = isFollowingResponse.data.isFollowing; // Adjust based on your API response structure
    }));
  } catch (error) {
    console.error('Error fetching tags:', error);
  }
};

onMounted(() => {
  fetchTags();
});

const filteredTags = computed(() => {
  return searchQuery.value 
    ? tags.value.filter(tag => tag.name.toLowerCase().includes(searchQuery.value.toLowerCase())) 
    : tags.value;
});

const toggleFollow = async (tagId) => {
  const tag = tags.value.find((t) => t.id === tagId);
  
  if (tag) {
    try {
      if (tag.isFollowing) {
        await apiClient.delete(`/tags/${tagId}/unfollow`);
        console.log(`Unfollowed tag ID: ${tagId}`);
      } else {
        await apiClient.post(`/tags/${tagId}/follow`);
        console.log(`Followed tag ID: ${tagId}`);
      }
      // Update the follow status immediately after the action
      tag.isFollowing = !tag.isFollowing;
    } catch (error) {
      console.error('Error toggling follow status:', error);
    }
  }
};

const suggestTag = async () => {
  if (newTagName.value.trim()) {
    try {
      const response = await apiClient.post('/suggested-tags', {
        name: newTagName.value,
      });
      tags.value.push(response.data);
      newTagName.value = '';
      closeModal();
    } catch (error) {
      console.error('Error suggesting tag:', error);
    }
  }
};

const closeModal = () => {
  showSuggestForm.value = false;
};
</script>


<style scoped>
.tags-component {
  padding: 1rem;
}

.tags-grid {
  display: flex;
  flex-wrap: wrap;  
  gap: 1rem;
}

.tag-card {
  text-align: center;
  flex: 1 1 calc(25% - 1rem);
}

.follow-btn {
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.follow-btn:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  padding: 2rem;
  background: white;
  border-radius: 0.5rem;
}
</style>
