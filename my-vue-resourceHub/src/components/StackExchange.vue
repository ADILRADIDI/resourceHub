<script setup>
import { ref, computed } from 'vue';

// Example tags (can be replaced by data from your backend)
const tags = ref([
  'php', 'c#', 'html', 'css', 'js', 'Flutter', 'Reactjs', 'laravel',
  'vuejs', 'angular', '.Net', 'Kotlin', 'eloquent', 'python',
]);

// Example posts (replace with API data)
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
]);

// State for selected tag and filtered posts
const selectedTag = ref('');
const filteredPosts = computed(() => {
  return posts.value.filter(post => {
    return selectedTag.value === '' || post.tags.includes(selectedTag.value);
  });
});

// State for modals
const showDetailsModal = ref(false);
const showAnswersModal = ref(false);
const selectedPost = ref(null);
const selectedAnswers = ref([]);

// Method to fetch answers
const fetchAnswers = async (questionId) => {
  if (!showAnswersModal.value) {
    const response = await fetch(`https://api.stackexchange.com/2.3/questions/${questionId}/answers?order=desc&sort=activity&site=stackoverflow&filter=withbody`);
    const data = await response.json();
    selectedAnswers.value = data.items || [];
  }
  showAnswersModal.value = !showAnswersModal.value;
};

// Open Details Modal
const openDetailsModal = (post) => {
  selectedPost.value = post;
  showDetailsModal.value = true;
};

// Close Modals
const closeModals = () => {
  showDetailsModal.value = false;
  showAnswersModal.value = false;
};
</script>

<template>
  <div class="stackexchange-page container mx-auto py-8 bg-black text-white">

    <div class="mb-6">
        <h1 class="text-4xl font-bold flex items-center justify-center my-10 text-blue-300 animate-pulse">
          StackExchange
        </h1>
      </div>
    <!--  -->
    <div class="main-content flex flex-col lg:flex-row">
      <!-- Sidebar for tags -->
      <aside class="sidebar w-full lg:w-1/4 p-4 border-r mb-4 lg:mb-0">
        <h2 class="text-xl font-bold mb-4">Tags</h2>
        <ul>
          <li>
            <button 
              @click="selectedTag = ''"
              :class="{'text-blue-600': selectedTag === '', 'text-gray-700': selectedTag !== ''}"
              class="hover:underline w-full text-left text-white"
            >
              All
            </button>
          </li>
          <li v-for="tag in tags" :key="tag" class="mb-2">
            <button 
              @click="selectedTag = tag"
              :class="{'text-blue-600': selectedTag === tag, 'text-gray-700': selectedTag !== tag}"
              class="hover:underline w-full text-left text-white"
            >
              {{ tag }}
            </button>
          </li>
        </ul>
      </aside>

      <!-- Posts section -->
      <section class="posts w-full lg:w-3/4 p-4">
        <h2 class="text-xl font-bold mb-4">Questions</h2>
        <div v-if="filteredPosts.length === 0" class="text-gray-600 text-center mt-20 bg-black py-5">
          <img src="../../public/img/noQuestion.jpg" alt="No questions available" class="w-60 mx-auto mb-8 rounded-xl">
          <p class="text-2xl font-bold text-white">No questions available for this tag.</p>
        </div>
        <div v-for="post in filteredPosts" :key="post.id" class="post mb-6 p-4 border rounded-lg shadow-lg bg-gray-900 text-white">
          <h3 class="font-semibold text-lg mb-2">{{ post.title }}</h3>
          <p class="text-gray-400 mb-4">{{ post.content }}</p>
          <h3 class="font-semibold text-sm mb-5">{{ post.tags }}</h3>
          <button
            @click="openDetailsModal(post)"
            class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700"
          >
            See Details
          </button>
          <button
            @click="fetchAnswers(post.id)"
            class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 ml-2"
          >
            {{ showAnswersModal && selectedPost.id === post.id ? 'Hide Answers' : 'See Answers' }}
          </button>
        </div>
      </section>
    </div>

    <!-- Post Details Modal -->
    <div v-if="showDetailsModal" class="modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50">
      <div class="modal-content bg-gray-900 p-6 rounded-lg w-3/4 max-w-3xl relative">
        <button @click="closeModals" class="absolute top-2 right-2 text-white">
          <span class="material-symbols-outlined">close</span>
        </button>
        <h2 class="text-2xl font-bold mb-4">{{ selectedPost?.title }}</h2>
        <p class="text-gray-400 mb-4">By: <a :href="selectedPost?.owner.link" class="text-blue-400 hover:underline">{{ selectedPost?.owner.display_name }}</a></p>
        <p class="text-gray-400 mb-4">{{ selectedPost?.content }}</p>
        <a :href="selectedPost?.link" target="_blank" class="text-blue-400 hover:underline">View on StackOverflow</a>
      </div>
    </div>

    <!-- Answers Modal -->
    <div v-if="showAnswersModal && selectedPost" class="modal fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center z-50">
      <div class="modal-content bg-gray-900 p-6 rounded-lg w-3/4 max-w-3xl relative">
        <button @click="closeModals" class="absolute top-2 right-2 text-white">
          <span class="material-symbols-outlined">close</span>
        </button>
        <h2 class="text-2xl font-bold mb-4">Answers for: {{ selectedPost?.title }}</h2>
        <div v-if="selectedAnswers.length > 0">
          <div v-for="answer in selectedAnswers" :key="answer.answer_id" class="answer mb-4 p-4 bg-gray-800 rounded-lg">
            <pre class="text-gray-300 whitespace-pre-wrap">{{ answer.body }}</pre>
            <p class="text-white text-xl mt-4 font-bold">By: {{ answer.owner.display_name || 'Anonymous' }}</p>
          </div>
        </div>
        <div v-if="selectedAnswers.length === 0" class="text-gray-600">No answers available.</div>
      </div>
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
  padding: 1.5rem;
  border-radius: 0.5rem;
}

.answer {
  padding: 1rem;
  border-radius: 0.5rem;
  max-height: 300px; /* Adjust based on your preference */
  overflow-y: auto; /* Adds a scrollbar if content exceeds max height */
}

.modal {
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 50;
}

.modal-content {
  background-color: #1a202c;
  padding: 2rem;
  border-radius: 0.5rem;
  position: relative;
}

pre {
  background-color: #2d3748;
  padding: 1rem;
  border-radius: 0.5rem;
  overflow-x: auto; /* Horizontal scroll for code blocks */
  white-space: pre-wrap; /* Preserve white space in code blocks */
  max-width: 100%;
  color: #e2e8f0; /* Light text color for code */
  font-family: 'Source Code Pro', monospace; /* Optional: Use a monospace font for better code appearance */
}

@media (max-width: 1024px) {
  .main-content {
    flex-direction: column;
  }

  .posts {
    margin: 0;
  }
}
</style>
