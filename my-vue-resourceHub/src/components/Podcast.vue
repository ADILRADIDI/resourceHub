<template>
  <div class="min-h-screen bg-gradient-to-b from-white-500 to-white flex flex-col items-center p-8">
    <div class="block">
      <!-- Header -->
      <header class="text-center mb-8">
        <div class="flex justify-between items-center px-5 gap-8">
          <h1 class="text-black text-4xl font-bold">Podcasts</h1>
          <button 
            @click="showSuggestModal = true" 
            class="mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
          >
            Suggest a Podcast
          </button>
        </div>
      </header>

      <!-- Podcast Cards -->
      <div class="flex flex-wrap gap-6 justify-center mb-60">
        <div
          v-for="(podcast, index) in podcasts"
          :key="index"
          class="relative w-[20%] min-w-[300px] bg-white rounded-lg shadow-lg overflow-hidden group"
          >
          <!-- :src="podcast.image || '/path/to/fallback-image.jpg'" -->
          <img
          src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfxb_7hjSM1Icn16P9Ew72fJZ18BZL5nzXznjAR2S6dCl7faTLaxIEFl2wrIbTozq_Y8w&usqp=CAU"
            alt="Podcast Image"
            class="w-full h-50 object-cover rounded-lg"
          />
          <div class="p-4">
            <h2 class="text-lg font-semibold truncate">{{ podcast.title }}</h2>
            <p class="text-gray-600">{{ podcast.creator }}</p>
          </div>
          <div
            class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity"
          >
            <button
              class="text-white text-4xl"
              @click.stop="playPodcast(podcast)"
            >
              <svg width="48" height="48" fill="currentColor">
                <path v-if="isPlaying && currentPodcast === podcast" d="M8 5v14l11-7L8 5z" />
                <path v-else d="M6 4l12 8-12 8z" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Audio Player -->
      <div
        v-if="currentPodcast"
        class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg p-4 flex flex-col items-center"
      >
        <div class="flex items-center space-x-4 mb-2">
          <img
            :src="currentPodcast.image || '/path/to/fallback-image.jpg'"
            alt="Podcast Image"
            class="w-16 h-16 object-cover rounded-lg"
          />
          <div class="flex-grow">
            <h2 class="text-lg font-semibold">{{ currentPodcast.title }}</h2>
          </div>
          <button
            @click="togglePlayPause"
            class="bg-blue-500 text-white rounded-full p-2"
          >
            <svg width="24" height="24" fill="currentColor">
              <path v-if="isPlaying" d="M6 6v12h4V6H6zm8 0v12h4V6h-4z" />
              <path v-else d="M6 6v12h12V6H6z" />
            </svg>
          </button>
          <button
            @click="toggleMute"
            class="bg-blue-500 text-white rounded-full flex items-center justify-center w-10 h-10"
          >
            <span v-if="isMuted" class="material-symbols-outlined">volume_up</span>
            <span v-else class="material-symbols-outlined">volume_off</span>
          </button>
        </div>

        <!-- Time and Progress Bar -->
        <div class="w-full flex justify-between text-gray-600 text-sm">
          <span>{{ formatTime(audio ? audio.currentTime : 0) }}</span>
          <span>{{ formatTime(audio ? audio.duration : 0) }}</span>
        </div>
        
        <div class="w-full bg-gray-200 rounded-full h-2 relative mt-2" @click="seek($event)">
          <div
            class="absolute top-0 left-0 h-full bg-blue-600 rounded-full"
            :style="{ width: progress + '%' }"
          ></div>
        </div>
      </div>
    </div>

    <!-- Suggest a Podcast Modal -->
    <div v-if="showSuggestModal" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md mx-4 md:mx-0">
        <h2 class="text-xl font-semibold mb-4">Suggest a Podcast</h2>
        <div class="mb-4">
          <input
            v-model="title"
            type="text"
            placeholder="Podcast Name"
            class="w-full p-2 border rounded-lg"
          />
        </div>
        <button
          @click="suggestTag"
          class="px-4 py-2 mr-3 bg-blue-600 text-white font-semibold rounded-full shadow-lg"
        >
          Suggest Podcast
        </button>
        <button
          @click="showSuggestModal = false"
          class="px-4 py-2 bg-gray-600 text-white font-semibold rounded-full shadow-lg mt-4"
        >
          Close
        </button>
      </div>
    </div>
    <div v-if="showSuggestModal" class="fixed inset-0 bg-black bg-opacity-50"></div>
  </div>
</template>


<script>
import axios from 'axios';
import { API_BASE_URL, API_BASE_URL_WITHOUT } from '../config';

export default {
  data() {
    return {
      podcasts: [],
      showSuggestModal: false,
      isPlaying: false,
      isMuted: false,
      currentPodcast: null,
      progress: 0,
      audio: null,
      title: '',
    };
  },
  mounted() {
    const token = localStorage.getItem('user-token');
    this.fetchPodcasts(token);

    const lastPlayed = JSON.parse(localStorage.getItem('lastPlayedPodcast'));
    if (lastPlayed) {
      this.currentPodcast = lastPlayed;
      this.playPodcast(lastPlayed); // Auto-play option
    }

    window.addEventListener('beforeunload', this.stopPodcastOnRouteChange);
  },
  beforeDestroy() {
    window.removeEventListener('beforeunload', this.stopPodcastOnRouteChange);
    if (this.audio) {
      this.audio.pause();
    }
  },
  methods: {
    async fetchPodcasts(token) {
      try {
        const response = await axios.get(`${API_BASE_URL}podcasts`, {
          headers: { Authorization: `Bearer ${token}` },
        });

        this.podcasts = response.data.map((podcast) => {
          const imageUrl = podcast.logo
            ? `${API_BASE_URL_WITHOUT}storage/${podcast.logo}`
            : '/path/to/fallback-image.jpg';

          return { ...podcast, image: imageUrl };
        });
      } catch (error) {
        console.error('Error fetching podcasts:', error);
      }
    },
    async suggestTag() {
      if (this.title.trim() === '') return;

      this.stopPodcast();

      try {
        const token = localStorage.getItem('user-token');
        await axios.post(`${API_BASE_URL}suggested-podcasts`, {
          title: this.title,
        }, {
          headers: { Authorization: `Bearer ${token}` },
        });

        this.title = '';
        this.showSuggestModal = false;
        this.fetchPodcasts(token);
      } catch (error) {
        console.error('Error suggesting podcast:', error);
      }
    },
    playPodcast(podcast) {
      if (this.audio) {
        this.audio.pause();
      }

      if (this.currentPodcast === podcast) {
        this.togglePlayPause();
        return;
      }

      this.currentPodcast = podcast;
      this.isPlaying = true;
      this.audio = new Audio(podcast.audio_url);
      this.audio.muted = this.isMuted;
      this.audio.play();

      localStorage.setItem('lastPlayedPodcast', JSON.stringify(podcast));

      this.audio.ontimeupdate = () => {
        this.progress = (this.audio.currentTime / this.audio.duration) * 100;
      };

      this.audio.onended = () => {
        this.isPlaying = false;
        this.progress = 0;
        localStorage.removeItem('lastPlayedPodcast');
      };
    },
    togglePlayPause() {
      if (this.isPlaying) {
        this.audio.pause();
        this.isPlaying = false;
      } else {
        this.audio.play();
        this.isPlaying = true;
      }
    },
    toggleMute() {
      if (this.audio) {
        this.isMuted = !this.isMuted;
        this.audio.muted = this.isMuted;
      }
    },
    formatTime(seconds) {
      if (!isNaN(seconds)) {
        const minutes = Math.floor(seconds / 60);
        const secondsRemaining = Math.floor(seconds % 60);
        return `${minutes}:${secondsRemaining < 10 ? '0' : ''}${secondsRemaining}`;
      }
      return '0:00';
    },
    seek(event) {
      const seekBar = event.currentTarget;
      const clickPosition = event.clientX - seekBar.getBoundingClientRect().left;
      const newTime = (clickPosition / seekBar.offsetWidth) * this.audio.duration;
      this.audio.currentTime = newTime;
    },
    stopPodcastOnRouteChange() {
      if (this.audio) {
        this.audio.pause();
      }
    },
  },
};

</script>

<style scoped>
/* Add any component-specific styles here */
.bg-opacity-50 {
  background-color: rgba(0, 0, 0, 0.5);
}

.material-symbols-outlined {
  font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 48;
}

</style>
