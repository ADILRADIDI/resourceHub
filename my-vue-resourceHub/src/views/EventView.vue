<script setup>
import Aside from '@/components/Aside.vue';
import EventC from '../components/EventC.vue';
import HeaderA from '../components/HeaderA.vue';
</script>

<template>
  <main class="main-container">

    <HeaderA />
    <div class="flex">
      <Aside />
      <EventC />
    </div>
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>