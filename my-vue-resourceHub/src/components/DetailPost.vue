<template>
  <div class="post-detail-wrapper flex flex-col md:flex-row gap-6 w-[80%] justify-center mx-auto">
    <!-- Main Post and Comments Section -->
    <div class="post-and-comments flex-1 max-w-4xl">
      <!-- Post Detail -->
      <div class="post-detail-container bg-white p-6 rounded-lg shadow-lg mb-6 mt-5">
        <!-- Post Header -->
        <div class="post-header flex items-center mb-4">
          <img :src="post.user?.profile_picture || 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Unknown_person.jpg/925px-Unknown_person.jpg'" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
          <div>
            <router-link :to="`/user/${post.user?.id}`" class="font-semibold text-gray-800 hover:text-blue-500">
              {{ post.user?.name || 'Unknown User' }}
            </router-link>
            <p class="text-sm text-gray-500">{{ formatDate(post.created_at) }}</p>
          </div>
        </div>

        <!-- Post Title -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ post.title }}</h2>

        <!-- Post Content -->
        <div class="post-content text-gray-700">
          <p class="mb-4">{{ post.body }}</p>
          <div v-if="post.image" class="post-image mb-4">
            <img :src="`${API_BASE_URL_WITHOUT}storage/${post.image}`" alt="Post Image" class="w-full rounded-lg shadow-md">
          </div>
          <div v-if="post.video" class="post-video mt-4 flex justify-center">
            <video controls :src="`${API_BASE_URL_WITHOUT}storage/uploads/videos/${post.video}`" class="w-full lg:w-3/4 rounded-lg shadow-md"></video>
          </div>
          <div v-if="post.document" class="post-pdf mt-4">
            <iframe 
              :src="`${API_BASE_URL_WITHOUT}storage/uploads/pdfs/${post.document}#toolbar=0`" 
              frameborder="0" 
              class="w-full h-96 rounded-lg shadow-md" 
              allowfullscreen
            ></iframe>
          </div>
        </div>
      </div>

      <!-- Comments Section -->
      <div class="comments-section bg-white p-6 rounded-lg shadow-md mb-20">
        <h3 class="text-xl font-semibold mb-4">Comments</h3>
        <div v-for="comment in comments" :key="comment.id" class="comment mb-6 bg-white border
         border-gray-200 px-5 py-4 rounded-lg shadow-sm transition-transform transform hover:scale-105">
          <div class="flex items-center justify-between mb-2">
              <div class="flex items-center gap-4">
                  <img 
                      :src="comment.userProfileImage || 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Unknown_person.jpg/925px-Unknown_person.jpg'" 
                      alt="Profile Picture" 
                      class="w-10 h-10 rounded-full"
                  >
                  <div>
                      <router-link :to="`/user/${comment.user_id}`" class="font-semibold text-blue-600 hover:text-blue-800">
                          {{ comment.username || 'Anonymous' }}
                      </router-link>
                      <p class="text-xs text-gray-400">{{ formatDate(comment.created_at) }}</p>
                  </div>
              </div>
              <div v-if="comment.user_id === userIdNow">
                  <button @click="deleteComment(comment.id)" class="text-red-500 hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="bg-white w-5">
                      <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                    </svg>
                  </button>
              </div>
          </div>
          <p class="text-gray-700 mt-2 text-md mx-16">{{ comment.body }}</p>
      </div>


        <!-- Add Comment Form -->
        <form @submit.prevent="addComment">
          <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
            <div class="px-4 py-2 bg-white rounded-t-lg">
              <label for="comment" class="sr-only">Your comment</label>
              <textarea v-model="newComment" id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 focus:ring-0 outline-none" placeholder="Write a comment..." required></textarea>
            </div>
            <div class="flex items-center justify-between px-3 py-2 border-t">
              <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-green-500 rounded-lg hover:bg-green-600">
                Post comment
              </button>
            </div>
          </div>
        </form>
        <p class="ms-auto text-xs text-gray-500">Remember, contributions to this topic should follow our <a href="#" class="text-blue-600 hover:underline">Community Guidelines</a>.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { API_BASE_URL, API_BASE_URL_WITHOUT } from '../config';

const post = ref({});
const comments = ref([]);
const newComment = ref('');
const userIdNow = Number(localStorage.getItem('user-id'));
console.log('id from local', userIdNow);

const route = useRoute();

const fetchPostById = async (postId) => {
  try {
    const response = await axios.get(`${API_BASE_URL}posts/${postId}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('user-token')}`
      }
    });
    post.value = response.data;
    console.log(userIdNow);
  } catch (error) {
    console.error('Error fetching post:', error);
  }
};

const fetchComments = async (postId) => {
  try {
    const response = await axios.get(`${API_BASE_URL}comments/post/${postId}`, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('user-token')}`
      }
    });
    comments.value = response.data;
    console.log('Fetched Comments:', comments.user_id);
  } catch (error) {
    console.error('Error fetching comments:', error);
  }
};

const addComment = async () => {
  try {
    const userId = localStorage.getItem('user-id');
    const response = await axios.post(`${API_BASE_URL}comments`, {
      post_id: post.value.id,
      body: newComment.value,
      user_id: userId
    }, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('user-token')}`
      }
    });
    comments.value.push(response.data);
    newComment.value = ''; // Clear the input field
  } catch (error) {
    console.error('Error adding comment:', error);
  }
};

const tk = localStorage.getItem('user-token');
const deleteComment = async (commentId) => {
  try {
    await axios.delete(`${API_BASE_URL}comments/${commentId}`, {
      headers: {
        Authorization: `Bearer ${tk}`
      }
    });
    comments.value = comments.value.filter(comment => comment.id !== commentId);
    console.log('remove comm id :',commentId.id);
  } catch (error) {
    console.error('Error deleting comment:', error);
  }
};

// Format date utility
const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

onMounted(() => {
  const postId = route.params.id;
  fetchPostById(postId);
  fetchComments(postId);
});
</script>
