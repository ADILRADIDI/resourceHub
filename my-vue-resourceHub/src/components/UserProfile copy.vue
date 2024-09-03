<template>
    <div class="user-profile bg-white p-6 rounded-lg shadow-md">
      <div class="flex items-center">
        <img :src="userProfileImage" alt="Profile Picture" class="w-20 h-20 rounded-full mr-4">
        <div>
          <h2 class="text-xl font-semibold text-gray-800">{{ username }}</h2>
          <p class="text-gray-500">{{ userEmail }}</p>
        </div>
      </div>
      <div class="mt-6">
        <h3 class="text-lg font-semibold text-gray-800">Posts by {{ username }}</h3>
        <!-- List user's posts -->
        <ul class="mt-4">
          <li v-for="post in userPosts" :key="post.id" class="mb-4">
            <router-link :to="`/Pd/${post.id}`" class="text-blue-500 hover:underline">{{ post.title }}</router-link>
            <p class="text-gray-500 text-sm">{{ post.timeCreated }}</p>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  
  // Assume you fetch user data based on the user ID
  const route = useRoute();
  const userId = route.params.userId;
  
  const username = ref('John Doe');
  const userProfileImage = ref('https://via.placeholder.com/80');
  const userEmail = ref('john.doe@example.com');
  const userPosts = ref([]);
  
  // Fetch user data and posts
  onMounted(() => {
    // Mock data for demonstration
    userPosts.value = [
      {
        id: 1,
        title: 'First post by John Doe',
        timeCreated: '2 hours ago'
      },
      {
        id: 2,
        title: 'Another post by John Doe',
        timeCreated: '5 hours ago'
      }
    ];
  });
  </script>
  
  <style scoped>
  .user-profile {
    max-width: 600px;
    margin: auto;
  }
  </style>
  