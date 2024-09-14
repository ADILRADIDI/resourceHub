<template>
  <!-- <HeaderA /> -->
  <div class="tags-component mb-6 flex flex-wrap items-center justify-between mt-20 bg-gray-100 rounded-lg mx-20 px-10 py-8 shadow-md">
    <h1 class="text-4xl font-bold mb-4">{{ tagName }}</h1>
    <div>
      <button
        v-if="isFollowing"
        @click="unfollowTag"
        class="bg-red-600 text-white py-2 px-8 rounded-full hover:bg-red-700"
        aria-label="Unfollow tag"
      >
        Unfollow
      </button>
      <button
        v-else
        @click="followTag"
        class="bg-blue-600 text-white py-2 px-8 rounded-full hover:bg-blue-700"
        aria-label="Follow tag"
      >
        Follow
      </button>
    </div>
  </div>
  <Post class="w-full" />
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import Post from '../components/Post.vue';
import HeaderA from '../components/HeaderA.vue';

// Get the tag name from the route parameter
const route = useRoute();
const tagName = ref(route.params.tag || 'VueJS'); // Default to 'VueJS' if no tag is provided
const isFollowing = ref(false); // Initial follow state

// Function to handle following the tag
const followTag = () => {
  isFollowing.value = true;
  // Implement API call or state change to follow the tag
};

// Function to handle unfollowing the tag
const unfollowTag = () => {
  isFollowing.value = false;
  // Implement API call or state change to unfollow the tag
};
</script>

<style scoped>
/* Add custom styles if needed */


/* Responsive adjustments */
@media (max-width: 768px) {
  .tags-component {
    margin: 0;
    padding: 1rem;
  }
}
</style>
