<template>
    <div class="mx-10 mt-10">
      <h1 class="text-2xl font-bold mb-6">Manage Posts</h1>
  
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4">{{ post.id }}</td>
              <td class="px-6 py-4">{{ post.title }}</td>
              <td class="px-6 py-4">
                <span :class="post.status === 'published' ? 'text-green-500' : 'text-red-500'">
                  {{ post.status }}
                </span>
              </td>
              <td class="px-6 py-4 flex space-x-4">
                <button @click="viewDetails(post)" class="text-blue-600 dark:text-blue-500 hover:underline">View Details</button>
                <button @click="acceptPost(post)" class="text-green-600 hover:underline">Accept</button>
                <button @click="rejectPost(post)" class="text-red-600 hover:underline">Reject</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Post Details Modal -->
      <div v-if="showDetailsModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-xl font-semibold mb-4">Post Details</h3>
          <p><strong>ID:</strong> {{ currentPost.id }}</p>
          <p><strong>Title:</strong> {{ currentPost.title }}</p>
          <p><strong>Body:</strong> {{ currentPost.body }}</p>
          <p><strong>Image:</strong> {{ currentPost.image }}</p>
          <p><strong>Video:</strong> {{ currentPost.video }}</p>
          <p><strong>Document:</strong> {{ currentPost.document }}</p>
          <p><strong>PDF:</strong> {{ currentPost.pdf }}</p>
          <p><strong>Tags:</strong> {{ currentPost.tags }}</p>
          <p><strong>User ID:</strong> {{ currentPost.user_id }}</p>
          <p><strong>Status:</strong> {{ currentPost.status }}</p>
          <p><strong>Created At:</strong> {{ currentPost.created_at }}</p>
          <p><strong>Updated At:</strong> {{ currentPost.updated_at }}</p>
  
          <div class="flex justify-end mt-4">
            <button @click="closeDetailsModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Close</button>
          </div>
        </div>
      </div>
    </div>
  </template>
<script>
export default {
  data() {
    return {
      posts: [
        {
          id: 1,
          title: 'First Post',
          body: 'This is the body of the first post.',
          image: 'image1.jpg',
          video: 'video1.mp4',
          document: 'document1.docx',
          pdf: 'pdf1.pdf',
          tags: null,
          user_id: 1,
          status: 'published',
          created_at: '2024-09-03 22:37:29',
          updated_at: '2024-09-03 22:37:29'
        },
        // Additional post objects...
      ],
      showDetailsModal: false,
      currentPost: {}
    };
  },
  methods: {
    viewDetails(post) {
      this.currentPost = post;
      this.showDetailsModal = true;
    },
    closeDetailsModal() {
      this.showDetailsModal = false;
      this.currentPost = {};
    },
    acceptPost(post) {
      post.status = 'published';
      alert(`Post "${post.title}" has been accepted.`);
    },
    rejectPost(post) {
      post.status = 'rejected';
      alert(`Post "${post.title}" has been rejected.`);
    }
  }
};
</script>
  