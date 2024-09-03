<template>
  <div :style="{ backgroundColor: userColorSettings.background }">

    <div class="profile-page container mx-auto p-4 md:p-6">
      <div class="flex flex-wrap bg-white rounded-lg items-center justify-center shadow-lg">
        <span class="crayons-avatar crayons-avatar--3xl">
          <img
            :src="userProfile.image"
            width="128"
            height="128"
            :alt="`${userProfile.name} profile picture`"
            class="crayons-avatar__image rounded-full mx-10 mt-5"
          />
        </span>
        <div class="skills p-4 md:p-6 mt-6">
          <h1 class="text-xl md:text-2xl font-bold text-gray-900 xl:text-3xl lg:text-2xl">{{ userProfile.name }}</h1>
          <p class="text-base md:text-lg text-gray-700 mt-1">{{ userProfile.description }}</p>
          <p class="text-sm text-gray-500 mt-1">{{ userProfile.location }}</p>
          <p class="text-sm text-gray-500 mt-1">Joined on {{ userProfile.joinDate }}</p>
          <a :href="userProfile.website" class="text-blue-600 hover:underline mt-2 block">{{ userProfile.website }}</a>
        </div>
      </div>

      <!-- Skills and Languages -->
      <div class="skills bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-900">Skills/Languages</h2>
        <p class="text-gray-700 mt-2">{{ userProfile.skills }}</p>
      </div>

      <!-- Stats -->
      <div class="stats bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="comments flex flex-col items-center">
          <h3 class="text-base md:text-lg font-semibold text-gray-900">Posts Published</h3>
          <p class="text-gray-700 text-lg md:text-xl font-bold">{{ posts.length }}</p>
        </div>
        <div class="comments flex flex-col items-center">
          <h3 class="text-base md:text-lg font-semibold text-gray-900">Comments Written</h3>
          <p class="text-gray-700 text-lg md:text-xl font-bold">{{ comments.length }}</p>
        </div>
        <div class="tags flex flex-col items-center">
          <h3 class="text-base md:text-lg font-semibold text-gray-900">Tags Followed</h3>
          <p class="text-gray-700 text-lg md:text-xl font-bold">{{ userProfile.tagsFollowed }}</p>
        </div>
      </div>

      <!-- Recent Comments -->
      <div class="recent-comments bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-900 mb-4">Recent Comments</h2>
        <div v-for="comment in comments" :key="comment.id" class="comment bg-gray-100 p-3 md:p-4 rounded-lg mb-4 border-l-4" :style="{ borderColor: userColorSettings.accent }">
          <p class="text-gray-700">{{ comment.text }}</p>
          <p class="text-sm text-gray-500 mt-2">{{ comment.date }}</p>
        </div>
      </div>

      <!-- Posts Section -->
      <div class="posts-section flex flex-col md:flex-row gap-6 mt-6">
        <div class="posts bg-white p-4 md:p-6 rounded-lg shadow-lg flex-1">
          <h2 class="text-lg md:text-xl font-semibold text-gray-900 mb-4">My Posts</h2>
          <div v-for="post in posts" :key="post.id" class="post bg-gray-100 p-3 md:p-4 rounded-lg mb-4">
            <h3 class="text-base md:text-lg font-bold text-gray-900 hover:text-blue-600">{{ post.title }}</h3>
            <p class="text-gray-700">{{ post.excerpt }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// User profile data
const userProfile = ref({
  name: 'ADIL RADIDI',
  description: 'Développeur Full Stack Junior spécialisé dans la pile Vue.js / Laravel',
  location: 'Casablanca, Morocco',
  joinDate: 'Jun 2, 2024',
  website: 'https://adilradidi.netlify.app/',
  image: 'https://media.dev.to/cdn-cgi/image/width=320,height=320,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fuser%2Fprofile_image%2F1564448%2F9e3a5175-795f-4040-8813-8eeb6e22397f.jpeg',
  skills: 'Laravel, Vue.js, Next.js, UML, JavaScript, PHP, HTML5 & CSS, Tailwind CSS, Bootstrap, SQL, MySQL',
  tagsFollowed: 21,
});

// Sample posts data
const posts = ref([
  { id: 1, title: 'Sample Post Title 1', excerpt: 'This is a brief summary of the post content 1.' },
  { id: 2, title: 'Sample Post Title 2', excerpt: 'This is a brief summary of the post content 2.' },
  { id: 3, title: 'Sample Post Title 3', excerpt: 'This is a brief summary of the post content 3.' },
]);

// Sample comments data
const comments = ref([
  { id: 1, text: 'Introduction to Azure with .NET Examples', date: 'Jul 25' },
  { id: 2, text: 'Laravel 8 - Audit for Beginners (5 easy steps) ✍🏻📒💾', date: 'Jun 5' },
]);

// User customizable settings for colors
const userColorSettings = ref({
  background: '#F5F5E2', // Default background color
  accent: '#4f46e5', // Default accent color
});
</script>

<style scoped>
.profile-page {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.crayons-avatar__image {
  border: 4px solid #ffffff; /* White border around the profile picture */
}

.skills, .stats, .recent-comments, .posts, .aside {
  margin-top: 1.5rem;
}

.comment {
  border-left-width: 4px;
}

.posts-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.posts {
  flex: 2;
}

@media (min-width: 768px) {
  .stats {
    grid-template-columns: repeat(3, 1fr);
  }
  .posts-section {
    flex-direction: row;
  }
}
</style>
