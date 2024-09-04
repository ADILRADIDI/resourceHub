<template>
    <aside
      :class="{
        'translate-x-0': isOpen,
        '-translate-x-full': !isOpen
      }"
      class="fixed top-0 left-0 w-64 bg-gradient-to-b from-indigo-500 to-blue-500 h-full p-5 text-white shadow-lg transition-transform transform md:translate-x-0"
    >
      <div class="flex items-center justify-between mb-8">
        <div class="logo text-white p-2 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
          <router-link to="/">
            <h1>RDEV</h1>
          </router-link>
        </div>        <button class="md:hidden" @click="toggleSidebar">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <nav>
        <ul class="space-y-4">
          <li>
            <router-link to="/DashboardAdmin" class="flex items-center py-2 px-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors">
              <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
            </router-link>
          </li>
          <li>
            <router-link to="/statistics" class="flex items-center py-2 px-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors">
              <i class="fas fa-chart-bar mr-3"></i>Statistics
            </router-link>
          </li>
          <li>
            <button @click="toggleUserMenu" class="flex items-center py-2 px-4 w-full text-left bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors">
              <i class="fas fa-users mr-3"></i>Users
              <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 ml-auto transition-transform" :class="{ 'rotate-180': isUserMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <ul v-show="isUserMenuOpen" class="pl-8 mt-2 space-y-2">
              <li><router-link to="/managementUsers" class="block py-2 px-4 hover:bg-gray-700 rounded-lg transition-colors">Management User</router-link></li>
              <li><router-link to="/users/roles" class="block py-2 px-4 hover:bg-gray-700 rounded-lg transition-colors">Management Roles</router-link></li>
              <li><router-link to="/users/permissions" class="block py-2 px-4 hover:bg-gray-700 rounded-lg transition-colors">Management Permissions</router-link></li>
            </ul>
          </li>
          <li>
            <button @click="toggleContentMenu" class="flex items-center py-2 px-4 w-full text-left bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors">
              <i class="fas fa-folder-open mr-3"></i>Content
              <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 ml-auto transition-transform" :class="{ 'rotate-180': isContentMenuOpen }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <ul v-show="isContentMenuOpen" class="pl-8 mt-2 space-y-2">
              <li><router-link to="/users/posts" class="block py-2 px-4 hover:bg-gray-700 rounded-lg transition-colors">Management Posts</router-link></li>
              <li><router-link to="/users/tags" class="block py-2 px-4 hover:bg-gray-700 rounded-lg transition-colors">Management Tags</router-link></li>
              <li><router-link to="/users/comments" class="block py-2 px-4 hover:bg-gray-700 rounded-lg transition-colors">Management Comments</router-link></li>
            </ul>
          </li>
          
          <li>
            <router-link to="/events" class="flex items-center py-2 px-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors">
              <i class="fas fa-calendar-alt mr-3"></i>Manage Events
            </router-link>
          </li>
          <li>
            <router-link to="/settings" class="flex items-center py-2 px-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors">
              <i class="fas fa-cogs mr-3"></i>Settings
            </router-link>
          </li>
        </ul>
        <button @click="Logout" class="flex items-center py-2 px-4 w-full text-left bg-gray-800 hover:bg-gray-700 rounded-lg mt-4 transition-colors">
          <i class="fas fa-sign-out-alt mr-3"></i>Logout
        </button>
      </nav>
    </aside>
  </template>
  
  <script>
  export default {
    data() {
      return {
        isOpen: false,
        isUserMenuOpen: false,
        isContentMenuOpen: false
      };
    },
    methods: {
      toggleSidebar() {
        this.isOpen = !this.isOpen;
      },
      toggleUserMenu() {
        this.isUserMenuOpen = !this.isUserMenuOpen;
      },
      toggleContentMenu() {
        this.isContentMenuOpen = !this.isContentMenuOpen;
      }
    }
  };
  </script>
  
  <style scoped>
  @media (min-width: 768px) {
    aside {
      transform: translateX(0);
    }
  }
  </style>
  