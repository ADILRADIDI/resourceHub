<template>
  <main class="main-container">
    <Header v-if="!tokenExists" />
    <HeaderA v-else="tokenExists" />
    <div class="flex flex-col lg:flex-row">
      <Aside class="lg:w-1/4 mt-12 ml-5" />
      <div class="lg:w-3/4 flex-1 p-4">
        <Resources />
      </div>
    </div>
  </main> 
</template>

<script setup>
import Resources from '../components/Resources.vue';
import HeaderA from '../components/HeaderA.vue';
import Aside from '../components/Aside.vue';

import Header from '../components/Header.vue';

// Check if the token exists in localStorage
const tokenExists = localStorage.getItem('user-token');
</script>

<style>
.main-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.flex {
  display: flex;
}

.flex-col {
  flex-direction: column;
}

.flex-row {
  flex-direction: row;
}

@media (max-width: 768px) {
  .flex-col {
    flex-direction: column;
  }
}

@media (min-width: 768px) {
  .lg:flex-row {
    flex-direction: row;
  }
}

.lg\:w-1\/4 {
  width: 25%;
}

.lg\:w-3\/4 {
  width: 75%;
}

.p-4 {
  padding: 1rem;
}

.mt-16 {
  margin-top: 4rem;
}

@media (max-width: 768px) {
  .lg\:w-1\/4 {
    width: 100%;
  }

  .lg\:w-3\/4 {
    width: 100%;
  }
}
</style>
