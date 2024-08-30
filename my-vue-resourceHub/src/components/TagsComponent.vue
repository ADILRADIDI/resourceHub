<template>
  <div class="tags-component mx-8">
    <h1 class="font-bold text-3xl text-gray-800 mb-6">Tags</h1>

    <!-- Search Bar -->
    <div class="search-bar mb-6 flex flex-col sm:flex-row justify-between">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search for a tag"
        class="p-2 border rounded-lg flex-grow mr-0 sm:mr-4 mb-4 sm:mb-0"
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
          <span class="tag-count bg-green-100 text-green-800 px-2 py-1 rounded-lg text-sm">{{ tag.postCount }} Posts</span>
        </div>
        <button
          class="follow-btn px-4 mt-8 py-2 rounded-lg text-white font-semibold transition duration-300"
          :class="{ 'bg-blue-500': !tag.isFollowing, 'bg-gray-500': tag.isFollowing }"
          @click="toggleFollow(tag.id)"
        >
          {{ tag.isFollowing ? 'Unfollow' : 'Follow' }}
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
  { id: 6, name: 'laravel', postCount: 60, isFollowing: false },
  { id: 7, name: 'livewire', postCount: 60, isFollowing: false },
]);

// Search query state
const searchQuery = ref('');

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
</script>

<style scoped>
.tags-component {
  padding: 1rem;
}

.tags-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
}

.tag-card {
  text-align: center;
}

.follow-btn {
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.follow-btn:hover {
  background-color: #0056b3; /* Darker blue on hover */
  transform: scale(1.05);
}

/* Responsive Styles */
@media (max-width: 1024px) {
  .tags-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 640px) {
  .tags-grid {
    grid-template-columns: 1fr;
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
