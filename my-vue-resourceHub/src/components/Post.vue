<template>
  <div class="post-wrapper mt-10">
    <!-- Post List -->
    <div v-for="post in posts" :key="post.id" class="post-container bg-white p-6 rounded-lg shadow-md 
 mb-6 relative">
      <!-- Post Header -->
      <div class="post-header flex items-center mb-4 justify-around">
        <img src="https://via.placeholder.com/40" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
        <div>
          <router-link to="/johnDoe">
            <p class="font-semibold text-gray-800 hover:text-blue-500">{{ post.username }}</p>
          </router-link>
          <p class="text-sm text-gray-500">{{ post.timeCreated }}</p>
        </div>
        <!-- Dropdown Button -->
        <div class="relative ml-auto">
          <button @click="toggleDropdown(post.id)" class="text-white bg-white
          hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg  
          text-sm px-5 py-2.5 text-center inline-flex items-center">
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" 
            viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" 
              stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" class="text-blue-700 w-16"/>
            </svg>
          </button>
          <!-- Dropdown Menu -->
          <div v-if="dropdownOpen === post.id"
           class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100 rounded-lg shadow-lg z-20">
            <ul class="py-2 text-sm text-gray-700">
              <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Copy Link</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-red-500 hover:text-white rounded-full">Delete</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Share &copysr;</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Post Title -->
      <router-link :to="`/p/${post.id}`">
        <h2 class="post-title text-xl font-bold text-gray-900 mb-4 hover:text-blue-500">
          {{ post.title }}
        </h2>
      </router-link>

      <!-- Post Content -->
      <p class="post-content text-gray-700 mb-6">
        {{ post.content }}
      </p>

      <!-- Post Footer -->
      <div class="post-footer flex items-center justify-between">
        <div class="hashtags">
          <router-link to="/t/VueJS" class="text-blue-500 hover:underline mr-2">#VueJS</router-link>
          <router-link to="/t/JavaScript" class="text-blue-500 hover:underline mr-2">#JavaScript</router-link>
          <router-link to="/t/WebDevelopment" class="text-blue-500 hover:underline mr-2">#WebDevelopment</router-link>
        </div>
        <div class="actions flex items-center">
          <button @click="toggleLike(post.id)" class="like-button flex items-center mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-red-500': post.liked, 'text-gray-500': !post.liked}" viewBox="0 0 20 20">
              <path d="M3.172 5.172a4.2 4.2 0 015.656 0L10 6.343l1.172-1.171a4.2 4.2 0 015.656 5.656L10 18.828l-6.828-6.828a4.2 4.2 0 010-5.656z"/>
            </svg>
            <span class="ml-1">{{ post.liked ? 'Liked' : 'Like' }}</span>
          </button>
          <button @click="toggleSave(post.id)" class="save-button flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-blue-500': post.saved, 'text-gray-500': !post.saved}" viewBox="0 0 20 20">
              <path d="M5 3a1 1 0 00-1 1v13a1 1 0 001.6.8L10 15.333l3.4 2.467a1 1 0 001.6-.8V4a1 1 0 00-1-1H5z"/>
            </svg>
            <span class="ml-1">{{ post.saved ? 'Unsave' : 'Save' }}</span>
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
        <div class="inline-block align-middle bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full px-5">
          <div>
            <div class="mt-3 text-center sm:mt-5">
              <h1 class="text-2xl leading-6 font-medium text-gray-900 text-start mb-8 font-bold">Log in to continue</h1>
              <hr class="h-3 w-full">
              <img src="../../public/img/logoWithoutBackground.png" alt="" class="w-72 mb-3">
              <h2 class="text-sm leading-6 font-medium text-gray-900">We're a place where coders share, stay up-to-date and grow their careers.</h2>
              <div class="mt-2 flex item-center justify-center gap-10 mt-12">
                <router-link to="/login" class="text-white bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">
                    Login
                  </span>
                </router-link>
                <router-link to="/register" class="text-black bg-white hover:border-solid hover:border-2 hover:border-indigo-600 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">
                    Create Account
                  </span>
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
import { ref } from 'vue';

// Sample data for posts
const posts = ref([
  {
    id: 1,
    username: 'John Doe',
    timeCreated: '2 hours ago',
    title: 'Vue 3 is awesome!',
    content: 'I am really enjoying learning Vue 3. The new composition API is great!',
    liked: false,
    saved: true,
  },
  {
    id: 2,
    username: 'Jane Smith',
    timeCreated: '1 day ago',
    title: 'Vue 3 Tips',
    content: 'Here are some tips for using Vue 3 effectively...',
    liked: true,
    saved: true,
  },
  {
    id: 1,
    username: 'John Doe',
    timeCreated: '2 hours ago',
    title: 'Vue 3 is awesome!',
    content: 'I am really enjoying learning Vue 3. The new composition API is great!',
    liked: false,
    saved: false,
  },
  {
    id: 2,
    username: 'Jane Smith',
    timeCreated: '1 day ago',
    title: 'Vue 3 Tips',
    content: 'Here are some tips for using Vue 3 effectively...',
    liked: true,
    saved: false,
  },
  {
    id: 1,
    username: 'John Doe',
    timeCreated: '2 hours ago',
    title: 'Vue 3 is awesome!',
    content: 'I am really enjoying learning Vue 3. The new composition API is great!',
    liked: false,
    saved: false,
  },
  {
    id: 2,
    username: 'Jane Smith',
    timeCreated: '1 day ago',
    title: 'Vue 3 Tips',
    content: 'Here are some tips for using Vue 3 effectively...',
    liked: true,
    saved: true,
  },
]);

const showModal = ref(false);
const dropdownOpen = ref(null);

function toggleLike(postId) {
  if (checkAuth()) {
    const post = posts.value.find(p => p.id === postId);
    if (post) {
      post.liked = !post.liked;
    }
  } else {
    showModal.value = true;
  }
}

function toggleSave(postId) {
  if (checkAuth()) {
    const post = posts.value.find(p => p.id === postId);
    if (post) {
      post.saved = !post.saved;
    }
  } else {
    showModal.value = true;
  }
}

function toggleDropdown(postId) {
  dropdownOpen.value = dropdownOpen.value === postId ? null : postId;
}

function closeModal() {
  showModal.value = false;
}

function checkAuth() {
  // Dummy authentication check
  return false;
}
</script>
<style scoped>
.post-wrapper {
  padding: 1rem;
}

.post-container {
  width: 800px;

}


.dropdown-menu {
  display: none;
}

.dropdown-menu.show {
  display: block;
}

.post-header {
  display: flex;
  align-items: center;
}

.post-title {
  cursor: pointer;
  transition: color 0.3s;
}

.post-title:hover {
  color: #3b82f6; /* Tailwind's blue-500 color */
}

.post-content {
  line-height: 1.5;
}

.post-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.like-button,
.save-button {
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: color 0.3s;
}

.like-button:hover svg,
.save-button:hover svg {
  color: #3b82f6; /* Tailwind's blue-500 color */
}

.hashtags a {
  margin-right: 0.5rem;
}

.modal {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-content {
  background: white;
  padding: 1rem;
  border-radius: 0.5rem;
  width: 80%;
  max-width: 500px;
}
</style>
