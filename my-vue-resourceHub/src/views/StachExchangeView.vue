<script setup>
import StackExchange from '../components/StackExchange.vue';
import HeaderA from '../components/HeaderA.vue';
import Header from '../components/Header.vue';
import Aside from '@/components/Aside.vue';
const tokenExists = localStorage.getItem('user-token');
</script>

<template>
  <main class="main-container2 ">
    <Header v-if="!tokenExists" class="shadow-sm"   />
    <HeaderA v-else="tokenExists" class="shadow-sm"  />
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