<template>
  <div class="post-wrapper mt-14">
    <div v-for="post in posts" :key="post.id" class="post-container bg-white p-6 rounded-lg shadow-md relative mb-3">
      <div class="post-header flex items-center mb-4 justify-around">
        <img :src="post.userProfileImage || 'default-image-url.jpg'" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
        <div>
            <router-link :to="`/u/${post.user?.id}`" class="font-semibold text-gray-800 hover:text-blue-500">
              {{ post.user?.name || 'Unknown User' }}
            </router-link>
          <p class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</p>
        </div>
        <div class="relative ml-auto">
          <button @click="toggleDropdown(post.id)" class="text-black bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
            <i class="fa-solid fa-ellipsis-vertical text-xl"></i>
          </button>
          <div v-if="dropdownOpen === post.id" class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-2xl shadow-lg z-20">
            <ul class="py-2 text-sm text-gray-700">
              <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Copy Link</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Share</a></li>
            </ul>
          </div>
        </div>
      </div>

      <router-link :to="`/Pd/${post.id}`">
        <h2 class="post-title text-xl font-bold text-gray-900 mb-4 hover:text-blue-500">{{ post.title }}</h2>
      </router-link>

      <div class="post-content text-gray-700 mb-6">
        <p class="mb-6">{{ post.body }}</p>
        <div class="hashtags mb-4">
            <span v-for="(tag, index) in post.tags" :key="index">
                <router-link :to="`/t/${tag}`" class="text-blue-500 hover:underline mr-2">#{{ tag }}</router-link>
            </span>
        </div>
      </div>

      <div class="post-footer flex items-center justify-between">
        <div class="actions flex items-center">
          <button @click="toggleLike(post)" class="like-button flex items-center mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-red-500': post.liked, 'text-gray-500': !post.liked}" viewBox="0 0 20 20">
              <path d="M3.172 5.172a4.2 4.2 0 015.656 0L10 6.343l1.172-1.171a4.2 4.2 0 015.656 5.656L10 18.828l-6.828-6.828a4.2 4.2 0 010-5.656z"/>
            </svg>
            <span class="ml-1 text-gray-700">{{ post.liked ? 'Dislike' : 'Like' }}</span>
          </button>
          <router-link :to="`/Pd/${post.id}`">
            <button class="like-button flex items-center mr-4">
              <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="crayons-icon">
                <path d="M10.5 5h3a6 6 0 110 12v2.625c-3.75-1.5-9-3.75-9-8.625a6 6 0 016-6zM12 15.5h1.5a4.501 4.501 0 001.722-8.657A4.5 4.5 0 0013.5 6.5h-3A4.5 4.5 0 006 11c0 2.707 1.846 4.475 6 6.36V15.5z"></path>
              </svg>
              <span class="ml-1 text-gray-700">Comments</span>
            </button>
          </router-link>
          <button @click="toggleSave(post)" class="save-button flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-blue-500': post.saved, 'text-gray-500': !post.saved}" viewBox="0 0 20 20">
              <path d="M5 3a1 1 0 00-1 1v13a1 1 0 001.6.8L10 15.333l3.4 2.467a1 1 0 001.6-.8V4a1 1 0 00-1-1H5z"/>
            </svg>
            <span class="ml-1 text-gray-700">{{ post.saved ? 'Unsave' : 'Save' }}</span>
          </button>
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
                <router-link to="/register" class="text-black bg-white hover:border-solid hover:border-2 hover:border-indigo-600 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">Create Account</span>
                </router-link>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-6">
            <button @click="closeModal" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
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
import axios from 'axios';
import { API_BASE_URL, Image_Unkown_user } from '../config';

const posts = ref([]);
const showModal = ref(false);
const dropdownOpen = ref(null);

const fetchPosts = async () => {
  try {
    const token = localStorage.getItem('user-token');
    const response = await axios.get(`${API_BASE_URL}posts`, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    posts.value = response.data.map(post => ({
      ...post,
      userProfileImage: post.user.profile_picture || `${Image_Unkown_user}`,
      liked: post.likes.some(like => like.user_id === parseInt(localStorage.getItem('user-id'))),
      saved: post.saved || false,
    }));
    // console.log(posts.value);
    
  } catch (error) {
    console.error('Error fetching posts:', error);
  }
};


const toggleLike = async (post) => {
  const token = localStorage.getItem('user-token');
  
  try {
    if (post.liked) {
      await axios.delete(`${API_BASE_URL}like`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        data: { post_id: post.id },
      });
      post.liked = false;
    } else {
      await axios.post(`${API_BASE_URL}like`, { post_id: post.id }, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      post.liked = true;
    }
  } catch (error) {
    console.error('Error toggling like:', error);
  }
};

const toggleSave = async (post) => {
  const token = localStorage.getItem('user-token');
  
  try {
    if (post.saved) {
      await axios.delete(`${API_BASE_URL}bookmarks`, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        data: { post_id: post.id },
      });
      post.saved = false;
    } else {
      await axios.post(`${API_BASE_URL}bookmarks`, { post_id: post.id }, {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      });
      post.saved = true;
    }
  } catch (error) {
    console.error('Error toggling save:', error);
  }
};

const toggleDropdown = (postId) => {
  dropdownOpen.value = dropdownOpen.value === postId ? null : postId;
};

const closeModal = () => {
  showModal.value = false;
};

const checkUserAuthentication = () => {
  const token = localStorage.getItem('user-token');
  if (!token) {
    showModal.value = true;
  }
};

onMounted(() => {
  checkUserAuthentication();
  fetchPosts();
});
</script>

<style scoped>
/* Add any styles here */
</style>
