<script setup>
import Ytchannels from '../components/Ytchannels.vue';
import Header from '../components/Header.vue';
import Aside from '@/components/Aside.vue';

import HeaderA from '../components/HeaderA.vue';

// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<template>
  <Header v-if="!tokenExists" />
  <HeaderA v-else="tokenExists" />
  <div class="flex flex-col lg:flex-row">
    <Aside class="lg:w-1/4" />
    <div class="lg:w-3/4 flex-1 p-4">
      <Ytchannels />
    </div>
  </div>
</template>

<style>
/* Additional styling for layout if needed */
</style>
