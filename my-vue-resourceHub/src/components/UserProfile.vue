<template>
  <div>
    <!-- Profile Section -->
    <div class="user-profile max-w-4xl mx-auto py-6 rounded-lg shadow-md bg-white mt-3">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Profile Picture -->
        <div class="flex justify-center items-center">
          <img :src="userProfileImage" alt="Profile Picture" class="rounded-full shadow-lg w-32 h-32 object-cover">
        </div>

        <!-- User Information -->
        <div class="user-info text-center p-4">
          <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ username }}</h2>
          <p class="text-gray-500">{{ userLocation }}</p>
          <p class="text-gray-500">
            <!-- <a :href="userData.website" class="text-blue-500" target="_blank">My Portfolio</a> -->
            <a :href="userData.website" class="text-blue-500" target="_blank">My_Website</a>
          </p>
          <p class="text-gray-600">{{ userData.bio }}</p>
          <button
            class="follow-button bg-blue-800 text-white px-4 py-2 hover:bg-blue-900 rounded-full mt-4 w-44"
            @click="isFollowing ? unfollowUser() : followUser()"
          >
            {{ isFollowing ? 'Unfollow' : ' + Follow' }}
          </button>
        </div>
      </div>

      <!-- Recent Posts Section -->
      <div class="recent-posts bg-white p-4 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-semibold text-gray-800">Recent Posts</h3>
        <div class="mt-4">
          <div v-for="post in userPosts" :key="post.id" class="post-container bg-white p-6 rounded-lg shadow-md mb-4">
            <div class="post-header flex items-center mb-4">
              <img :src="post.userProfileImage || 'default-image-url.jpg'" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
              <div class="flex-1">
                <router-link :to="`/u/${post.user?.id}`" class="font-semibold text-gray-800 hover:text-blue-500">
                  {{ username }}
                </router-link>
                <p class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</p>
              </div>
              <div class="relative ml-auto">
                <button @click="toggleDropdown(post.id)" class="text-black bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                  <i class="fa-solid fa-ellipsis-vertical text-xl"></i>
                </button>
                <div v-if="dropdownOpen === post.id" class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-2xl shadow-lg z-20">
                  <ul class="py-2 text-sm text-gray-700">
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

    <!-- Authentication Modal -->
    <div v-if="showModal" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen px-4 text-center">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-middle bg-white rounded-lg pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full px-5">
          <div>
            <div class="mt-3 text-center sm:mt-5">
              <h1 class="text-2xl leading-6 text-gray-900 text-start mb-8 font-bold">Log in to continue</h1>
              <hr class="h-3 w-full">
              <img src="../../public/img/logoWithoutBackground.png" alt="" class="w-72 mb-3">
              <h2 class="text-sm leading-6 font-medium text-gray-900">We're a place where coders share, stay up-to-date and grow their careers.</h2>
              <div class="flex item-center justify-center gap-10 mt-12">
                <router-link to="/login" class="text-white bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">Login</span>
                </router-link>
                <router-link to="/register" class="text-black bg-gray-200 hover:bg-gray-300 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">Register</span>
                </router-link>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-6">
            <button @click="closeModal" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { API_BASE_URL, Image_Unkown_user } from '@/config';

const route = useRoute();
const userId = route.params.userId;

const username = ref('');
const userProfileImage = ref('https://via.placeholder.com/150');
const userLocation = ref('');
const userPosts = ref([]);
const userData = ref({});
const showModal = ref(false);
const dropdownOpen = ref(null);
const isFollowing = ref(false);

// Fetch user data and posts
onMounted(async () => {
  const token = localStorage.getItem('user-token');

  try {
    const profileResponse = await fetch(`${API_BASE_URL}profile/${userId}`, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json', 
      },
    });
    const data = await profileResponse.json();

    // Set user data
    userData.value = data;
    username.value = data.name;
    userProfileImage.value = data.profile_picture || Image_Unkown_user;
    userLocation.value = data.location;
    userPosts.value = data.posts || [];
    isFollowing.value = data.is_following; // Use the is_following from profile response

    // Fetch following status from the second endpoint if needed
    const followingResponse = await fetch(`${API_BASE_URL}isf/${userId}`, {
      method: 'GET',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    const followingData = await followingResponse.json();
    isFollowing.value = followingData.is_following; // Update isFollowing based on fetched status
    console.log(followingData); // Check what is returned

  } catch (error) {
    console.error('Error fetching user profile:', error);
  }

  // Check if user is logged in and set modal visibility
  showModal.value = !token;
});

const toggleDropdown = (postId) => {
  dropdownOpen.value = dropdownOpen.value === postId ? null : postId;
};

const closeModal = () => {
  showModal.value = false;
};

const followUser = async () => {
  const token = localStorage.getItem('user-token');

  try {
    await fetch(`${API_BASE_URL}follow/${userId}`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    isFollowing.value = true; // Update following status
  } catch (error) {
    console.error('Error following user:', error);
  }
};

const unfollowUser = async () => {
  const token = localStorage.getItem('user-token');

  try {
    await fetch(`${API_BASE_URL}unfollow/${userId}`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
      },
    });
    isFollowing.value = false; // Update following status
  } catch (error) {
    console.error('Error unfollowing user:', error);
  }
};
</script>

<style scoped>
/* Add your styles here */
</style>
