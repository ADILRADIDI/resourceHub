<script setup>
import Header from '../components/Header.vue';
import Post from '../components/Post.vue';
import Aside from '../components/Aside.vue';
import HeaderA from '../components/HeaderA.vue';
import AdsRight from '../components/AdsRight.vue';
</script>

<template>
  <main class="main-container">
    <Header />
    <!-- <HeaderA /> -->
    <div class="flex ">
      <Aside />
      <Post />
      <AdsRight />
    </div>
    <!-- <ReadingList /> -->
    
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>