<script setup>
// Import the components
import Header from '../components/Header.vue';
// header in user is authentecated okay => token is here
import HeaderA from '../components/HeaderA.vue';
import Post from '../components/Post.vue';
import Aside from '../../src/components/Aside.vue';
import AdsRight from '../components/AdsRight.vue';

// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<template>
  <!-- const tokenExists = localStorage.getItem('user-token'); -->
  <Header v-if="!tokenExists" />
  <HeaderA v-else="tokenExists" />
  <main class="main-container">
    <div class="flex gap-5">
      <Aside class="mt-8" />
      <Post />
      <AdsRight />
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
    /* Adjust styles for mobile front */
    padding: 0.5rem;
  }
  .flex {
    flex-direction: column;
    gap: 1rem;
  }
}
</style>
