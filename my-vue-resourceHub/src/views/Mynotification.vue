<script setup>
import Notification from '@/components/Notification.vue';
import Header from '@/components/Header.vue';
import HeaderA from '../components/HeaderA.vue';
// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<template>
  <main class="main-container">
        <Header v-if="!tokenExists" />
        <HeaderA v-else="tokenExists" />
        <Notification />
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>