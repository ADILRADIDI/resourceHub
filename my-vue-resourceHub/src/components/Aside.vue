<template>
  <!-- Menu Button (Visible on mobile and tablets) -->
  <button @click="toggleSidebar" class="md:hidden p-2 rounded-full hover:bg-gray-100 mx-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 mt-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>
  <div id="containerAside" class="flex">
    <!-- Navigation Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4 ml-5 mt-7 lg:block hidden rounded-lg">
      <ul class="space-y-2">
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">home</span>
            <span class="ml-4">Home</span>
          </router-link>
        </li>
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/readinglist" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">fact_check</span>
            <span class="ml-4">Reading List</span>
          </router-link>
        </li>
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/StachExchangeView" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">quiz</span>
            <span class="ml-4">StackExchange</span>
          </router-link>
        </li>
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/Podcast" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">podcasts</span>
            <span class="ml-4">Podcast</span>
          </router-link>
        </li>
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/EventView" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">event</span>
            <span class="ml-4">Events</span>
          </router-link>
        </li>
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/YtChannels" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">youtube_activity</span>
            <span class="ml-4">YT-channels</span>
          </router-link>
        </li>
        <li class="flex items-center space-x-4 ml-2">
          <router-link to="/Tags" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
            <span class="material-symbols-outlined">sell</span>
            <span class="ml-4">Tags</span>
          </router-link>
        </li>

        <!-- Dev Resources Dropdown -->
        <li>
          <button @click="toggleDropdown('resources')" class="flex items-center w-full p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
            <span class="material-symbols-outlined">developer_mode</span>
            <span class="ml-4 flex-1 text-left">Dev Resources</span>
            <svg class="w-3 h-3" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
          </button>
          <ul v-show="dropdownStates.resources" class="py-2 mt-2 space-y-2 bg-white rounded-lg shadow-md">
            <li v-for="category in categories" :key="category.id">
              <router-link :to="`/resources/${category.id}`" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">{{ category.name }}</router-link>
            </li>
          </ul>
        </li>

        <!-- Roadmaps Dropdown -->
        <li>
          <button @click="toggleDropdown('roadmaps')" class="flex items-center w-full p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
            <span class="material-symbols-outlined">route</span>
            <span class="ml-3 flex-1 text-left">Roadmaps</span>
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
            </svg>
          </button>
          <ul v-show="dropdownStates.roadmaps" class="py-2 mt-2 space-y-2 bg-white rounded-lg shadow-md">
            <li><router-link to="/roadmaps/front" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Front-end Developer</router-link></li>
            <li><router-link to="/roadmaps/fullstack" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Full-stack Developer</router-link></li>
            <li><router-link to="/roadmaps/backend" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Back-end Developer</router-link></li>
            <li><router-link to="/roadmaps/mobile" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Mobile Developer</router-link></li>
            <li><router-link to="/roadmaps/devops" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">DevOps</router-link></li>
            <li><router-link to="/roadmaps/docker" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Docker</router-link></li>
            <li><router-link to="/roadmaps/java" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Java</router-link></li>
            <li><router-link to="/roadmaps/python" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Python</router-link></li>
          </ul>
        </li>

        <!-- Popular Tags -->
        <li class="font-bold text-gray-900 mt-4">Popular Tags</li>
        <div class="h-48 overflow-y-auto mt-2">
          <ul class="space-y-2">
            <li v-for="tag in popularTags" :key="tag.id">
              <router-link :to="`/t/${tag.name}`" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-100 transition duration-300">
                #{{ tag.name }}
              </router-link>
            </li>
          </ul>
        </div>
      </ul>
    </aside>

    

    <!-- Responsive Toggle Button -->
    <!-- <button @click="toggleSidebar" 
    class="lg:hidden fixed top-5 left-5 z-50 bg-blue-500 text-white
    w-10
     p-2 rounded-full focus:outline-none
     hover:bg-blue-600 transition duration-300">
      <span class="material-symbols-outlined">menu</span>
    </button> -->

    <!-- Mobile Sidebar -->
    <transition name="slide">
      <aside v-if="isSidebarOpen" class="fixed inset-0 bg-gray-900 bg-opacity-75 z-40 lg:hidden" @click="toggleSidebar">
        <div class="w-64 bg-white p-4 h-full rounded-lg shadow-md">
          <ul class="space-y-4">
            <!-- Home -->
            <li>
              <router-link to="/" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">home</span>
                <span class="ml-4">Home</span>
              </router-link>
            </li>
            <!-- Reading List -->
            <li>
              <router-link to="/readinglist" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">fact_check</span>
                <span class="ml-4">Reading List</span>
              </router-link>
            </li>
            <!-- StackExchange -->
            <li>
              <router-link to="/StachExchangeView" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">quiz</span>
                <span class="ml-4">StackExchange</span>
              </router-link>
            </li>
            <!-- Podcast -->
            <li>
              <router-link to="/Podcast" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">podcasts</span>
                <span class="ml-4">Podcast</span>
              </router-link>
            </li>
            <!-- Events -->
            <li>
              <router-link to="/EventView" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">event</span>
                <span class="ml-4">Events</span>
              </router-link>
            </li>
            <!-- YT-channels -->
            <li>
              <router-link to="/YtChannels" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">youtube_activity</span>
                <span class="ml-4">YT-channels</span>
              </router-link>
            </li>
            <!-- Tags -->
            <li>
              <router-link to="/Tags" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">sell</span>
                <span class="ml-4">Tags</span>
              </router-link>
            </li>
          </ul>
        </div>
      </aside>
    </transition>
  </div>
</template>


<script setup>
import { ref, onMounted } from 'vue';
import axios from '../axios';
import { API_BASE_URL } from '@/config';

const popularTags = ref([]);
const isSidebarOpen = ref(false);
const dropdownStates = ref({
  resources: false,
  roadmaps: false,
});

const categories = [
  { id: 'accessibility', name: 'Accessibility' },
  { id: 'ai', name: 'AI' },
  { id: 'analytics', name: 'Analytics' },
  { id: 'animation', name: 'Animation' },
  { id: 'api-building', name: 'API Building' },
  { id: 'audio', name: 'Audio' },
  { id: 'authentication', name: 'Authentication' },
  { id: 'blog', name: 'Blog' },
  { id: 'book', name: 'Book' },
  { id: 'browser', name: 'Browser' },
  { id: 'cdn', name: 'CDN' },
  { id: 'cheatsheet', name: 'Cheatsheet' },
  { id: 'cloud-computing', name: 'Cloud Computing' },
  { id: 'code-challenge', name: 'Code Challenge' },
  { id: 'code-generator', name: 'Code Generator' },
  { id: 'code-snippet', name: 'Code Snippet' },
  { id: 'color', name: 'Color' },
  { id: 'conference', name: 'Conference' },
  { id: 'database', name: 'Database' },
  { id: 'design', name: 'Design' },
  { id: 'documentation', name: 'Documentation' },
];

function toggleDropdown(dropdown) {
  dropdownStates.value[dropdown] = !dropdownStates.value[dropdown];
}


// Fetch popular tags from the API
const fetchPopularTags = async () => {
  try {
    const token = localStorage.getItem('user-token'); // Retrieve the token
    const response = await axios.get(`${API_BASE_URL}tag/popular`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    popularTags.value = response.data;
    console.log('Fetched popular tags:', popularTags.value); // Log the data
  } catch (error) {
    console.error('Error fetching popular tags:', error);
    if (error.response) {
      console.error('Response data:', error.response.data); // Log response data
      console.error('Response status:', error.response.status); // Log response status
    }
  }
};


// Fetch popular tags on component mount
// Fetch popular tags on component mount
onMounted(async () => {
  await fetchPopularTags(); // Call the fetch function
});


const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};

// const toggleDropdown = (dropdown) => {
//   dropdownStates.value[dropdown] = !dropdownStates.value[dropdown];
// };

</script>

<style scoped>
/* Slide transition for mobile sidebar */
.slide-enter-active, .slide-leave-active {
  transition: transform 0.3s ease;
}
.slide-enter, .slide-leave-to {
  transform: translateX(-100%);
}

/* Dropdown styles */
.dropdown-menu {
  transform: translateY(-20px);
  opacity: 0;
}
.dropdown-menu-enter-active, .dropdown-menu-leave-active {
  transition: transform 0.3s ease, opacity 0.3s ease;
}
.dropdown-menu-enter, .dropdown-menu-leave-to {
  transform: translateY(0);
  opacity: 1;
}

/* Adjust sidebar width on mobile */
@media (max-width: 1024px) {
  #containerAside {
    width: 100%;
  }
}
</style>
