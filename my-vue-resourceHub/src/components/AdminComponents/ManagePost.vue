<template>
    <div class="flex flex-col lg:flex-row">
      <Sidebar class="lg:w-56 w-full" />
  
      <div class="flex-1 ml-0 lg:ml-44 mt-8">
        <h1 class="mx-4 lg:mx-20 mt-20 mb-5 font-bold text-2xl">Manage Posts</h1>
  
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-4 lg:mx-20">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Title</th>
                <th scope="col" class="px-6 py-3">Body</th>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Video</th>
                <th scope="col" class="px-6 py-3">Document</th>
                <th scope="col" class="px-6 py-3">PDF</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="post in posts" :key="post.id" class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700">
                <td class="px-6 py-4">{{ post.title }}</td>
                <td class="px-6 py-4">{{ post.body }}</td>
                <td class="px-6 py-4">{{ post.image }}</td>
                <td class="px-6 py-4">{{ post.video }}</td>
                <td class="px-6 py-4">{{ post.document }}</td>
                <td class="px-6 py-4">{{ post.pdf }}</td>
                <td class="px-6 py-4">{{ post.status }}</td>
                <td class="px-6 py-4">
                  <!-- <a @click="accept(post)" class="font-medium mr-3 text-blue-600 hover:underline">accept</a> -->
                  <!-- <a @click="reject(post)" class="font-medium text-red-600 hover:underline">reject</a> -->
                  <button @click="accept(post)" class="text-blue-600 hover:text-blue-900 mr-3">accept</button>
                <button @click="reject(post)" class="text-red-600 hover:text-red-900">reject</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import Sidebar from '@/components/AdminComponents/Sidebar.vue';
  import axios from 'axios';
  import { API_BASE_URLl, API_BASE_URL } from '@/config'; // Ensure your config file has the correct base URL
  
  export default {
    components: {
      Sidebar,
    },
    data() {
      return {
        posts: [],
      };
    },
    methods: {
      fetchPosts() {
        axios.get(`${API_BASE_URLl}getDraftPosts`)
          .then(response => {
            this.posts = response.data;
          })
          .catch(error => {
            console.error("There was an error fetching the posts!", error);
          });
      },
      accept(post) {
        axios.post(`${API_BASE_URL}acceptPost/${post.id}`)
          .then(() => {
            this.fetchPosts(); // Refresh posts after updating
          })
          .catch(error => {
            console.error("Error accepting post:", error);
          });
      },
      reject(post) {
        axios.delete(`${API_BASE_URL}posts/${post.id}`)
          .then(() => {
            this.fetchPosts(); // Refresh posts after deleting
          })
          .catch(error => {
            console.error("Error rejecting post:", error);
          });
      }
    },
    mounted() {
      this.fetchPosts(); // Fetch the draft posts when the component is mounted
    }
  };
  </script>
  
  <style scoped>
  /* Additional styles if needed */
  </style>
  