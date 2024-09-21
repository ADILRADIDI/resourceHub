<template>
  <div class="post-detail-wrapper flex gap-6">
    <!-- Main Post and Comments Section -->
    <div class="post-and-comments flex-1">
      <!-- Post Detail -->
      <div class="post-detail-container bg-white p-6 rounded-lg shadow-md mb-6 mt-5">
        <!-- Post Header -->
        <div class="post-header flex items-center mb-4">
          <img :src="post.userProfileImage" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
          <div>
            <router-link :to="`/user/${post.username}`" class="font-semibold text-gray-800 hover:text-blue-500">
              {{ post.username }}
            </router-link>
            <p class="text-sm text-gray-500">{{ post.timeCreated }}</p>
          </div>
        </div>

        <!-- Post Title -->
        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ post.title }}</h2>

        <!-- Post Content -->
        <div class="post-content text-gray-700">
          <p class="mb-4">{{ post.content }}</p>
          <div v-if="post.images.length" class="post-images">
            <img v-for="(image, index) in post.images" :key="index" :src="image" alt="Post Image" class="w-full rounded-lg mt-2">
          </div>
          <!--  -->
          <!-- Post Footer -->
      <div class="post-footer flex items-center justify-between mt-5">
        <div class="actions flex items-center">
          <button @click="toggleLike(post.id)" class="like-button flex items-center mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-red-500': post.liked, 'text-gray-500': !post.liked}" viewBox="0 0 20 20">
              <path d="M3.172 5.172a4.2 4.2 0 015.656 0L10 6.343l1.172-1.171a4.2 4.2 0 015.656 5.656L10 18.828l-6.828-6.828a4.2 4.2 0 010-5.656z"/>
            </svg>
            <span class="ml-1">{{ post.liked ? 'Liked' : 'Like' }}</span>
          </button>
          <button @click="toggleSave(post.id)" class="save-button flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-blue-500': post.saved, 'text-gray-500': !post.saved}" viewBox="0 0 20 20">
              <path d="M5 3a1 1 0 00-1 1v13a1 1 0 001.6.8L10 15.333l3.4 2.467a1 1 0 001.6-.8V4a1 1 0 00-1-1H5z"/>
            </svg>
            <span class="ml-1">{{ post.saved ? 'Unsave' : 'Save' }}</span>
          </button>
        </div>
      </div>
        </div>
      </div>

      <!-- Comments Section -->
      <div class="comments-section bg-white p-6 rounded-lg shadow-md mb-20">
        <h3 class="text-lg font-semibold mb-4">Comments</h3>
  
        <!-- Existing Comments -->
        <div v-for="comment in comments" :key="comment.id" class="comment mb-6 bg-gray-100 px-5 py-3 rounded-xl">
          <div class="flex items-center justify-between mb-2 ">
            <div class="flex items-center">
              <img :src="comment.userProfileImage" alt="Profile Picture" class="w-8 h-8 rounded-full mr-3">
              <router-link :to="`/user/${comment.username}`" class="font-semibold text-gray-800 hover:text-blue-500">
                {{ comment.username }}
              </router-link>
            </div>
            <p class="text-sm text-gray-500">{{ comment.timeCreated }}</p>
          </div>
          <p class="text-gray-700 text-md mt-1 ml-10">{{ comment.content }}</p>
        </div>
  
        <!-- Add New Comment Section --> 
        <div class="add-comment mt-6">
          <form @submit.prevent="addComment">
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
              <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea 
                  v-model="newComment" 
                  id="comment" 
                  rows="4" 
                  class="w-full px-0 text-sm outline-none text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" 
                  placeholder="Write a comment..." 
                  required>
                </textarea>
              </div>
              <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                <button 
                  type="submit" 
                  class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                  Post comment
                </button>
              </div>
            </div>
          </form>
        </div>

      </div>
    </div>

    <!-- User Detail Section -->
    <div class="user-detail-section w-80 h-96 bg-white p-6 rounded-lg shadow-md mt-5">
      <div class="user-profile flex flex-col items-center">
        <img :src="post.userProfileImage" alt="Profile Picture" class="w-20 h-20 rounded-full mb-4">
        <h2 class="text-xl font-semibold">{{ post.username }}</h2>
        <p class="text-sm text-gray-500 mb-4">NIT Delhi'26</p>
        <button 
          @click="toggleFollow" 
          :class="{
            'follow-button': true,
            'bg-blue-600 text-white': !isFollowing,
            'bg-gray-200 text-gray-700': isFollowing
          }"
          class="px-6 py-2 rounded-lg"
        >
          {{ isFollowing ? 'Unfollow' : 'Follow' }}
        </button>
      </div>
      <div class="user-meta mt-6 text-center">
        <p class="text-sm text-gray-500">Joined</p>
        <p class="text-lg text-gray-800">Aug 21, 2024</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRoute } from 'vue-router';

// Sample data for the post detail
const route = useRoute();
const postId = route.params.id;

// Fetch post details based on the ID (dummy data here)
const post = ref({
  id: postId,
  username: 'Ankit Rattan',
  userProfileImage: 'https://via.placeholder.com/80',
  timeCreated: '2 hours ago',
  title: 'Vue 3 is awesome!',
  content: 'I am really enjoying learning Vue 3. The new composition API is great!',
  images: [
    'https://media.licdn.com/dms/image/v2/D4D22AQEf6hw6CFqPJA/feedshare-shrink_800/feedshare-shrink_800/0/1725115726665?e=1727913600&v=beta&t=y0oELRqfRQT5pw4XHdw43RlknmNT3S7Ih4in00RScGY',
  ],
});

// Comments data
const comments = ref([
  { id: 1, username: 'Jane Smith', content: 'Great post!', timeCreated: '1 hour ago', userProfileImage: 'https://via.placeholder.com/30' },
  { id: 2, username: 'Michael Lee', content: 'Thanks for sharing!', timeCreated: '30 minutes ago', userProfileImage: 'https://via.placeholder.com/30' },
]);

// New comment
const newComment = ref('');

// State to track if the user is followed
const isFollowing = ref(false);

// Toggle follow/unfollow state
const toggleFollow = () => {
  isFollowing.value = !isFollowing.value;
};

// Add a new comment
const addComment = () => {
  if (newComment.value.trim()) {
    comments.value.push({
      id: comments.value.length + 1,
      username: 'Your Name',
      content: newComment.value,
      timeCreated: 'Just now',
      userProfileImage: 'https://via.placeholder.com/30', 
    });
    newComment.value = '';
  }
};
</script>

<style scoped>
.post-detail-wrapper {
  max-width: 1000px;
  margin: auto;
}

.user-detail-section {
  text-align: center;
}

.follow-button {
  transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
