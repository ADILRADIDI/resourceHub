<script setup>
import TagsComponent from '../components/TagsComponent.vue';
import HeaderA from '../components/HeaderA.vue';
import Aside from '../components/Aside.vue';

</script>

<template>
    <HeaderA />
    <div class="flex flex-col lg:flex-row">
    <Aside class="lg:w-1/4" />
    <div class="lg:w-3/4 flex-1 p-4">
      <TagsComponent />
    </div>
  </div>
</template>

<style>
</style>