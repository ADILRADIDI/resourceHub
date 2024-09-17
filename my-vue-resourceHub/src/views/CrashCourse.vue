<script setup>
import CrashCourseComponent from '../components/CrashCourseComponent.vue';
import HeaderA from '../components/HeaderA.vue';
import Aside from '../components/Aside.vue';

</script>

<template>
    <HeaderA />
     <!-- <div class="flex bg-black">
         <Aside class="h-1/2 mt-9" />
         <CrashCourseComponent />
     </div> -->
     <div class="flex flex-col lg:flex-row bg-white">
      <Aside class="lg:w-1/4" />
      <div class="lg:w-3/4 flex-1 p-4">
        <CrashCourseComponent/>
      </div>
    </div>
</template>

<style>
</style>