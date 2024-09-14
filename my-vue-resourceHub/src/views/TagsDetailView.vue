<template>
    <Header />
    <div class="flex items-start">
      <Aside class="mt-10 mb-10" />
      <div class="ml-10 w-full">
        <TagsDetail />
      </div>
    </div>
  </template>
  
  <script setup>
  import TagsDetail from '../components/TagsDetail.vue';
  import Aside from '../components/Aside.vue';
  </script>
  
  <style>
  /* Add custom styles if needed */
  </style>
  