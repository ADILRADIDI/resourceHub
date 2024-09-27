<template>
  <div class="flex flex-col md:flex-row bg-gray-100">
    <!-- Sidebar component with responsive margin -->
    <Sidebar class="md:mt-10 flex-shrink-0" />
    <main class="flex flex-col w-full ml-0 md:ml-64 xl:ml-80 p-4">
      <!-- <Header /> -->
      <Dashboard />
    </main>
  </div>
</template>

<script setup>
import Dashboard from '../../components/AdminComponents/Dashboard.vue';
import Sidebar from '../../components/AdminComponents/Sidebar.vue';
import Header from '../../components/AdminComponents/Header.vue';
</script>

<style>
/* Optional: Add custom styles for responsiveness and layout adjustments */

/* Ensures the sidebar and content are responsive */
@media (max-width: 768px) {
  .ml-64 {
    margin-left: 0;
  }
}

@media (min-width: 768px) {
  .ml-0 {
    margin-left: 0;
  }
}
</style>
