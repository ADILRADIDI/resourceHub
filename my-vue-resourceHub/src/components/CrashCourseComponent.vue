<template>
    <div class="crash-course-page relative">
      <!-- Background Video -->
      <video autoplay muted loop class="background-video absolute inset-0 w-full h-full object-cover z-0">
        <source src="" type="video/mp4" />
        Your browser does not support the video tag.
      </video>
  
      <div class="overlay absolute inset-0 bg-black opacity-50 z-10"></div>
  
      <div class="content-container relative z-20 mx-8 py-12">
        <h1 class="font-bold text-4xl text-white mb-6 text-center">Learn Programming</h1>
  
        <!-- Search Bar -->
        <div class="search-bar mb-8 flex justify-center">
          <input
            type="text"
            v-model="searchQuery"
            placeholder="Enter a programming language"
            class="w-1/2 p-3 border border-gray-300 rounded-lg text-black"
          />
          <button
            @click="fetchCrashCourses"
            class="ml-4 px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
          >
            Search
          </button>
        </div>
  
        <!-- Video List -->
        <div class="videos-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <div
            v-for="video in filteredVideos"
            :key="video.id"
            class="video-card bg-white shadow-lg border border-gray-300 rounded-lg p-4"
          >
            <div class="relative video-thumbnail">
              <img
                :src="`https://i.ytimg.com/vi/Wgt3XOZ8CpM/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBuM-1ceJoJe0uHbfj_w9hdRnNOiQ`"
                class="w-full h-60 w-80 mb-4 rounded-lg object-cover"
                alt="Video Thumbnail"
              />
              <div class="play-button absolute inset-0 flex items-center justify-center">
                <button @click="playVideo(video.videoId)" class="text-white text-2xl">
                  ▶
                </button>
              </div>
            </div>
            <h2 class="font-semibold text-lg text-gray-800">{{ video.title }}</h2>
            <p class="text-sm text-gray-600">{{ video.creator }}</p>
            <p class="text-sm text-gray-500">{{ video.duration }} | {{ video.views }} views</p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const searchQuery = ref('');
  const videos = ref([
    // Sample video data
    { id: 1, title: 'SQL vs NoSQL: Understand the difference', creator: 'Carlos Filho', duration: '05:50', views: '10K', videoId: 'example1' },
    { id: 2, title: 'Build Your First Gen AI Agent with Haystack', creator: 'code with Abdejabar', duration: '1:19:01', views: '5K', videoId: 'example2' },
    { id: 3, title: 'Enabling OpenAI to call functions in your app', creator: 'code with Salma', duration: '10:25', views: '12K', videoId: 'example3' },
    { id: 4, title: 'Enabling OpenAI to call functions in your app', creator: 'Marcus Yassine', duration: '10:25', views: '12K', videoId: 'example3' },
    { id: 5, title: 'Enabling OpenAI to call functions in your app', creator: 'Marcus Omar', duration: '10:25', views: '12K', videoId: 'example3' },
    { id: 6, title: 'Enabling OpenAI to call functions in your app', creator: 'Marcus Kohlberg', duration: '10:25', views: '12K', videoId: 'example3' },
    { id: 7, title: 'Enabling OpenAI to call functions in your app', creator: 'Marcus Kohlberg', duration: '10:25', views: '12K', videoId: 'example3' },
    { id: 8, title: 'HTML crash cours in 2hour', creator: 'code with aymen', duration: '10:25', views: '12K', videoId: 'example3' },
    // Add more video data
  ]);
  
  const fetchCrashCourses = () => {
    // Filter videos based on the search query
    filteredVideos.value = videos.value.filter(video =>
      video.title.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  };
  
  const playVideo = (videoId) => {
    const videoUrl = `https://www.youtube.com/embed/${videoId}`;
    window.open(videoUrl, '_blank');
  };
  
  const filteredVideos = ref(videos.value);
  </script>
  
  <style scoped>
  .crash-course-page {
    position: relative;
    padding: 1rem;
  }
  
  .background-video {
    z-index: -1;
  }
  
  .overlay {
    z-index: 1;
  }
  
  .content-container {
    z-index: 2;
  }
  
  .search-bar input {
    background-color: rgba(255, 255, 255, 0.9);
  }
  
  .videos-grid {
    display: grid;
    grid-template-columns: repeat(1, minmax(0, 1fr));
  
    /* Grid for larger screens */
    @media (min-width: 640px) {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    @media (min-width: 1024px) {
      grid-template-columns: repeat(4, minmax(0, 1fr));
    }
  }
  
  .video-card {
    text-align: center;
  }
  
  .video-card h2 {
    font-size: 1.125rem;
    color: #2d3748;
  }
  
  .video-card p {
    margin-top: 0.25rem;
    color: #718096;
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
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    width: 60px;
    height: 60px;
  }
  </style>
  