<template>
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

    <!-- Search Bar -->
    <div class="search-bar mb-6 flex flex-col sm:flex-row justify-between">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search for a tag"
        class="p-2 border rounded-lg flex-grow mb-4 sm:mb-0"
      />
    </div>

    <!-- Tags Grid -->
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

    <!-- Suggest a Tag Modal -->
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
</template>

<script setup>
import { ref, computed } from 'vue';

// Tags data
const tags = ref([
  { id: 1, name: 'Web Development', postCount: 120, isFollowing: false },
  { id: 2, name: 'JavaScript', postCount: 200, isFollowing: false },
  { id: 3, name: 'Vue.js', postCount: 85, isFollowing: false },
  { id: 4, name: 'CSS', postCount: 60, isFollowing: false },
  { id: 5, name: 'js', postCount: 60, isFollowing: false },
  { id: 6, name: 'Laravel', postCount: 60, isFollowing: false },
  { id: 7, name: 'Livewire', postCount: 60, isFollowing: false },
  { id: 1, name: 'Web Development', postCount: 120, isFollowing: false },
  { id: 2, name: 'JavaScript', postCount: 200, isFollowing: false },
  { id: 3, name: 'Vue.js', postCount: 85, isFollowing: false },
  { id: 4, name: 'CSS', postCount: 60, isFollowing: false },
  { id: 5, name: 'js', postCount: 60, isFollowing: false },
  { id: 6, name: 'Laravel', postCount: 60, isFollowing: false },
  { id: 7, name: 'Livewire', postCount: 60, isFollowing: false },
]);

// State for search query and showing the modal
const searchQuery = ref('');
const showSuggestForm = ref(false);
const newTagName = ref('');

// Computed property for filtering tags based on the search query
const filteredTags = computed(() => {
  if (searchQuery.value) {
    return tags.value.filter(tag => tag.name.toLowerCase().includes(searchQuery.value.toLowerCase()));
  }
  return tags.value;
});

// Toggle follow/unfollow for a tag
const toggleFollow = (tagId) => {
  const tag = tags.value.find((t) => t.id === tagId);
  if (tag) {
    tag.isFollowing = !tag.isFollowing;
  }
};

// Suggest a new tag
const suggestTag = () => {
  if (newTagName.value.trim()) {
    const newTag = {
      id: tags.value.length + 1, // Simple ID generation, consider a better method in real use
      name: newTagName.value,
      postCount: 0, // New tag has no posts initially
      isFollowing: false
    };
    tags.value.push(newTag);
    newTagName.value = ''; // Clear the input
    closeModal(); // Hide the modal after submission
  }
};

// Close the modal
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
  flex: 1 1 calc(25% - 1rem); /* Adjust the width for the number of columns */
}

.follow-btn {
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.follow-btn:hover {
  background-color: #0056b3; /* Darker blue on hover */
  transform: scale(1.05);
}

/* Modal styles */
.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 50;
}

.modal-content {
  background-color: #ffffff;
  padding: 2rem;
  border-radius: 0.5rem;
  width: 90%;
  max-width: 600px;
}

.material-symbols-outlined {
  font-size: 2rem;
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .tag-card {
    flex: 1 1 calc(50% - 1rem); /* 2 columns */
  }
}

@media (max-width: 640px) {
  .tag-card {
    flex: 1 1 calc(100% - 1rem); /* 1 column */
  } 

  .search-bar {
    flex-direction: column;
  }

  .search-bar input {
    margin-right: 0;
    margin-bottom: 1rem;
  }
}
</style>
