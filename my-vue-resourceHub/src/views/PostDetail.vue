<script setup>
import HeaderA from '../components/HeaderA.vue';
import Header from '../components/Header.vue';
import DetailPost from '@/components/DetailPost.vue';
import Aside from '../components/Aside.vue';

// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<template> 
  <Header v-if="!tokenExists" />
  <HeaderA v-else="tokenExists" />
  <div class="flex flex-col lg:flex-row bg-white">
      <Aside class="lg:w-1/4" />
      <div class="lg:w-3/4 flex-1 p-4"> 
        <DetailPost/>
      </div>
    </div>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style> 