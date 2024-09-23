<template>
  <div class="">
    <div class="profile-page container mx-auto p-4 md:p-6">
      <!-- User Profile Section -->
      <div class="flex flex-wrap bg-white rounded-lg items-center justify-center shadow-lg">
        <span class="crayons-avatar crayons-avatar--3xl">
          <img
            :src="userProfile.profile_picture || Image_Unkown_user"
            width="128"
            height="128"
            :alt="`${userProfile.name} profile picture`"
            class="crayons-avatar__image rounded-full mx-10 mt-5"
          />
        </span>
        <div class="skills p-4 md:p-6 mt-6">
          <h1 class="text-xl md:text-2xl font-bold text-gray-900 xl:text-3xl lg:text-2xl">
            {{ loading ? 'Loading...' : userProfile.name }}
          </h1>
          <p class="text-base md:text-lg text-gray-700 mt-1">{{ userProfile.bio || 'No bio available' }}</p>
          <p class="text-sm text-gray-500 mt-1">{{ userProfile.location || 'Location not specified' }}</p>
          <span class="flex items-center justify-start gap-5">
            <a :href="userProfile.github" class="text-blue-600 hover:underline mt-2 block" target="_blank">
              <span class="material-symbols-outlined">github</span>
            </a>
            <a :href="userProfile.website" class="text-blue-600 hover:underline mt-2 block" target="_blank">
              <span class="material-symbols-outlined w-10">language</span>
            </a>
          </span>
        </div>
      </div>

      <!-- Skills Section -->
      <div class="skills bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-900">Skills/Languages</h2>
        <div class="skills-list mt-7">
          <span
            v-for="(skill, index) in skillList"
            :key="index"
            class="skill-item bg-blue-700 text-white rounded-full px-4 py-2 mb-2 mr-2 inline-block"
          >
            {{ skill }}
          </span>
        </div>
      </div>

      <!-- Recent Posts Section -->
      <div class="recent-posts bg-white p-4 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-semibold text-gray-800">My Posts</h3>
        <div class="mt-4">
          <div v-for="post in userProfile.posts" :key="post.id" class="post-container bg-white p-6 rounded-lg shadow-md mb-4">
            <div class="post-header flex items-center mb-4">
              <img :src="post.user.profile_picture || 'default-image-url.jpg'" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
              <div class="flex-1">
                <router-link :to="`/u/${post.user.id}`" class="font-semibold text-gray-800 hover:text-blue-500">
                  {{ post.user.name }}
                </router-link>
                <p class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</p>
              </div>
              <div class="relative ml-auto">
                <button @click="toggleDropdown(post.id)" class="text-black bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                  <i class="fa-solid fa-ellipsis-vertical text-xl"></i>
                </button>
                <div v-if="dropdownOpen === post.id" class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-2xl shadow-lg z-20">
                  <ul class="py-2 text-sm text-gray-700">
                    <li @click="deletePost(post.id)" class="cursor-pointer block px-4 py-2 hover:bg-red-500 hover:text-white hover:rounded-full">Delete</li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Copy Link</a></li>
                    <!-- <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Share</a></li> -->
                  </ul>
                </div>
              </div>
            </div>

            <router-link :to="`/Pd/${post.id}`">
              <h2 class="post-title text-2xl font-bold text-gray-900 mb-4 hover:text-blue-500">{{ post.title }}</h2>
            </router-link>

            <div class="post-content text-gray-700 mb-6">
              <p class="mb-6">{{ post.body }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { API_BASE_URL, Image_Unkown_user } from '@/config';

const userProfile = ref({});
const loading = ref(true);
const userColorSettings = ref({
  background: '#FFFFFFFF',
});
const dropdownOpen = ref(null);
const errorMessage = ref(null);
const posts = ref([]);
const tagName = ref(''); // Replace with the desired tag

// Fetch user profile and posts on component mount
onMounted(async () => {
  await fetchUserProfile();
  await fetchPostsByTag();
});

// Function to fetch user profile
const fetchUserProfile = async () => {
  try {
    const userId = localStorage.getItem('user-id');
    const response = await axios.get(`${API_BASE_URL}profile/${userId}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('user-token')}`,
      },
    });
    userProfile.value = response.data;
    console.log('User profile fetched:', userProfile.value); // Debugging
  } catch (error) {
    console.error('Error fetching user profile:', error);
  } finally {
    loading.value = false;
  }
};

// Function to delete a post
const deletePost = async (postId) => {
  const token = localStorage.getItem('user-token');
  try {
    await axios.delete(`${API_BASE_URL}posts/${postId}`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    });
    console.log('Deleted post ID:', postId);
    // Optionally, refresh the posts or remove the post from the local state
    userProfile.value.posts = userProfile.value.posts.filter(post => post.id !== postId);
  } catch (error) {
    console.error('Error deleting post:', error.response ? error.response.data : error);
  }
};


// Function to fetch posts by tag
const fetchPostsByTag = async () => {
  loading.value = true;
  errorMessage.value = null;
  const token = localStorage.getItem('user-token');
  try {
    console.log('Fetching posts with tag:', tagName.value); // Debugging
    const response = await axios.post(`${API_BASE_URL}posts/by-tag`, { tag: tagName.value }, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    });
    posts.value = response.data;
    console.log('Posts fetched:', posts.value); // Debugging
  } catch (error) {
    errorMessage.value = 'Error fetching posts. Please try again later.';
    console.error('Error fetching posts:', error.response ? error.response.data : error);
  } finally {
    loading.value = false;
  }
};

// Toggle dropdown for post options
const toggleDropdown = (postId) => {
  dropdownOpen.value = dropdownOpen.value === postId ? null : postId;
};

// Compute skill list from user profile
const skillList = computed(() => 
  userProfile.value.skills 
    ? userProfile.value.skills.split('|').map(skill => skill.trim().replace(/\.$/, '')) 
    : []
);
</script>

<style scoped>
/* Add any additional styling here */
</style>
