<template>
  <!-- Sidebar with responsive behavior -->
  <aside
    :class="{'block': isSidebarOpen, 'hidden': !isSidebarOpen, 'md:block': true}"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-50 dark:bg-gray-800 transition-transform transform lg:w-56 h-screen shadow-xl  text-white p-4"
  >
    <div class="flex flex-col h-full p-4">
      <!-- Close button for mobile view -->
      <button
        @click="toggleSidebar"
        class="md:hidden p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 absolute top-4 right-4"
      >
        <span class="sr-only">Close sidebar</span>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M6.293 4.293a1 1 0 011.414 0L10 5.586l2.293-2.293a1 1 0 111.414 1.414L11.414 7l2.293 2.293a1 1 0 01-1.414 1.414L10 8.414l-2.293 2.293a1 1 0 01-1.414-1.414L8.586 7 6.293 4.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
      
      <!-- Logo and navigation links -->
      <div class="logo text-white p-2 mb-6 rounded-lg flex items-center justify-center bg-black font-bold text-lg w-28 ml-10">
        <router-link to="/">
          <h1>RDEV</h1>
        </router-link>
      </div>
      <ul class="space-y-2 font-medium">
        <li>
          <router-link to="/DashboardAdmin" class="flex items-center gap-3 p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-300  dark:hover:bg-gray-700">
            <span class="material-symbols-outlined">
home
</span>
            Dashboard
          </router-link>
        </li>
        <li>
          <button @click="toggleDropdown('content')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
            <span class="material-symbols-outlined">
folder_copy
</span>
            <span class="ms-3 mr-10"> Content</span>
            <svg :class="{ 'rotate-180': dropdowns.content }" class="w-5 h-5 ml-auto transition-transform duration-200" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1 1l4 4 4-4"></path>
            </svg>
          </button>
          <ul v-if="dropdowns.content" class="space-y-2 mt-2">
            <li><router-link to="/Mpost" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Post</router-link></li>
            <!-- <li><router-link to="/Mresource" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Resources</router-link></li> -->
            <li><router-link to="/Mtags" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Tags</router-link></li>
            <li><router-link to="/Mpodcasts" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Podcasts</router-link></li>
            <li><router-link to="/Mevents" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Events</router-link></li>
            <li><router-link to="/Mytchannels" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage YT Channels</router-link></li>
            <!-- <li><router-link to="/chat" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">Manage YT Channels</router-link></li> -->
          </ul>
        </li>
        <li>
          <button @click="toggleDropdown('users')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
            <span class="material-symbols-outlined">
              group
            </span>
            <span class="ms-3 mr-14"> Users</span>
            <svg :class="{ 'rotate-180': dropdowns.users }" class="w-5 h-5 ml-auto transition-transform duration-200" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1 1l4 4 4-4"></path>
            </svg>
          </button>
          <ul v-if="dropdowns.users" class="space-y-2 mt-2">
            <li><router-link to="/Musers" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Users</router-link></li>
            <li><router-link to="/Mroles" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Roles</router-link></li>
            <li><router-link to="/Mpermissions" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Manage Permissions</router-link></li>
          </ul>
        </li>
        <li>
          <button @click="toggleDropdown('suggested')" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
            <span class="material-symbols-outlined">
              prompt_suggestion
            </span>
            <span class="ms-3 mr-5 "> Suggested</span>
            <svg :class="{ 'rotate-180': dropdowns.suggested }" class="w-5 h-5 ml-auto transition-transform duration-200" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1 1l4 4 4-4"></path>
            </svg>
          </button>
          <ul v-if="dropdowns.suggested" class="space-y-2 mt-2">
            <!-- <li><router-link to="/sugPost" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Posts</router-link></li> -->
            <li><router-link to="/sugPodcast" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Podcasts</router-link></li>
            <li><router-link to="/sugTags" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">Tags</router-link></li>
            <li><router-link to="/sugYTchannels" class="flex items-center p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">YT Channels</router-link></li>
          </ul>
        </li>
        <!-- <li> -->
          <!-- <router-link to="/settings" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
          <span class="material-symbols-outlined">
          settings
        </span> -->
       <!-- <span class="ml-4">Settings</span>   </router-link></li> -->
        <li>
          <button @click="logout" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
            <span class="material-symbols-outlined">logout</span>
            <span class="ml-4">Logout</span>
          </button>
        </li>
      </ul> 
    </div>
  </aside>

  <!-- Hamburger Button -->
  <button @click="toggleSidebar" class="md:hidden p-2 text-gray-500 rounded-lg hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zM2 9.75A.75.75 0 012.75 9h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zM2 14.75A.75.75 0 012.75 14h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z" clip-rule="evenodd"></path>
    </svg>
  </button>
</template>

<script>
export default {
  data() {
    return {
      isSidebarOpen: false,
      dropdowns: {
        content: false,
        users: false,
        suggested: false,
      },
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    toggleDropdown(dropdown) {
      this.dropdowns[dropdown] = !this.dropdowns[dropdown];
    },
    logout() {
      // Call the logout method or API here
        localStorage.removeItem('user-token');
        localStorage.removeItem('user-id');
        localStorage.removeItem('user-role');
      this.$router.push('/login');
    },
  },
};
</script>

<style scoped>
/* Add any additional styles here if needed */
</style>
