<template>
  <div class="min-h-screen bg-gradient-to-b from-white-500 to-white flex flex-col items-center p-8">
    <div class="block">
  <!-- Header -->
  <header class="text-center mb-8">
    <div class="flex justify-around items-center mx-5 px-5 gap-96" style="margin: 20px;">
      <h1 class="text-black text-4xl font-bold">Podcasts</h1>
      <button 
        @click="showSuggestForm = !showSuggestForm" 
        class="mt-4 px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
      >
        {{ showSuggestForm ? 'Hide Suggest Form' : 'Suggest a Podcast' }}
      </button>
    </div>
  </header>

  <!-- Suggest a Tag Form -->
  <div v-if="showSuggestForm" class="suggest-tag-form mb-8 p-4 border rounded-lg shadow-lg bg-white mx-5 w-full max-w-3xl" style="margin: 20px;">
    <h2 class="text-xl font-semibold mb-4">Suggest a Podcast</h2>
    <div class="mb-4">
      <input
        v-model="newTagName"
        type="text"
        placeholder="Podcast Name"
        class="w-full p-2 border rounded-lg"
      />
    </div>
    <button
      @click="suggestTag"
      class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg"
    >
      Add Tag
    </button>
  </div>
</div>


    <!-- Podcast Cards -->
    <div class="flex flex-wrap gap-6 justify-center mb-60">
      <div
        v-for="(podcast, index) in podcasts"
        :key="index"
        class="relative w-[22%] min-w-[200px] bg-white rounded-lg shadow-lg overflow-hidden group"
      >
        <img
          :src="podcast.image"
          alt="Podcast Image"
          class="w-full h-50 object-cover"
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
          :src="currentPodcast.image"
          alt="Podcast Image"
          class="w-16 h-16 object-cover rounded-lg"
        />
        <div class="flex-grow">
          <h2 class="text-lg font-semibold">{{ currentPodcast.title }}</h2>
          <p class="text-gray-600">{{ currentPodcast.creator }}</p>
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
      </div>

      <!-- Time and Progress Bar -->
      <div class="w-full flex justify-between text-gray-600 text-sm">
        <span>{{ formatTime(audio ? audio.currentTime : 0) }}</span>
        <span>{{ formatTime(audio ? audio.duration : 0) }}</span>
      </div>
      <div class="w-full bg-gray-200 rounded-full h-2 relative mt-2" @click="seek($event)">
        <div
          class="absolute top-0 left-0 h-full bg-blue-300 rounded-full"
          :style="{ width: progress + '%' }"
        ></div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      podcasts: [
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
      ],
      showSuggestForm: false,
      isPlaying: false,
      currentPodcast: null,
      progress: 0,
      audio: null,
      intervalId: null,
    };
  },
  methods: {
    suggestTag() {
      if (this.newTagName.trim() === '') return;

      console.log(`Suggested Tag: ${this.newTagName}`);
      this.newTagName = '';
      this.showSuggestForm = false;
    },
    playPodcast(podcast) {
      if (this.currentPodcast === podcast) {
        this.togglePlayPause();
        return;
      }

      this.currentPodcast = podcast;
      this.isPlaying = true;
      this.audio = new Audio(podcast.audioSrc);
      this.audio.play();

      this.audio.ontimeupdate = () => {
        this.progress = (this.audio.currentTime / this.audio.duration) * 100;
      };

      this.audio.onended = () => {
        this.isPlaying = false;
        this.progress = 0;
        clearInterval(this.intervalId);
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
    seek(event) {
      const progressBar = event.currentTarget;
      const clickX = event.offsetX;
      const newTime = (clickX / progressBar.offsetWidth) * this.audio.duration;
      this.audio.currentTime = newTime;
    },
    formatTime(seconds) {
      const minutes = Math.floor(seconds / 60);
      const remainingSeconds = Math.floor(seconds % 60);
      return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    },
  },
};
</script>