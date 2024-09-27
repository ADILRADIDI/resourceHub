<template>
    <div class="flex">
      <Sidebar class="lg:w-56 w-full" />
      <div class="flex-1 p-4">
        <sugPodcast class="xl:ml-72 md:ml-56" />
      </div>
    </div>
  </template>
  
  <script setup>
  import Sidebar from '@/components/AdminComponents/Sidebar.vue';
  import sugPodcast from '@/components/AdminComponents/manageSuggeted/sugPodcast.vue';
  </script>
  
  <style>
  /* Add any additional styles if necessary */
  </style>
  