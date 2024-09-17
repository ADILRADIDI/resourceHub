<template>
  <div class="post-wrapper">
    <!-- Post List -->
    <div v-for="post in posts" :key="post.id" class="post-container bg-white p-6 rounded-lg shadow-md mb-3 relative mt-14">
      <!-- Post Header -->
      <div class="post-header flex items-center mb-4 justify-around">
        <img :src="post.userProfileImage" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
          <div>
            <router-link :to="`/u/${post.id}`">
              <p class="font-semibold text-gray-800 hover:text-blue-500">{{ post.username }}</p>
            </router-link>
            <p class="text-sm text-gray-500">{{ post.timeCreated }}</p>
          </div>
        <!-- Dropdown Button -->
        <div class="relative ml-auto">
          <button @click="toggleDropdown(post.id)" class="text-black bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
            <!-- <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" class="text-blue-700 w-16"/>
            </svg> -->
            <i class="fa-solid fa-ellipsis-vertical text-xl"></i>            
            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
              <path fill-rule="evenodd" d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75Zm0 10.5a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75ZM2 10a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 2 10Z" clip-rule="evenodd" />
            </svg> -->
          </button>
          <!-- Dropdown Menu -->
          <div v-if="dropdownOpen === post.id" class="absolute right-0 mt-2 w-44 bg-white divide-y divide-gray-100
           rounded-2xl shadow-lg z-20">
            <ul class="py-2 text-sm text-gray-700">
              <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Copy Link</a></li>
              <li><a href="#" class="block px-4 py-2 hover:bg-blue-200 hover:rounded-full">Share</a></li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Post Title -->
      <!-- <router-link to="/Pd"> -->
      <router-link :to="`/Pd/${post.id}`">
        <h2 class="post-title text-xl font-bold text-gray-900 mb-4 hover:text-blue-500">
          {{ post.title }}
        </h2>
      </router-link>

      <!-- Post Content with Images -->
      <div class="post-content text-gray-700 mb-6">
        <p class="mb-6">{{ post.content }}</p>
        <div class="hashtags">
          <router-link to="/t/VueJS" class="text-blue-500 hover:underline mr-2">#VueJS</router-link>
          <router-link to="/t/JavaScript" class="text-blue-500 hover:underline mr-2">#JavaScript</router-link>
          <router-link to="/t/WebDevelopment" class="text-blue-500 hover:underline mr-2">#WebDevelopment</router-link>
        </div>
        <!-- Loop through images if available -->
        <div v-if="post.images && post.images.length > 0" class="post-images my-4">
          <img v-for="(image, index) in post.images" :key="index" :src="image" alt="Post Image" class="w-full rounded-lg mt-2">
        </div>
      </div>

      <!-- Post Footer -->
      <div class="post-footer flex items-center justify-between">
        <div class="actions flex items-center">
          <button @click="toggleLike(post.id)" class="like-button flex items-center mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-red-500': post.liked, 'text-gray-500': !post.liked}" viewBox="0 0 20 20">
              <path d="M3.172 5.172a4.2 4.2 0 015.656 0L10 6.343l1.172-1.171a4.2 4.2 0 015.656 5.656L10 18.828l-6.828-6.828a4.2 4.2 0 010-5.656z"/>
            </svg>
            <span class="ml-1 text-gray-700">{{ post.liked ? 'Liked' : 'Like' }}</span>
          </button>
          <router-link :to="`/Pd/${post.id}`">
            <button class="like-button flex items-center mr-4">
              <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="crayons-icon"><path d="M10.5 5h3a6 6 0 110 12v2.625c-3.75-1.5-9-3.75-9-8.625a6 6 0 016-6zM12 15.5h1.5a4.501 4.501 0 001.722-8.657A4.5 4.5 0 0013.5 6.5h-3A4.5 4.5 0 006 11c0 2.707 1.846 4.475 6 6.36V15.5z">
                </path>
              </svg> 
              <span class="ml-1 text-gray-700">Comments</span>
            </button>
          </router-link>
          <button @click="toggleSave(post.id)" class="save-button flex items-center">
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
              <div class=" flex item-center justify-center gap-10 mt-12">
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
import Header from './Header.vue';
import { ref } from 'vue';

// Sample data for posts
const posts = ref([
  {
    id: 1,
    username: 'John Doe',
    userProfileImage: 'https://via.placeholder.com/40',
    timeCreated: '2 hours ago',
    title: 'Vue 3 is awesome!',
    content: 'I am really enjoying learning Vue 3. The new composition API is great!',
    images: ['https://media.licdn.com/dms/image/v2/D4D22AQEf6hw6CFqPJA/feedshare-shrink_800/feedshare-shrink_800/0/1725115726665?e=1727913600&v=beta&t=y0oELRqfRQT5pw4XHdw43RlknmNT3S7Ih4in00RScGY'],
    liked: false,
    saved: false
  }
  ,
  {
    id: 1,
    username: 'John Doe',
    userProfileImage: 'https://via.placeholder.com/40',
    timeCreated: '2 hours ago',
    title: 'Vue 3 is awesome!',
    content: 'I am really enjoying learning Vue 3. The new composition API is great!',
    images: ['https://media.licdn.com/dms/image/v2/D4D22AQEf6hw6CFqPJA/feedshare-shrink_800/feedshare-shrink_800/0/1725115726665?e=1727913600&v=beta&t=y0oELRqfRQT5pw4XHdw43RlknmNT3S7Ih4in00RScGY'],
    liked: false,
    saved: false
  }
  ,
  {
    id: 1,
    username: 'John Doe',
    userProfileImage: 'https://via.placeholder.com/40',
    timeCreated: '2 hours ago',
    title: 'Vue 3 is awesome!',
    content: 'I am really enjoying learning Vue 3. The new composition API is great!',
    images: ['https://media.licdn.com/dms/image/v2/D4D22AQEf6hw6CFqPJA/feedshare-shrink_800/feedshare-shrink_800/0/1725115726665?e=1727913600&v=beta&t=y0oELRqfRQT5pw4XHdw43RlknmNT3S7Ih4in00RScGY'],
    liked: false,
    saved: false
  }
  ,
  {
    id: 2,
    username: 'maach imad',
    userProfileImage: 'https://via.placeholder.com/40',
    timeCreated: '3 hours ago',
    title: 'Understanding Vuex',
    content: 'Vuex is a state management pattern + library for Vue.js applications.',
    images: ['https://media.dev.to/cdn-cgi/image/width=1000,height=420,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2Fcbxq93kskpe6oyzt4ro1.png'],
    liked: false,
    saved: true
  }
  ,
  {
    id: 2,
    username: 'ADIL ANASS Smith',
    userProfileImage: 'https://via.placeholder.com/40',
    timeCreated: '4 minute ago',
    title: 'Understanding Vuex and vue router ',
    content: 'Vuex is a state management pattern + library for Vue.js applications.',
    images: ['https://media.dev.to/cdn-cgi/image/width=775%2Cheight=%2Cfit=scale-down%2Cgravity=auto%2Cformat=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Farticles%2F54v8jdgh920h99b90i07.png'],
    liked: true,
    saved: false
  }
]);


const dropdownOpen = ref(null);

const toggleDropdown = (id) => {
  dropdownOpen.value = dropdownOpen.value === id ? null : id;
};

const showModal = ref(false);

const toggleLike = (id) => {
  const post = posts.value.find((post) => post.id === id);
  post.liked = !post.liked;
};

const toggleSave = (id) => {
  const post = posts.value.find((post) => post.id === id);
  post.saved = !post.saved;
};

const closeModal = () => {
  showModal.value = false;
};
</script>

<style scoped>
.post-wrapper {
  max-width: 800px;
  margin: auto;
}
.post-title {
  transition: color 0.3s;
}
.post-title:hover {
  color: #3b82f6; /* Blue 500 */
}


</style>
