<script setup>
import HeaderA from '../components/HeaderA.vue';
import DetailPost from '@/components/DetailPost.vue';
</script>

<template>
    <HeaderA />
  <main class="main-container">
    <DetailPost />
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>