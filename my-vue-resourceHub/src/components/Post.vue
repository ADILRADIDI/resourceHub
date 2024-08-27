<template>
  <div class="post-wrapper mt-20">
    <!-- Post 1 -->
    <div class="post-container bg-white p-6 rounded-lg shadow-md w-full max-w-4xl mx-auto mt-4">
      <!-- Post Header -->
      <div class="post-header flex items-center mb-4">
        <img src="https://via.placeholder.com/40" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
        <div>
          <p class="font-semibold text-gray-800">{{ username }}</p>
          <p class="text-sm text-gray-500">{{ timeCreated }}</p>
        </div>
      </div>

      <!-- Post Title -->
      <router-link to="/p">
        <h2 class="post-title text-xl font-bold text-gray-900 mb-4 hover:text-blue-500">
          {{ title }}
        </h2>
      </router-link>

      <!-- Post Content -->
      <p class="post-content text-gray-700 mb-6">
        {{ content }}
      </p>

      <!-- Post Footer -->
      <div class="post-footer flex items-center justify-between">
        <div class="hashtags">
          <router-link to="/t/VueJS" class="text-blue-500 hover:underline mr-2">#VueJS</router-link>
          <router-link to="/t/JavaScript" class="text-blue-500 hover:underline mr-2">#JavaScript</router-link>
          <router-link to="/t/WebDevelopment" class="text-blue-500 hover:underline mr-2">#WebDevelopment</router-link>
        </div>
        <div class="actions flex items-center">
          <button @click="toggleLike" class="like-button flex items-center mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-red-500': liked, 'text-gray-500': !liked}" viewBox="0 0 20 20">
              <path d="M3.172 5.172a4.2 4.2 0 015.656 0L10 6.343l1.172-1.171a4.2 4.2 0 015.656 5.656L10 18.828l-6.828-6.828a4.2 4.2 0 010-5.656z"/>
            </svg>
            <span class="ml-1">{{ liked ? 'Liked' : 'Like' }}</span>
          </button>
          <button @click="toggleSave" class="save-button flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-blue-500': saved, 'text-gray-500': !saved}" viewBox="0 0 20 20">
              <path d="M5 3a1 1 0 00-1 1v13a1 1 0 001.6.8L10 15.333l3.4 2.467a1 1 0 001.6-.8V4a1 1 0 00-1-1H5z"/>
            </svg>
            <span class="ml-1">{{ saved ? 'Unsave' : 'Save' }}</span>
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
        <div class="inline-block
         align-middle bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden
          shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full px-5">
          <div>
            <div class="mt-3 text-center sm:mt-5">
              <h1 class="text-2xl leading-6 font-medium text-gray-900 text-start mb-8 font-bold">Log in to continue</h1>
              <hr class="h-3 w-full">
              <img src="../../public/img/logoWithoutBackground.png" alt="" srcset="" class="w-72 mb-3">
              <h2 class="text-sm leading-6 font-medium text-gray-900">We're a place where coders share, stay up-to-date and grow their careers.
              </h2>
              <div class="mt-2 flex item-center justify-center gap-10 mt-12">
                <router-link to="/" class="text-white bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">
                    Login
                  </span>
                </router-link>
                <router-link to="/" class="text-black bg-white hover:border-solid hover:border-2 hover:border-bg-indigo-600 py-2 px-4 rounded-lg w-36">
                  <span class="flex items-center justify-center">
                    Create Account
                  </span>
                </router-link>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-6">
            <button @click="closeModal" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent
             shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2
              focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
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

const username = 'Adil Doe';
const timeCreated = 'August 25';
const title = 'Component in Vue.js Vue.js Building a Post Component in Vue.js';
const content = 'This is a brief summary of the post content. It can be a few sentences long, summarizing the main points of the post.';
const liked = ref(false);
const saved = ref(false);
const showModal = ref(false);

function toggleLike() {
  if (checkAuth()) {
    liked.value = !liked.value;
  } else {
    showModal.value = true;
  }
}

function toggleSave() {
  if (checkAuth()) {
    saved.value = !saved.value;
  } else {
    showModal.value = true;
  }
}

function checkAuth() {
  const token = localStorage.getItem('auth_token');
  return token !== null;
}

function closeModal() {
  showModal.value = false;
}
</script>

<style scoped>
/* Your existing styles */

</style>
