<script setup>
import StackExchange from '../components/StackExchange.vue';
import HeaderA from '../components/HeaderA.vue';
import Aside from '@/components/Aside.vue';
</script>

<template>
  <main class="main-container2 ">
    <HeaderA class="shadow-sm" />
    <div class="flex flex-col lg:flex-row">
      <Aside class="lg:w-1/4" />
      <div class="lg:w-3/4 flex-1 p-4">
        <StackExchange />
      </div>
    </div>
  </main>
</template>
 
<style> 
.main-container2 {
  background-color: #f3f4f6;
  min-height: 100vh;
}
</style>