<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-500 to-blue-700 flex flex-col items-center p-8">
    <!-- Header -->
    <header class="text-center mb-8">
      <div class="flex flex-col items-center mx-5">
        <h1 class="text-white text-4xl font-bold">Podcasts</h1>
        <button 
          @click="showSuggestForm = !showSuggestForm" 
          class="mt-4 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-lg"
        >
          {{ showSuggestForm ? 'Hide Suggest Form' : 'Suggest a Tag' }}
        </button>
      </div>
    </header>


    <!-- Suggest a Tag Form -->
    <div v-if="showSuggestForm" class="suggest-tag-form mb-8 p-4 border rounded-lg shadow-lg bg-white mx-5 w-full max-w-3xl">
      <h2 class="text-xl font-semibold mb-4">Suggest a Tag</h2>
      <div class="mb-4">
        <input
          v-model="newTagName"
          type="text"
          placeholder="Tag Name"
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
      <!-- Progress Bar -->
      <div class="w-full bg-gray-200 rounded-full h-2 relative mt-2">
        <div
          class="absolute top-0 left-0 h-full bg-green-200 rounded-full"
          :style="{ width: progress + '%' }"
        ></div>
      </div>
    </div>

    <!-- Suggest Modal -->
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Suggest a Tag</h2>
        <div class="mb-4">
          <input
            v-model="newTagName"
            type="text"
            placeholder="Tag Name"
            class="w-full p-2 border rounded-lg"
          />
        </div>
        <div class="flex justify-end">
          <button
            @click="suggestTag"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg mr-2"
          >
            Add Tag
          </button>
          <button
            @click="showModal = false"
            class="px-4 py-2 bg-gray-300 text-black font-semibold rounded-lg shadow-lg"
          >
            Close
          </button>
        </div>
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
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1a',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR6494492862.mp3?updated=1656502985',
        },
        {
          title: 'Learning AI 1',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=500,height=500,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F235%2F08786d8b-7ef4-4c00-bc40-f4b3cbca5834.jpg',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1a',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=500,height=500,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
        {
          title: 'Learning AI 1a',
          creator: 'Matt Eland',
          image: 'https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F578%2Fc0bcc435-8bbf-4246-a1ab-c20cefb76492.png',
          audioSrc: 'https://dts.podtrac.com/redirect.mp3/traffic.megaphone.fm/FOR8835558149.mp3?updated=1716333932',
        },
      ],
      showSuggestForm: false,
      showModal: false,
      newTagName: '',
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

      // Implement the tag suggestion logic here
      console.log(`Suggested Tag: ${this.newTagName}`);

      this.newTagName = '';
      this.showSuggestForm = false;
      this.showModal = false;
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

      this.intervalId = setInterval(() => {
        if (this.audio) {
          this.progress = (this.audio.currentTime / this.audio.duration) * 100;
        }
      }, 1000);

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
  },
};
</script>

<style scoped>
/* Add any additional styling here */
</style>
