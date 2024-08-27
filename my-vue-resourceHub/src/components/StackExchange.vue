<script setup>
// Import necessary Vue functionalities
import { ref, computed } from 'vue';

// Sample categories and posts data
const categories = ref([
  'JavaScript',
  'Vue.js',
  'Laravel',
  'Python',
  'CSS',
  'HTML',
  'React',
  'Node.js',
]);

const posts = ref([
  {
    id: 1,
    title: 'How to implement authentication in Vue.js?',
    category: 'Vue.js',
    content: 'I am looking for a way to implement authentication in my Vue.js application...',
    answer: 'You can use Vue Router and Vuex for managing authentication state, and use libraries like Axios for making API requests.',
  },
  {
    id: 2,
    title: 'What is the best way to learn Python?',
    category: 'Python',
    content: 'I am new to programming and want to start with Python. What are the best resources?',
    answer: 'The best way to learn Python is to start with online tutorials like Python.org, or take courses on platforms like Coursera or Udemy.',
  },
  {
    id: 3,
    title: 'How to center a div using CSS?',
    category: 'CSS',
    content: 'What are the various methods to center a div horizontally and vertically using CSS?',
    answer: 'You can use flexbox or grid to easily center a div both horizontally and vertically.',
  },
  {
    id: 4,
    title: 'How to optimize performance in a Laravel application?',
    category: 'Laravel',
    content: 'What are the best practices for optimizing the performance of a Laravel application?',
    answer: 'Optimizing performance in Laravel can be done by caching queries, optimizing database indexes, and using eager loading.',
  },
  {
    id: 5,
    title: 'How do promises work in JavaScript?',
    category: 'JavaScript',
    content: 'Can someone explain how promises work in JavaScript with an example?',
    answer: 'Promises represent a value that may be available now, or in the future, or never. You can use `.then()` to handle resolved values.',
  },
  {
    id: 6,
    title: 'How to use useState hook in React?',
    category: 'React',
    content: 'What is the useState hook in React and how do I use it?',
    answer: 'useState is a React hook that allows you to add state to functional components. You can use it to manage component state.',
  },
  {
    id: 7,
    title: 'How to set up a REST API in Node.js?',
    category: 'Node.js',
    content: 'I want to set up a REST API using Node.js. What are the necessary steps?',
    answer: 'To set up a REST API in Node.js, you can use Express.js, define routes, and connect to a database like MongoDB.',
  },
  {
    id: 8,
    title: 'How to integrate Tailwind CSS with Vue.js?',
    category: 'Vue.js',
    content: 'How do I integrate Tailwind CSS into my Vue.js project?',
    answer: 'You can integrate Tailwind CSS by installing it via npm and importing it into your main CSS or JS file.',
  },
  {
    id: 9,
    title: 'How to handle form validation in Laravel?',
    category: 'Laravel',
    content: 'What are the best practices for handling form validation in Laravel?',
    answer: 'Laravel provides a validation system out of the box. You can use `Request` classes or `Validator` facade to validate incoming data.',
  },
  {
    id: 10,
    title: 'How to create a dropdown menu in HTML and CSS?',
    category: 'HTML',
    content: 'Can someone guide me on creating a simple dropdown menu using HTML and CSS?',
    answer: 'You can create a dropdown menu using `<select>` elements or using CSS to style a list of links.',
  },
]);

// State for selected category and filtered posts
const selectedCategory = ref('');
const filteredPosts = computed(() => {
  return posts.value.filter(post => {
    return selectedCategory.value === '' || post.category === selectedCategory.value;
  });
});
</script>

<template>
  <div class="stackexchange-page container mx-auto py-8">
    <!-- Main content section -->
    <div class="main-content flex flex-col lg:flex-row">
      <!-- Sidebar with categories -->
      <aside class="sidebar w-full lg:w-1/4 p-4 border-r mb-4 lg:mb-0">
        <h2 class="text-xl font-bold mb-4">Categories</h2>
        <ul>
          <li>
            <button 
              @click="selectedCategory = ''"
              :class="{'text-blue-600': selectedCategory === '', 'text-gray-700': selectedCategory !== ''}"
              class="hover:underline w-full text-left"
            >
              All
            </button>
          </li>
          <li v-for="category in categories" :key="category" class="mb-2">
            <button 
              @click="selectedCategory = category"
              :class="{'text-blue-600': selectedCategory === category, 'text-gray-700': selectedCategory !== category}"
              class="hover:underline w-full text-left"
            >
              {{ category }}
            </button>
          </li>
        </ul>
      </aside>

      <!-- Posts section -->
      <section class="posts w-full lg:w-3/4 p-4">
        <h2 class="text-xl font-bold mb-4">Questions</h2>
        <div v-if="filteredPosts.length === 0" class="text-gray-600">
          No questions available for this category.
        </div>
        <div v-for="post in filteredPosts" :key="post.id" class="post mb-6 p-4 border rounded-lg shadow-lg bg-white">
            <h3 class="font-semibold text-lg mb-2">{{ post.title }}</h3>
 
          <p class="text-gray-700 mb-4">{{ post.content }}</p>
          <router-link to="/questionDetail">
          <button class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">See Answer</button></router-link>
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
