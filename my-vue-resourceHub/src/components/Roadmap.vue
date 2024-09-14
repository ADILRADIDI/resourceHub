<template>
  <Aside />  
  <div class="iframe-container">
    <iframe
      :src="roadmapUrl"
      width="100%"
      height="100%"
      frameborder="0"
      allowfullscreen
      title="Roadmap"
    ></iframe>
  </div>
</template>

<script>

import Aside from '../components/Aside.vue';

export default {
  props: {
    roadmapUrl: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>
.iframe-container {
  width: 100%;
  height: 100vh; /* Full viewport height */
  margin: 0;
  padding: 0;
  border: none;
  overflow: hidden;
}
</style>
