<script setup>
// Import the components
import Header from '../components/Header.vue';
import HeaderA from '../components/HeaderA.vue';
import Post from '../components/Post.vue';
import Aside from '../../src/components/Aside.vue';
import AdsRight from '../components/AdsRight.vue';

// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<template>
  <Header v-if="!tokenExists" />
  <HeaderA v-else="tokenExists" />
  <main class="main-container">
    <div class="flex gap-5">
      <Aside class="mt-8" />
      <Post class="w-106 items-center" />
      <!-- Show AdsRight only if token exists and it's not on mobile/tablet -->
      <AdsRight v-if="tokenExists && !isMobileOrTablet" class="w-1/2" />
    </div>
  </main> 
</template>

<style scoped>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
  padding: 1rem; /* Optional: Add padding if needed */
}

@media (max-width: 768px) {
  .main-container {
    /* for mobile front */
    padding: 0.5rem;
  }
  .flex {
    flex-direction: column;
    gap: 1rem;
  }
}

/* Hideen AdsRight on mobile and tablet */
@media (max-width: 768px) {
  .ads-right {
    display: none; 
  }
}
</style>

<script>
// Add a computed property to check for mobile/tablet
import { computed } from 'vue';

const isMobileOrTablet = computed(() => {
  return window.innerWidth <= 980; // Adjust the max-width as needed
});
</script>
