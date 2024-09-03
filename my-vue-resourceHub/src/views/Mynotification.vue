<script setup>
import Notification from '@/components/Notification.vue';
import HeaderA from '@/components/HeaderA.vue';
</script>

<template>
  <main class="main-container">
        <HeaderA />
        <Notification />
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>