<script setup>
import HeaderA from '../components/HeaderA.vue';
import Header from '../components/Header.vue';
import Aside from '../components/Aside.vue';
import MyprofilC from '../components/MyprofilC.vue';

// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<template> 
  <main class="main-container">
      <Header v-if="!tokenExists" />
      <HeaderA v-else="tokenExists" />
    <div class="flex flex-col lg:flex-row"> 
      <Aside class="lg:w-1/4 mt-3" />
      <div class="lg:w-3/4 flex-1 p-4">
        <MyprofilC />
      </div>
    </div>
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style> 