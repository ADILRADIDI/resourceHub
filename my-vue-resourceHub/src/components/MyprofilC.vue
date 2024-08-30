<template>
  <div>
    <!-- Header Component -->

    <div class="profile-page container mx-auto p-4 md:p-6">
     
      <div class="flex flex-wrap bg-white rounded-lg items-center justify-center shadow-lg">
        <span class="crayons-avatar crayons-avatar--3xl">
            <img
              src="https://media.dev.to/cdn-cgi/image/width=320,height=320,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fuser%2Fprofile_image%2F1564448%2F9e3a5175-795f-4040-8813-8eeb6e22397f.jpeg"
              width="128"
              height="128"
              alt="ADIL RADIDI profile picture"
              class="crayons-avatar__image rounded-full mx-10 mt-5"
            />
          </span>
          <div class="skills  p-4 md:p-6  mt-6">
                <h1 class="text-xl md:text-2xl font-bold text-gray-900 xl:text-3xl lg:text-2xl">ADIL RADIDI</h1>
                <p class="text-base md:text-lg text-gray-700 mt-1">Développeur Full Stack Junior spécialisé dans la pile Vue.js / Laravel</p>
                <p class="text-sm text-gray-500 mt-1">Casablanca, Morocco</p>
                <p class="text-sm text-gray-500 mt-1">Joined on Jun 2, 2024</p>
                <a :href="website" class="text-blue-600 hover:underline mt-2 block">{{ website }}</a>
          </div>
    </div>
      <!-- Skills and Languages -->
      <div class="skills bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-900">Skills/Languages</h2>
        <p class="text-gray-700 mt-2">Laravel, Vue.js, Next.js, UML, JavaScript, PHP, HTML5 & CSS, Tailwind CSS, Bootstrap, SQL, MySQL</p>
      </div>

      <!-- Stats -->
      <div class="stats bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="posts flex flex-col items-center">
          <h3 class="text-base md:text-lg font-semibold text-gray-900">Posts Published</h3>
          <p class="text-gray-700 text-lg md:text-xl font-bold">{{ posts.length }}</p>
        </div>
        <div class="comments flex flex-col items-center">
          <h3 class="text-base md:text-lg font-semibold text-gray-900">Comments Written</h3>
          <p class="text-gray-700 text-lg md:text-xl font-bold">2</p>
        </div>
        <div class="tags flex flex-col items-center">
          <h3 class="text-base md:text-lg font-semibold text-gray-900">Tags Followed</h3>
          <p class="text-gray-700 text-lg md:text-xl font-bold">21</p>
        </div>
      </div>

      <!-- Recent Comments -->
      <div class="recent-comments bg-white p-4 md:p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-lg md:text-xl font-semibold text-gray-900">Recent Comments</h2>
        <div v-for="comment in comments" :key="comment.id" class="comment bg-gray-100 p-3 md:p-4 rounded-lg mb-4 border-l-4 border-blue-500">
          <p class="text-gray-700">{{ comment.text }}</p>
          <p class="text-sm text-gray-500 mt-2">{{ comment.date }}</p>
        </div>
      </div>

      <!-- Posts Section -->
      <div class="posts-section flex flex-col md:flex-row gap-6 mt-6">
        <!-- User's Posts -->
        <div class="posts bg-white p-4 md:p-6 rounded-lg shadow-lg flex-1">
          <h2 class="text-lg md:text-xl font-semibold text-gray-900">My Posts</h2>
          <div v-for="post in posts" :key="post.id" class="post bg-gray-100 p-3 md:p-4 rounded-lg mb-4">
            <h3 class="text-base md:text-lg font-bold text-gray-900">{{ post.title }}</h3>
            <p class="text-gray-700">{{ post.excerpt }}</p>
            <router-link :to="`/p/${post.id}`" class="text-blue-600 hover:underline mt-2 block">Read more</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import HeaderA from '../components/HeaderA.vue'; // Adjust the path according to your folder structure

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

// User profile data
const website = 'https://adilradidi.netlify.app/';
</script>

<style scoped>
.profile-page {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.cover {
  position: relative;
}

.profile-info {
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.crayons-avatar__image {
  border: 4px solid #ffffff; /* White border around the profile picture */
}

.skills, .stats, .recent-comments, .posts, .aside {
  margin-top: 1.5rem;
}

.comment {
  border-left: 4px solid #4f46e5; /* Blue line on the left for recent comments */
}

.stats {
  grid-template-columns: 1fr;
  gap: 1rem;
}

.posts-section {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.posts {
  flex: 2;
}

.aside {
  flex: 1;
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
