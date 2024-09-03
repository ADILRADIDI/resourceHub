<script setup>
import Podcast from '../components/Podcast.vue';
import HeaderA from '../components/HeaderA.vue';
</script>

<template>
  <main class="main-container">
    <HeaderA />
    <Podcast />
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>