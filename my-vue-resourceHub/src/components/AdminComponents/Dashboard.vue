<template>
  <div class="container mx-auto px-4 py-6">
    <!-- Welcome Section -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-blue-600 mb-4">Welcome to RDEV Admin Panel</h1>
    </div>

    <!-- Key Metrics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="p-6 bg-yellow-500 text-white rounded-lg shadow-lg animate__animated animate__fadeIn animate__delay-1s">
        <h2 class="text-xl font-bold">Total Posts (Active)</h2>
        <p class="text-2xl mt-2">1,234</p>
      </div>
      <div class="p-6 bg-blue-500 text-white rounded-lg shadow-lg animate__animated animate__fadeIn animate__delay-2s">
        <h2 class="text-xl font-bold">Total Podcasts (Active)</h2>
        <p class="text-2xl mt-2">567</p>
      </div>
      <div class="p-6 bg-green-500 text-white rounded-lg shadow-lg animate__animated animate__fadeIn animate__delay-3s">
        <h2 class="text-xl font-bold">Total Events (Active)</h2>
        <p class="text-2xl mt-2">567</p>
      </div>
      <div class="p-6 bg-blue-500 text-white rounded-lg shadow-lg animate__animated animate__fadeIn animate__delay-4s">
        <h2 class="text-xl font-bold">Total Tags (Active)</h2>
        <p class="text-2xl mt-2">600</p>
      </div>
      <div class="p-6 bg-yellow-500 text-white rounded-lg shadow-lg animate__animated animate__fadeIn animate__delay-5s">
        <h2 class="text-xl font-bold">Total YouTube Channels (Active)</h2>
        <p class="text-2xl mt-2">1,234</p>
      </div>
    </div>

    <!-- User List Section -->
    <div class="mt-10 bg-white rounded-lg shadow-lg p-6">
      <h2 class="text-2xl font-bold mb-4">All Premium Users</h2>
      <ul>
        <!-- Replace with dynamic user list -->
        <li class="border-b py-2">Ilias 1</li>
        <li class="border-b py-2">Mohammed 2</li>
        <li class="border-b py-2">Abderahman 3</li>
        <li class="border-b py-2">Abderahman 3</li>
        <!-- Add more users here -->
      </ul>
    </div>
  </div>
</template>

<script setup>
// You can fetch data from an API or state management if needed
</script>

<style scoped>
/* Add additional styling if necessary */
</style>
