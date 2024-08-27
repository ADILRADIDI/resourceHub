<template>
    <div class="tags-component mx-8">
      <h1 class="font-bold text-3xl text-gray-800 mb-6">Tags</h1>
      <div class="tags-grid">
        <div
          class="tag-card bg-white shadow-md border border-gray-200 rounded-lg p-4 flex flex-col items-center"
          v-for="tag in tags"
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
  import { ref } from 'vue';
  
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
  </style>
  