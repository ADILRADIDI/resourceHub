<template>
    <div class="flex">
      <Sidebar class="lg:w-56 w-full" />
      <div class="flex-1 p-4">
        <Mpermissions class="lg:ml-44 md:ml-16" />
      </div>
    </div>
  </template>
  
  <script setup>
  import Sidebar from '@/components/AdminComponents/Sidebar.vue';
  import Mpermissions from '@/components/AdminComponents/manageUsers.vue/Mpermissions.vue';
  </script>
  
  <style>
  /* Add any additional styles if necessary */
  </style>
  