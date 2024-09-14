<script setup>
import Header from '../components/Header.vue';
import Post from '../components/Post.vue';
import Aside from '../../src/components/Aside.vue';
import AdsRight from '../components/AdsRight.vue';
</script>

<template>
  <main class="main-container">
    <Header />
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
    /* Adjust styles for mobile view */
    padding: 0.5rem;
  }
  .flex {
    flex-direction: column;
    gap: 1rem;
  }
}
</style>
