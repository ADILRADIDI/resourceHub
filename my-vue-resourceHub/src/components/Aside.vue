<template>
    <div id="containerAside" class="flex">
      <!-- Navigation Sidebar -->
      <aside class="w-64 bg-gray-200 p-4 pl-4 ml-5">
        <ul class="space-y-2">
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/house.png" alt="house" class="w-8 h-8">
              <span class="ml-4">Home</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
              <router-link to="/readinglist"  class="text-gray-700 hover:text-blue-600 flex items-center">
                <img src="../../public/img/stackexchange.png" alt="StackExchange" class="w-8 h-8">
                <span class="ml-4">Reading List</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
              <router-link to="/StachExchangeView"  class="text-gray-700 hover:text-blue-600 flex items-center">
                <img src="../../public/img/stackexchange.png" alt="StackExchange" class="w-8 h-8">
                <span class="ml-4"> StackExchange</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/Podcast" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8">
              <span class="ml-4">Podcast</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/EventView" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/EventsIcon.png" alt="Podcasts" class="w-8 h-8">
              <span class="ml-4">Events</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/CrashCourse" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/CrashIcon.png" alt="Podcasts" class="w-9 h-9">
              <span class="ml-4">Crash Course</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/YtChannels" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/Yt-channels.png" alt="Podcasts" class="w-9 h-9">
              <span class="ml-4">YT-channels</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/Tags" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/podcastIcon.png" alt="Podcasts" class="w-8 h-8">
              <span class="ml-4">Tags</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
            <router-link to="/Podcasts" class="text-gray-700 hover:text-blue-600 flex items-center">
              <img src="../../public/img/booksIcon.jfif" alt="Podcasts" class="w-8 h-8">
              <span class="ml-4">Books &copy;</span>
            </router-link>
          </li>
          <li class="flex items-center space-x-4">
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
          </li>
          


          <!-- Additional Navigation -->
          <li class="font-bold text-gray-900">Development Resources</li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Code of Conduct" class="w-8 h-8">
              <span class="ml-4">Full-stack Dev</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Code of Conduct" class="w-8 h-8">
              <span class="ml-4">Front-end Dev</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Privacy Policy" class="w-8 h-8">
              <span class="ml-4">Back-end Dev</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Terms of Use" class="w-8 h-8">
              <span class="ml-4">Machine Learning</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Terms of Use" class="w-8 h-8">
              <span class="ml-4">Devops & Big Data</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Terms of Use" class="w-8 h-8">
              <span class="ml-4">Mobile Dev</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Terms of Use" class="w-8 h-8">
              <span class="ml-4">Cloud Computing</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Terms of Use" class="w-8 h-8">
              <span class="ml-4">Cybersecurity</span>
            </a>
          </li>
          <li class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-blue-600 flex items-center">
              <img src="../../public/img/frontendIcon.png" alt="Terms of Use" class="w-8 h-8">
              <span class="ml-4">UI/UX Design</span>
            </a>
          </li>
          


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
    background-color: #e2e8f0; /* Light gray background on hover */
    color: #1a202c; /* Darker text color on hover */
    border-radius: 20px;
  }
  
  /* Bold section titles */
  .font-bold {
    font-weight: 700;
    color: #2d3748; /* Dark gray text */
  }
  
  /* Adjust main content padding */
  #main-content {
    flex: 1; /* Make main content area flexible */
    padding: 1rem; /* Add padding */
  }
  
  /* Scrollable container for popular tags */
  .h-48 {
    height: 12rem; /* Adjust height as needed */
  }
  </style>
  