<script setup>
import Header from '../components/Header.vue';
import Aside from '../../src/components/Aside.vue';
import FastFix from '../../src/components/FastFix.vue';

import HeaderA from '../components/HeaderA.vue';
// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');

</script>

<template>
  <Header v-if="!tokenExists" class="shadow-sm"   />
  <HeaderA v-else="tokenExists" class="shadow-sm"  />
  <main class="main-container">
    <div class="flex flex-col lg:flex-row">
      <Aside class="lg:w-1/4" />
      <div class="lg:w-3/4 flex-1 p-4"> 
        <FastFix class="" />
      </div>
    </div>
  </main>
</template>

<style scoped>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
  padding: 1rem; 
}

@media (max-width: 768px) {
  .main-container {
    padding: 0.5rem;
  }
  .flex {
    flex-direction: column;
    gap: 1rem;
  }
}
</style>
