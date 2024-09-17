<template>
  <div class="crash-course-page relative">
    <!-- Background Video -->
    <video autoplay muted loop class="background-video absolute inset-0 object-cover z-0 w-full h-full">
      <source src="" type="video/mp4" />
      Your browser does not support the video tag.
    </video>

    <!-- Overlay -->
    <div class="overlay absolute inset-0 bg-white opacity-50 z-10"></div>

    <!-- Content with videos -->
    <div class="content-container relative z-20 mx-4 sm:mx-8 py-12">
      <!-- Video List (3 per row) -->
      <div class="videos-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="video in filteredVideos"
          :key="video.id"
          class="video-card bg-white shadow-lg border border-gray-300 rounded-lg p-1"
        >
          <!-- Thumbnail and Play button -->
          <div class="relative video-thumbnail">
            <img :src="`https://i.ytimg.com/vi/${video.videoId}/hq720.jpg`" class="w-full h-48 sm:h-60 mb-4 rounded-lg object-cover" alt="Video Thumbnail" />
            <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white px-2 py-1 text-xs rounded">{{ video.duration }}</div>
            <div class="play-button absolute inset-0 flex items-center justify-center">
              <button @click="openModal(video.videoId)" class="text-white text-3xl sm:text-4xl">▶</button>
            </div>
          </div>
          <!-- Video info -->
          <h2 class="font-semibold text-lg text-gray-800">{{ video.title }}</h2>
          <!-- <p class="text-sm text-gray-600">{{ video.creator }}</p> -->
          <p class="text-sm text-gray-500 my-3">{{ video.creator }}  |  {{ video.duration }}  |  {{ video.views }} views</p>
        </div>
      </div>
    </div>

    <!-- Modal for playing video -->
    <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
      <div class="relative bg-white p-4 rounded-lg w-11/12 md:w-3/4 lg:w-2/3 h-11/12 md:h-3/4 lg:h-3/4">
        <button @click="closeModal" class="absolute top-2 right-2 text-black text-2xl font-bold">&times;</button>
        <iframe
          :src="`https://www.youtube.com/embed/${selectedVideoId}?autoplay=1`"
          frameborder="0"
          allow="autoplay; encrypted-media"
          allowfullscreen
          class="w-full h-full"
        ></iframe>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const searchQuery = ref('');
const showModal = ref(false);
const selectedVideoId = ref('');

const videos = ref([
  { id: 1, title: 'SQL vs NoSQL: Understand the difference', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'Wgt3XOZ8CpM' },
  { id: 2, title: 'HTML crash course in 2 hours', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'Wgt3XOZ8CpM' },
  { id: 3, title: 'Enabling OpenAI to call functions in your app', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'Wgt3XOZ8CpM' },
  { id: 4, title: 'SQL vs NoSQL: Understand the difference', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'Wgt3XOZ8CpM' },
  { id: 5, title: 'HTML crash course in 2 hours', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'Wgt3XOZ8CpM' },
  { id: 6, title: 'Build Your First Gen AI Agent with Haystack', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'Wgt3XOZ8CpM' },
]);

const filteredVideos = ref(videos.value);

const openModal = (videoId) => {
  selectedVideoId.value = videoId;
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};
</script>

<style scoped>
.crash-course-page {
  position: relative;
  padding: 1rem;
}

.background-video {
  object-fit: cover;
  z-index: -1;
}

.overlay {
  z-index: 1;
}

.content-container {
  z-index: 2;
}

.videos-grid {
  grid-template-columns: repeat(1, minmax(0, 1fr));
}

@media (min-width: 640px) {
  .videos-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }
}

@media (min-width: 1024px) {
  .videos-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

.video-card {
  text-align: center;
}

.video-thumbnail {
  position: relative;
  cursor: pointer;
}

.video-thumbnail .play-button {
  display: none;
}

.video-thumbnail:hover .play-button {
  display: flex;
}

.play-button {
  background-color: rgba(0, 0, 0, 0.6);
  border-radius: 50%;
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
