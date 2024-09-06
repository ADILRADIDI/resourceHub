<template>
  <aside
    :class="{
      'translate-x-0': isOpen,
      '-translate-x-full': !isOpen,
    }"
    class="fixed  top-0 left-0 w-64 bg-gradient-to-b from-indigo-600 to-blue-600 h-full p-5
     text-white shadow-lg transition-transform transform md:translate-x-0 z-50"
  >
    <div class="flex items-center justify-between mb-8 ">
      <div class="logo text-white p-2 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
        <router-link to="/">
          <h1>RDEV</h1>
        </router-link>
      </div>
      <button class="md:hidden" @click="toggleSidebar">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
    <nav>
      <ul class="space-y-4">
        <li>
          <router-link
            to="/DashboardAdmin"
            class="flex items-center py-2 px-4 bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors"
          >
            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
          </router-link>
        </li>
        <!-- Add other links here -->
      </ul>
    </nav>
    <button @click="Logout" class="flex items-center py-2 px-4 w-full bg-gray-800 hover:bg-gray-700 rounded-lg mt-4 transition-colors">
      <i class="fas fa-sign-out-alt mr-3"></i>Logout
    </button>
  </aside>
</template>

<script>
export default {
  data() {
    return {
      isOpen: false,
    };
  },
  methods: {
    toggleSidebar() {
      this.isOpen = !this.isOpen;
    },
    Logout() {
      // Logout logic
    },
  },
};
</script>

<style scoped>
@media (min-width: 768px) {
  aside {
    transform: translateX(0);
  }
}
</style>
