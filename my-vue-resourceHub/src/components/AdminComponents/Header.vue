<template>
    <header class="bg-blue-400 text-white p-4 flex justify-between items-center">
      <button class="md:hidden" @click="$emit('toggle-sidebar')">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <h1 class="text-lg font-semibold">RDEV Admin Panel</h1>
      <div>
        <!-- Add any other header elements like notifications, user profile, etc. -->
      </div>
    </header>
  </template>
  
  <script>
  export default {
    emits: ['toggle-sidebar']
  }
  </script>
  
  <style scoped>
  /* Header specific styles here */
  </style>
  