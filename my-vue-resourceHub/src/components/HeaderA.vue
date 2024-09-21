<template>
  <!-- Main Container -->
  <div id="header" class="bg-white shadow-md py-4 px-6 flex items-center justify-between">
    <!-- Menu Button (Visible on mobile and tablets) -->
    <button @click="toggleAside" class="md:hidden p-2 rounded-full hover:bg-gray-100 mx-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>

    <!-- Header Section with Logo and Search -->
    <div class="flex items-center space-x-4 w-full">
      <!-- Logo -->
      <div class="logo text-white p-2 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
        <router-link to="/">
          <h1>RDEV</h1>
        </router-link>
      </div>
      <!-- Search Bar -->
      <div class="w-4/5">
        <div class="relative w-full">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <span class="material-symbols-outlined">search</span>
          </span>
          <input type="search" placeholder="Search..." name="search" id="search-input"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
      </div>
    </div>

    <!-- Create Post Button -->
    <router-link to="/new" class="text-blue-700 border-solid border-indigo-500 border-2 
      hover:text-white hover:bg-indigo-500 py-2 px-4 rounded-lg w-36">
      <span class="flex items-center justify-center">Create Post</span>
    </router-link>

    <!-- Notifications Icon -->
    <router-link to="/Mynotification">
      <button class="p-2 rounded-full hover:bg-gray-100 mx-2 relative">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        <!-- Notification Counter (only show if unreadNotifications > 0) -->
        <span v-if="unreadNotifications > 0"
          class="absolute top-1 right-1 inline-block w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full">
          {{ unreadNotifications }}
        </span>
      </button>
    </router-link>

    <!-- User Avatar -->
    <div class="relative" @click="toggleDropdown" tabindex="0">
      <img alt="User Avatar" class="w-10 h-10 rounded-full object-cover cursor-pointer" />
      <!-- Dropdown menu -->
      <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
        <!-- Dropdown items -->
        <router-link to="/me" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition transform hover:-translate-y-1">Profile</router-link>
        <router-link to="/SettingV" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition transform hover:-translate-y-1">Settings</router-link>
        <button @click="logout" class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-left transition transform hover:-translate-y-1">Logout</button>
      </div>
    </div>
  </div>
</template>

<script>
import Aside from '../components/Aside.vue';
import axios from 'axios';
import { API_BASE_URL } from '@/config'; // Adjust this path as necessary
import { ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
  data() {
    return {
      isDropdownOpen: false,
      unreadNotifications: 10,
    };
  },
  setup() {
    const router = useRouter();

    const logout = async () => {
      try {
        await axios.post(`${API_BASE_URL}logout`, {}, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`
          }
        });
        // Clear the token from localStorage
        localStorage.removeItem('user-token');
        // Redirect to login or home page
        router.push('/login'); // Change this route as needed
      } catch (error) {
        console.error('Logout error:', error);
      }
    };

    return { logout };
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

a .bg-indigo-600 {
  transition: background-color 0.3s ease;
}

.material-symbols-outlined {
  font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
}
</style>
