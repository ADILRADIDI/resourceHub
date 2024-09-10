<script setup>
import Podcast from '../components/Podcast.vue';
import HeaderA from '../components/HeaderA.vue';
import Aside from '../components/Aside.vue';

</script>

<template>
  <main class="main-container">
    <HeaderA />
    <div class="flex">
      <Aside />
      <Podcast />
    </div>
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>