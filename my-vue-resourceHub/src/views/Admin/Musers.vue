<script setup>
import Sidebar from '@/components/AdminComponents/Sidebar.vue';
import Musers from '../../components/AdminComponents/manageUsers.vue/Musers.vue';
</script>

<template>
  <div class="flex">
    <Sidebar class="lg:w-56 w-full" />
    <div class="flex-1 p-4">
      <Musers class="lg:ml-44 md:ml-16" />
    </div>
  </div>
</template>

<style>
/* Add any additional styles if necessary */
</style>
