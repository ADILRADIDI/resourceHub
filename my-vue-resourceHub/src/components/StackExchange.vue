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
  {
    id: 78925152,
    title: 'php UpdateUserRequest validation rule with user id',
    tags: ['php', 'laravel', 'eloquent', 'laravel-11', 'hosting', 'html'],
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

// State for search query and selected tag
const searchQuery = ref('');
const selectedTag = ref('');

// Compute filtered posts based on search query and selected tag
const filteredPosts = computed(() => {
  return posts.value.filter(post => {
    const matchesTag = selectedTag.value === '' || post.tags.includes(selectedTag.value);
    const matchesQuery = post.title.toLowerCase().includes(searchQuery.value.toLowerCase()) || 
                         post.content.toLowerCase().includes(searchQuery.value.toLowerCase());
    return matchesTag && matchesQuery;
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

    <!-- Search and Tag dropdown -->
    <div class="mb-6 flex flex-col lg:flex-row items-center justify-between">
      <!-- Search input -->
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search questions or content..."
        class="w-full lg:w-3/4 p-2 mb-4 lg:mb-0 border rounded-lg bg-gray-700 text-white focus:outline-none"
      />

      <!-- Tag dropdown -->
      <select v-model="selectedTag" class="w-full lg:w-1/4 p-2 border rounded-lg bg-gray-700 text-white">
        <option value="">All Tags</option>
        <option v-for="tag in tags" :key="tag" :value="tag">{{ tag }}</option>
      </select>
    </div>

    <!-- Main content -->
    <div class="main-content flex flex-col lg:flex-row">
      <section class="posts w-full lg:w-full p-4">
        <h2 class="text-xl font-bold mb-4">Questions</h2>
        <div v-if="filteredPosts.length === 0" class="text-gray-600 text-center mt-20 bg-black py-5">
          <img src="../../public/img/noQuestion.jpg" alt="No questions available" class="w-60 mx-auto mb-8 rounded-xl">
          <p class="text-2xl font-bold text-white">No questions available for this tag or search.</p>
        </div>
        <div v-for="post in filteredPosts" :key="post.id" class="post mb-6 p-4 border rounded-lg shadow-lg bg-gray-900 text-white">
          <h3 class="font-semibold text-lg mb-2">{{ post.title }}</h3>
          <h3 class="font-semibold text-sm mb-5">{{ post.tags }}</h3>
          <button
            @click="openDetailsModal(post)"
            class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700"
          >
            See Question Details
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

    <!-- Question Details Modal -->
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

        <!-- Scrollable Answers Section -->
        <div class="answers-container max-h-96 overflow-y-auto">
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
  </div>
</template>


<style scoped>
.stackexchange-page {
  max-width: 1200px;
  margin: 0 auto;
}

.main-content {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

input, select {
  margin-bottom: 1rem;
}

.post {
  padding: 1.5rem;
  border-radius: 0.5rem;
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
  white-space: pre-wrap;
  color: #e2e8f0;
}

@media (max-width: 1024px) {
  .main-content {
    flex-direction: column;
  }
}
</style>

