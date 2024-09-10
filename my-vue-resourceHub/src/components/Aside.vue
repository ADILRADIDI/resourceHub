<template>
  <div id="containerAside" class="flex">
    <!-- Navigation Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4 ml-5 mt-7 lg:block hidden rounded-lg">
      <ul class="space-y-2">
          <li class="flex items-center space-x-4 ml-2 ">
            <router-link to="/"class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
              <!-- <img src="../../public/img/house.png" alt="house" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">home</span>
              <span class="ml-4">Home</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2 ">
              <router-link to="/readinglist"  class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
                <!-- <img src="../../public/img/stackexchange.png" alt="StackExchange" class="w-8 h-8"> -->
                <span class="material-symbols-outlined">fact_check</span>
                <span class="ml-4">Reading List</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2 ">
              <router-link to="/StachExchangeView"  class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
                <!-- <img src="../../public/img/stackexchange.png" alt="StackExchange" class="w-8 h-8"> -->
                <span class="material-symbols-outlined">quiz</span>
                <span class="ml-4"> StackExchange</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2 ">
            <router-link to="/Podcast" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
              <!-- <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">podcasts</span>
              <span class="ml-4">Podcast</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2 ">
            <router-link to="/EventView" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
              <!-- <img src="../../public/img/EventsIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">event</span>
              <span class="ml-4">Events</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2 ">
            <router-link to="/CrashCourse" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
              <!-- <img src="../././public/img/CrashIcon.png" alt="Podcasts" class="w-9 h-9"> -->
              <span class="material-symbols-outlined">local_library</span>
              <span class="ml-4">Crash Course</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2 ">
            <router-link to="/YtChannels" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
              <!-- <img src="../../public/img/Yt-channels.png" alt="Podcasts" class="w-9 h-9"> -->
              <span class="material-symbols-outlined">youtube_activity</span>
              <span class="ml-4">YT-channels</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4 ml-2">
            <router-link to="/Tags" class="text-gray-700 hover:text-blue-600 transition transform hover:-translate-y-1 flex items-center">
              <!-- <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">sell</span>
              <span class="ml-4">Tags</span>
            </router-link>
          </li>
                    <!-- resources drop ... -->
                    <button @click="toggleDropdown('resources')" type="button"
                      class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group
                        hover:bg-gray-200 hover:rounded-full dark:text-white dark:hover:bg-gray-700">
                        <span class="material-symbols-outlined">
                          developer_guide
                        </span>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap transition transform hover:-translate-y-1"><b>Dev Resources</b></span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul v-show="dropdownStates.resources" class="py-2 mt-2 space-y-2 bg-white rounded-lg shadow-md">
                        <li v-for="category in categories" :key="category.id">
                            <router-link :to="`/R/${category.id}`" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">{{ category.name }}</router-link>
                        </li>
                    </ul>

      
          <button @click="toggleDropdown('roadmaps')" type="button" class="flex items-center w-full p-2 
          text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-200 hover:rounded-full dark:text-white dark:hover:bg-gray-700">
          <span class="material-symbols-outlined">
            route
            </span>
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap transition transform hover:-translate-y-1"><b>Roadmaps</b></span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul v-show="dropdownStates.roadmaps" class="py-2 space-y-2">
            <li>
              <router-link to="/r/Front" class="flex items-center w-full p-2 text-gray-900
               transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Front-end Developer</router-link>
            </li>
            <li>
              <router-link to="/roadmaps/billing" class="flex items-center w-full p-2 text-gray-900 transition duration-75
               rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Full-end Developer</router-link>
            </li>
            <li>
              <router-link to="/roadmaps/invoice" class="flex items-center w-full p-2 text-gray-900
               transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Back-end Developer</router-link>
            </li>
            <li>
              <router-link to="/roadmaps/invoice" class="flex items-center w-full p-2 text-gray-900
               transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Mobile Developer</router-link>
            </li>
            <li>
              <router-link to="/roadmaps/invoice" class="flex items-center w-full p-2 text-gray-900
               transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Devops</router-link>
            </li>
          </ul>


          <!-- Popular Tags with Scroll -->
          <li class="font-bold text-gray-900 mt-4">Popular Tags</li>
          <div class="h-48 overflow-y-auto">
            <ul class="space-y-2">
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/webdev">#webdev</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/javascript">#javascript</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/python">#python</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/c++">#c++</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Laravel">#Laravel</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Vuejs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Vuejs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Vuejs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Vuejs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Vuejs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Vuejs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#chartjs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Reactjs</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Jquery</router-link>
              </li>
              <li class="flex items-center space-x-4">
                <router-link class="text-gray-600 hover:text-blue-600 flex items-center" to="/t/Vuejs">#Ruby</router-link>
              </li>
            </ul>
          </div>
        </ul>
    </aside>

    <!-- Responsive Toggle Button -->
    <button @click="toggleSidebar" class="lg:hidden fixed top-5 left-5 z-50 bg-blue-500 text-white p-2 rounded-full focus:outline-none hover:bg-blue-600 transition duration-300">
      <span class="material-symbols-outlined">menu</span>
    </button>

    <!-- Mobile Sidebar -->
    <transition name="slide">
      <aside v-if="isSidebarOpen" class="fixed inset-0 bg-gray-900 bg-opacity-75 z-40 lg:hidden" @click="toggleSidebar">
        <div class="w-64 bg-white p-4 h-full rounded-lg shadow-md">
          <ul class="space-y-4">
            <!-- Home -->
            <li>
              <a href="#" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">home</span>
                <span class="ml-4">Home</span>
              </a>
            </li>
            <!-- Reading List -->
            <li>
              <router-link to="/readinglist" class="flex items-center p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">fact_check</span>
                <span class="ml-4">Reading List</span>
              </router-link>
            </li>
            
            <!-- Resources Dropdown -->
            <li>
              <button @click="toggleDropdown('resources')" class="flex items-center w-full p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">developer_mode</span>
                <span class="ml-4 flex-1 text-left">Dev Resources</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
              <ul v-show="dropdownStates.resources" class="py-2 mt-2 space-y-2 bg-white rounded-lg shadow-md">
                <li v-for="category in categories" :key="category.id">
                  <router-link :to="`/R/${category.id}`" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">{{ category.name }}</router-link>
                </li>
              </ul>
            </li>
            
            <!-- Roadmaps Dropdown -->
            <li>
              <button @click="toggleDropdown('roadmaps')" class="flex items-center w-full p-2 text-gray-800 rounded-lg hover:bg-gray-100 transition duration-300">
                <span class="material-symbols-outlined">route</span>
                <span class="ml-4 flex-1 text-left">Roadmaps</span>
                <svg class="w-3 h-3" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
              <ul v-show="dropdownStates.roadmaps" class="py-2 mt-2 space-y-2 bg-white rounded-lg shadow-md">
                <li>
                  <router-link to="/roadmaps/products" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition duration-300">Front-end Developer</router-link>
                </li>
              </ul>
            </li>

            <!-- Popular Tags with Scroll -->
            <li class="font-bold text-gray-900 mt-4">Popular Tags</li>
            <div class="h-48 overflow-y-auto mt-2">
              <ul class="space-y-2">
                <li>
                  <router-link to="/t/webdev" class="block px-4 py-2 text-gray-600 hover:text-blue-600 hover:bg-gray-100 transition duration-300">#webdev</router-link>
                </li>
                <!-- Additional tags... -->
              </ul>
            </div>
          </ul>
        </div>
      </aside>
    </transition>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isSidebarOpen = ref(false);
const dropdownStates = ref({
  resources: false,
  roadmaps: false,
});

const categories = [
  { id: 'webdev', name: 'Web Development' },
  { id: 'javascript', name: 'JavaScript' },
  { id: 'python', name: 'Python' },
  { id: 'java', name: 'Java' },
  { id: 'php', name: 'PHP' },
  { id: 'ruby', name: 'Ruby' },
  { id: 'go', name: 'Go' },
  { id: 'rust', name: 'Rust' },
];

const toggleSidebar = () => {
  isSidebarOpen.value = !isSidebarOpen.value;
};

const toggleDropdown = (dropdown) => {
  dropdownStates.value[dropdown] = !dropdownStates.value[dropdown];
};
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
