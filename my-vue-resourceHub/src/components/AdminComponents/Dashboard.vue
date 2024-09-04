<template>
    <div class="container mx-36 w-full p-6 flex flex-wrap">
      <!-- Welcome Section -->
      <div class="mb-6">
        <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-600 animate-pulse">Welcome to RDEV Admin Panel</h1>
      </div>
  
      <!-- Key Metrics Section -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-4 bg-yellow-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">Total Users</h2>
          <p class="text-2xl mt-2">1,234</p>
        </div>
        <div class="p-4 bg-green-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">Active Users</h2>
          <p class="text-2xl mt-2">567</p>
        </div>
        <div class="p-4 bg-yellow-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">Tags</h2>
          <p class="text-2xl mt-2">40</p>
        </div>
        <div class="p-4 bg-blue-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">Comments</h2>
          <p class="text-2xl mt-2">600</p>
        </div>
        <div class="p-4 bg-yellow-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">Posts</h2>
          <p class="text-2xl mt-2">42 k</p>
        </div>
        
        <div class="p-4 bg-green-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">Tags</h2>
          <p class="text-2xl mt-2">40</p>
        </div>
        
        <div class="p-4 bg-purple-500 text-white rounded-lg shadow-lg col-span-1 md:col-span-2">
          <h2 class="text-xl font-bold">Event Metrics</h2>
          <p class="text-2xl mt-2">Upcoming Events: 4 | Pending Approval: 3</p>
        </div>
        <div class="p-4 bg-red-500 text-white rounded-lg shadow-lg">
          <h2 class="text-xl font-bold">User Growth</h2>
          <!-- Placeholder for user growth graph -->
          <div class="mt-4 h-32 bg-white text-gray-800 rounded-lg p-2">
            <p>Graph goes here</p>
          </div>
        </div>
      </div>

    </div>
  </template>
  
  <script>
  export default {
    name: "AdminDashboard",
    data() {
      return {
        // You can add data properties here if needed
      };
    },
    methods: {
      // You can add methods here if needed
    },
  };
  </script>
  
  <style scoped>
  /* Animations */
  @keyframes pulse {
    0%, 100% {
      opacity: 1;
    }
    50% {
      opacity: 0.5;
    }
  }
  
  .animate-pulse {
    animation: pulse 2s infinite;
  }
  
  /* Optional additional styles */
  </style>
  