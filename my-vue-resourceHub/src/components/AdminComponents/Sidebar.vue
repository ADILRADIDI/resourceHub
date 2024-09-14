<template>
  <!-- Toggle Button for Sidebar -->
  <button
    data-drawer-target="admin-sidebar"
    data-drawer-toggle="admin-sidebar"
    aria-controls="admin-sidebar"
    @click="openseidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
  >
    <span class="sr-only">Open sidebar</span>o
    <svg
      class="w-6 h-6"
      aria-hidden="true"
      fill="currentColor"
      viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        clip-rule="evenodd"
        fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
      ></path>
    </svg>
  </button>

  <!-- Sidebar -->
  <aside
    id="admin-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar"

  >
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <div class="logo text-white p-2 mt-10 mb-20 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
        <router-link to="/">
          <h1>RDEV</h1>
        </router-link>
      </div>
      <ul class="space-y-2 font-medium">
        <li>
          <a
            href="#"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
          >
            <svg
              class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 22 21"
            >
              <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"></path>
              <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"></path>
            </svg>
            <span class="ms-3">Dashboard</span>
          </a>
        </li>
        
        <li>
            <a href="#" @click="openDropDawnlist" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 18 18"
            >
              <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"></path>
            </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">Manage Content</span>
              <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M14.3 7.3a1 1 0 0 1 0 1.4l-2 2a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.4L11 8.6l1.9-1.9a1 1 0 0 1 1.4 0z"/>
              </svg>
            </a>
            <!-- Dropdown Menu -->
            <ul v-if="isssdd" class="mt-2 space-y-2 pl-8">
              <li><RouterLink to="/Mpost" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage post</RouterLink></li>
              <li><RouterLink to="/Mresource" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage Resources</RouterLink></li>
              <li><RouterLink to="/Mtags" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage tags</RouterLink></li>
              <li><RouterLink to="/Mpodcasts" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage podcasts</RouterLink></li>
              <li><RouterLink to="/Mevents" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage events</RouterLink></li>
              <li><RouterLink to="/" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Ma CrashCourse &copy;</RouterLink></li>
              <li><RouterLink to="/" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage Ai &copy; </RouterLink></li>
              <li><RouterLink to="/" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage ads &copy; </RouterLink></li>
            </ul>
          </li>
        <li>
            <a href="#" @click="openDropDawnlisttwo" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 18 18"
            >
              <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"></path>
            </svg>
              <span class="flex-1 ms-3 whitespace-nowrap">Manage Users</span>
              <svg class="w-5 h-5 text-gray-500 hover:bg-gray-900 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" 
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M14.3 7.3a1 1 0 0 1 0 1.4l-2 2a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.4L11 8.6l1.9-1.9a1 1 0 0 1 1.4 0z"/>
              </svg>
            </a>
            <!-- Dropdown Menu -->
            <ul v-if="istwo" class="mt-2 space-y-2 pl-8">
              <li><RouterLink to="/Musers" href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage Users</RouterLink></li>
              <li><RouterLink to="/Mroles" href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage Roles</RouterLink></li>
              <li><RouterLink to="/Mpermissions" href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage Permissions</RouterLink></li>
              <!-- <li><a href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">managemnt events</a></li>
              <li><a href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">managemnt CrashCourse</a></li>
              <li><a href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">managemnt Ai</a></li>
              <li><a href="#" class="block p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">managemnt ads </a></li> -->
            </ul>
          </li>
        <!-- add li setting and logout -->
         <li>
          <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg
          dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
          <svg
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 18 18"
            >
              <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"></path>
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Setting</span>
        </a>
         </li>
      </ul>
    </div>
  </aside>
</template>

<script>
import { RouterLink } from 'vue-router';

export default {
  data() {
    return {
      SideBarstatuss: false,
      isssdd: false,
      istwo: false,
    };
  },
  methods: {
    openseidebar() {
      this.SideBarstatuss = !this.SideBarstatuss;
      console.log(this.SideBarstatuss);
    },
    openDropDawnlist() {
      console.log(this.isssdd);
      this.isssdd = !this.isssdd;
    },
    openDropDawnlisttwo() {
      console.log(this.istwo);
      this.istwo = !this.istwo;
    }
  }
};
</script>

<style scoped>
/* Add your scoped CSS styles here if needed */
</style>
