<template>
    <!-- Main Container -->
    <div id="header" class="bg-white shadow-md py-4 px-6 flex items-center justify-between">
      <!-- Header Section with Logo and Search -->
      <div class="flex items-center space-x-4 w-full">
        <!-- Logo -->
        <div class="logo text-white p-2 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
          <router-link to="/">
            <h1>resourceHub</h1>
          </router-link>
        </div>
        <!-- Search Bar -->
        <div class="w-4/5">
          <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 -960 960 960" fill="#5f6368">
                <path
                  d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
              </svg>
            </span>
            <input type="search" placeholder="Search..." name="search" id="search-input"
              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>
        </div>
      </div>
      <router-link to="/" class="text-white text-indigo-600 border-solid border-indigo-600 border-2 
      hover:bg-indigo-700 hover:text-white py-2 px-4 rounded-lg w-36">
        <span class="flex items-center justify-center">
          Create Post
        </span>
      </router-link>
      <!-- Notifications Icon -->
       <router-link to="mynotification">
          <button class="p-2 rounded-full hover:bg-gray-100 mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" role="img" aria-labelledby="notifications-icon" class="crayons-icon">
              <title id="notifications-icon">Notifications</title>
              <path d="M20 17h2v2H2v-2h2v-7a8 8 0 1116 0v7zm-2 0v-7a6 6 0 10-12 0v7h12zm-9 4h6v2H9v-2z"></path>
            </svg>
          </button>
       </router-link>
      
      <div class="relative" @click="toggleDropdown" tabindex="0">
        <div>
          <img  src="data:image/jpeg;base64,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" alt="Profile Picture" class="w-10 h-10 rounded-full mx-5 cursor-pointer">
        </div>
        <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg">
          <ul>
            <li>
              <router-link to="/me" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">My Profile</router-link>
            </li>
            <li>
              <router-link to="/CreatePost" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Create Post</router-link>
            </li>
            <li>
              <router-link to="/readinglist" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Reading list</router-link>
            </li>
            <li>
              <router-link to="/SettingV" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Setting</router-link>
            </li>
            <li>
              <button @click="logout" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isDropdownOpen: false,
      };
    },
    methods: {
      toggleDropdown(event) {
        this.isDropdownOpen = !this.isDropdownOpen;
        event.stopPropagation();
      },
      closeDropdown(event) {
        if (!this.$el.contains(event.relatedTarget)) {
          this.isDropdownOpen = false;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  #container {
    background-color: #ffffff;
  }
  
  #search-input {
    background-color: #f7f7f7;
  }
  
  a {
    transition: color 0.3s ease;
  }
  
  a.bg-indigo-600 {
    transition: background-color 0.3s ease;
  }
  </style>
  
