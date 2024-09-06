<template>
  <header class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-4 flex justify-between items-center">
    <button class="md:hidden" @click="$emit('toggle-sidebar')">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
    <!-- <h1 class="text-xl font-bold">RDEV Admin Panel</h1> -->
  </header>
</template>

<script>
export default {
  emits: ['toggle-sidebar'],
};
</script>

<style scoped>
/* Add styles for responsive and beautiful design */
</style>
