<script setup>
import Dashboard from '../../components/AdminComponents/Dashboard.vue';
import Sidebar from '../../components/AdminComponents/Sidebar.vue';
import Header from '../../components/AdminComponents/Header.vue';
</script>

<template>
  <div class="flex flex-col md:flex-row">
    <!-- Sidebar component with responsive margin -->
    <Sidebar class="md:mt-10 flex-shrink-0" />
    <main class="flex xl:ml-96 md:ml-80 justify-center items-center gap-10 flex-wrap">
      <Dashboard />
    </main>
  </div>
</template>

<style>
/* Optional: Add custom styles for responsiveness and layout adjustments */

/* Ensures the sidebar and content are responsive */
@media (max-width: 768px) {
  .mx-44 {
    margin-left: 1rem;
    margin-right: 1rem;
  }
}

/* Optional: Ensure the sidebar doesn't shrink too much on smaller screens */
.sidebar {
  min-width: 250px; /* Adjust based on your design */
}

/* Add any additional global styles or adjustments here */
</style>
