<script setup>
import CrashCourseComponent from '../components/CrashCourseComponent.vue';
import HeaderA from '../components/HeaderA.vue';
import Header from '../components/Header.vue';
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
        <CrashCourseComponent/>
      </div>
    </div>
</template>

<style>
</style>