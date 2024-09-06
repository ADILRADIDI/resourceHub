<template>
    <div id="containerAside" class="flex">
      <!-- Navigation Sidebar -->
      <aside class="w-64 bg-gray-200 p-4 pl-4 ml-5 mt-7">
        <ul class="space-y-2">
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-700 hover:text-blue-600 flex items-center">
              <!-- <img src="../../public/img/house.png" alt="house" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">home</span>
              <span class="ml-4">Home</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
              <router-link to="/readinglist"  class="text-gray-700 hover:text-blue-600 flex items-center">
                <!-- <img src="../../public/img/stackexchange.png" alt="StackExchange" class="w-8 h-8"> -->
                <span class="material-symbols-outlined">fact_check</span>
                <span class="ml-4">Reading List</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
              <router-link to="/StachExchangeView"  class="text-gray-700 hover:text-blue-600 flex items-center">
                <!-- <img src="../../public/img/stackexchange.png" alt="StackExchange" class="w-8 h-8"> -->
                <span class="material-symbols-outlined">quiz</span>
                <span class="ml-4"> StackExchange</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/Podcast" class="text-gray-700 hover:text-blue-600 flex items-center">
              <!-- <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">podcasts</span>
              <span class="ml-4">Podcast</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/EventView" class="text-gray-700 hover:text-blue-600 flex items-center">
              <!-- <img src="../../public/img/EventsIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">event</span>
              <span class="ml-4">Events</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/CrashCourse" class="text-gray-700 hover:text-blue-600 flex items-center">
              <!-- <img src="../././public/img/CrashIcon.png" alt="Podcasts" class="w-9 h-9"> -->
              <span class="material-symbols-outlined">local_library</span>
              <span class="ml-4">Crash Course</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/YtChannels" class="text-gray-700 hover:text-blue-600 flex items-center">
              <!-- <img src="../../public/img/Yt-channels.png" alt="Podcasts" class="w-9 h-9"> -->
              <span class="material-symbols-outlined">youtube_activity</span>
              <span class="ml-4">YT-channels</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/Tags" class="text-gray-700 hover:text-blue-600 flex items-center">
              <!-- <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <span class="material-symbols-outlined">sell</span>
              <span class="ml-4">Tags</span>
            </router-link>
          </li>
          
          <!-- <img src="../../public/img/booksIcon.jfif" alt="Podcasts" class="w-8 h-8"> -->
           <!-- <li class="flex items-center space-x-4">
            <router-link to="/Podcasts" class="text-gray-700 hover:text-blue-600 flex items-center">
              <span class="material-symbols-outlined">auto_stories</span>
              <span class="ml-4">Books</span>
            </router-link>
          </li> -->

          <!-- <li class="flex items-center space-x-4">
            <router-link to="/PublicApi" class="text-gray-700 hover:text-blue-600 flex items-center"> -->
              <!-- <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8"> -->
              <!-- <span class="material-symbols-outlined">api</span>
              <span class="ml-4">Public Api</span>
            </router-link>
          </li> -->

          <!--<li class="flex items-center space-x-4">
            <router-link to="/Shop" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/shopIcon.png" alt="Podcasts" class="w-8 h-8">
              <span class="ml-4"> Shop &copy;</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/PublicApi" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8">
              <span class="ml-4">Public Api &copy;</span>
            </router-link>
          </li> -->


                    <!-- resources drop ... -->
                    <button @click="toggleDropdown('resources')" type="button"
                     class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group
                      hover:bg-gray-200 hover:rounded-full dark:text-white dark:hover:bg-gray-700">
                      <span class="material-symbols-outlined">
                        developer_guide
                      </span>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"><b>Dev Resources</b></span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
          </svg>
        </button>
        <ul v-show="dropdownStates.resources" class="dropdown-menu py-2 space-y-2">
          <li v-for="category in categories" :key="category.id">
            <router-link :to="`/R/${category.id}`">{{ category.name }}</router-link>
          </li>
        </ul>

      
          <button @click="toggleDropdown('roadmaps')" type="button" class="flex items-center w-full p-2 
          text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-200 hover:rounded-full dark:text-white dark:hover:bg-gray-700">
          <span class="material-symbols-outlined">
            route
            </span>
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap"><b>Roadmaps</b></span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
          <ul v-show="dropdownStates.roadmaps" class="py-2 space-y-2">
            <li>
              <router-link to="/roadmaps/products" class="flex items-center w-full p-2 text-gray-900
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
  
      <!-- Main Content -->
      <div id="main-content" class="flex-1 p-6">
        <!-- Your main content goes here -->
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        dropdownStates: {
          roadmaps: false,
          resources: false
        },
        categories: [
        { id: 1, name: 'Web Development' },
        { id: 2, name: 'Mobile Development' },
        { id: 3, name: 'Developer Advocacy' },
        { id: 4, name: 'Data Visualization' },
        { id: 5, name: 'Server Management' },
        { id: 6, name: 'Microservices' },
        { id: 7, name: 'Chatbots' },
        { id: 8, name: 'SaaS (Software as a Service)' },
        { id: 9, name: 'Version Control' },
        { id: 10, name: 'Blockchain' },
        { id: 11, name: 'Game Development' },
        { id: 12, name: 'Machine Learning' },
        { id: 13, name: 'Data Science' },
        { id: 14, name: 'Data Science' },
        { id: 15, name: 'Ai' },
        { id: 16, name: 'DevOps' },
        // Add more categories as needed
      ],
      };
    },
    methods: {
      toggleDropdown(dropdown) {
        this.dropdownStates[dropdown] = !this.dropdownStates[dropdown];
      }
    }
  };
  </script>
  
  <style scoped>
  /* Container styling */
  #containerAside {
    display: flex;
  }
  
  /* Sidebar styles */
  aside {
    width: 16rem; /* Set width of sidebar */
    background-color: #f3f4f6; /* Light gray background */
    padding: 1rem;
  }
  
  /* List item styling */
  ul {
    list-style-type: none; /* Remove default bullets */
    padding: 0;
  }
  
  li {
    display: flex;
    align-items: center;
    /* space-x: 4; */
     /* Adjust spacing between image and text */
  }
  
  /* Styling links */
  li a {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    color: #4a5568; /* Dark gray text */
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
  }
  
  li a:hover {
    background-color: #e2e8f0; 
    color: #1a202c;
    border-radius: 20px;
  }
  
  /* Bold section titles */
  .font-bold {
    font-weight: 700;
    color: #2d3748; 
  }
  
  #main-content {
    flex: 1; 
    padding: 1rem; 
  }
  
  .h-48 {
    height: 12rem;
  }


.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24

}
/* 
.material-symbols-outlined {
  color: blue;
} */

  </style>
