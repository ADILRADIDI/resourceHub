<script setup>
import StackExchange from '../components/StackExchange.vue';
import HeaderA from '../components/HeaderA.vue';
import Aside from '@/components/Aside.vue';
</script>

<template>
  <main class="main-container2">
    <!-- <HeaderA /> -->
    <div class="flex">
      <Aside />
      <StackExchange />
    </div>
  </main>
</template>

<style>
.main-container2 {
  background-color: #000;
  min-height: 100vh;
}
</style>