<script setup>
// Import necessary Vue functionalities
import { ref, computed } from 'vue';

// Tags for filtering
const tags = ref([
  'php',
  'c#',
  'html',
  'css',
  'js',
  'Flutter',
  'Reactjs',
  'laravel',
  'vuejs',
  'angular',
  '.Net',
  'Kotlin',
  'eloquent',
  'python',
  'wordpress',
  'hosting',
  'instagram-api',
  'laravel-11',
]);

// Example questions data (to be replaced with your API data)
const posts = ref([
  {
    id: 78925152,
    title: 'Laravel UpdateUserRequest validation rule with user id',
    tags: ['php', 'laravel', 'eloquent', 'laravel-11', 'hosting'],
    content: 'How to validate a user id when updating a user in Laravel?',
    link: 'https://stackoverflow.com/questions/78925152/laravel-updateuserrequest-validation-rule-with-user-id',
    owner: {
      display_name: 'Zakk',
      profile_image: 'https://i.sstatic.net/n1qpV.png?s=256',
      link: 'https://stackoverflow.com/users/16835308/zakk',
    },
    is_answered: false,
    view_count: 8,
    answer_count: 0,
  },
  // Add more questions here or fetch from API
]);

// State for selected tag and filtered posts
const selectedTag = ref('');
const filteredPosts = computed(() => {
  return posts.value.filter(post => {
    return selectedTag.value === '' || post.tags.includes(selectedTag.value);
  });
});
</script>

<template>
  <div class="stackexchange-page container mx-auto py-8">
    <!-- Main content section -->
    <div class="main-content flex flex-col lg:flex-row">
      <!-- Sidebar with tags -->
      <aside class="sidebar w-full lg:w-1/4 p-4 border-r mb-4 lg:mb-0">
        <h2 class="text-xl font-bold mb-4">Tags</h2>
        <ul>
          <li>
            <button 
              @click="selectedTag = ''"
              :class="{'text-blue-600': selectedTag === '', 'text-gray-700': selectedTag !== ''}"
              class="hover:underline w-full text-left"
            >
              All
            </button>
          </li>
          <li v-for="tag in tags" :key="tag" class="mb-2">
            <button 
              @click="selectedTag = tag"
              :class="{'text-blue-600': selectedTag === tag, 'text-gray-700': selectedTag !== tag}"
              class="hover:underline w-full text-left"
            >
              {{ tag }}
            </button>
          </li>
        </ul>
      </aside>

      <!-- Posts section -->
      <section class="posts w-full lg:w-3/4 p-4">
        <h2 class="text-xl font-bold mb-4">Questions</h2>
        <div v-if="filteredPosts.length === 0" class="text-gray-600 text-center mt-20 bg-white py-5">
          <img src="../../public/img/noQuestion.jpg" alt="No questions available" class="w-60 mx-auto mb-8">
          <marquee behavior="" direction="">
            <p class="text-2xl font-bold">No questions available for this tag.</p>
          </marquee>
        </div>
        <div v-for="post in filteredPosts" :key="post.id" class="post mb-6 p-4 border rounded-lg shadow-lg bg-white">
          <h3 class="font-semibold text-lg mb-2">{{ post.title }}</h3>
          <p class="text-gray-700 mb-4">{{ post.content }}</p>
          <a :href="post.link" target="_blank">
            <button class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
              See Answer
            </button>
          </a>
        </div>
      </section>
    </div>
  </div>
</template>

<style scoped>
.stackexchange-page {
  max-width: 1200px;
}

.sidebar {
  border-right: 1px solid #e2e8f0;
}

.posts {
  margin-left: 1rem;
  margin-right: 1rem;
}

.post {
  background-color: #ffffff;
  padding: 1.5rem;
  border: 1px solid #e2e8f0;
  border-radius: 0.5rem;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

@media (max-width: 1024px) {
  .main-content {
    flex-direction: column;
  }

  .posts {
    margin: 0;
  }

  .sidebar {
    border-right: none;
    border-bottom: 1px solid #e2e8f0;
  }
}
</style>
