<template>
  <div class="container mx-auto px-4 py-6 bg-gray-100">
    <!-- Welcome Section -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-blue-600 mt-10 mb-20">Welcome to RDEV Admin Panel</h1>
    </div>

    <!-- Key Metrics Section -->
    <h1 class="text-3xl mb-3 font-mono">-> Accepted</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Active Section -->
      <div class="p-6 bg-white rounded-xl animate__animated animate__fadeIn animate__delay-1s
       shadow-2xl text-black hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Posts (Active)</h2>
        <p class="text-2xl mt-2">1,234</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-2s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Podcasts (Active)</h2>
        <p class="text-2xl mt-2">567</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-3s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Events (Active)</h2>
        <p class="text-2xl mt-2">567</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-4s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Tags (Active)</h2>
        <p class="text-2xl mt-2">600</p>
      </div>
      <div class="p-6 bg-white text-black rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-5s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total YouTube Channels (Active)</h2>
        <p class="text-2xl mt-2">1,234</p>
      </div>
    </div>
    <h1 class="text-3xl mb-3 font-mono mt-20">-> Not Accepted</h1>
    <!-- Not Accepted Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
      <div class="p-6 bg-red-100 rounded-xl animate__animated animate__fadeIn animate__delay-1s shadow-2xl text-black hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Posts (Not Accepted)</h2>
        <p class="text-2xl mt-2">456</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-2s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Podcasts (Not Accepted)</h2>
        <p class="text-2xl mt-2">123</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-3s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Events (Not Accepted)</h2>
        <p class="text-2xl mt-2">89</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-4s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total Tags (Not Accepted)</h2>
        <p class="text-2xl mt-2">45</p>
      </div>
      <div class="p-6 bg-red-100 rounded-xl shadow-2xl animate__animated animate__fadeIn animate__delay-5s hover:bg-inherit">
        <h2 class="text-xl font-bold">Total YouTube Channels (Not Accepted)</h2>
        <p class="text-2xl mt-2">90</p>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>

<style scoped>
/* Add additional styling if necessary */
</style>
