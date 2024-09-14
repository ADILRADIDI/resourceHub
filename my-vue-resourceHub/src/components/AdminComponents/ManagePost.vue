<template>
    <div>
      <h1 class="mx-20 mt-20 mb-5 font-bold text-2xl">Manage Posts</h1>
      <AddPostModal :isOpen="showAddModal" @close="showAddModal = false" @added="fetchPosts" class="ml-16 mb-5" />
      
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-20">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Body</th>
              <th scope="col" class="px-6 py-3">Image</th>
              <th scope="col" class="px-6 py-3">Video</th>
              <th scope="col" class="px-6 py-3">Document</th>
              <th scope="col" class="px-6 py-3">PDF</th>
              <th scope="col" class="px-6 py-3">Tags</th>
              <th scope="col" class="px-6 py-3">User</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="post in posts" :key="post.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
              <td class="px-6 py-4">{{ post.title }}</td>
              <td class="px-6 py-4">{{ post.body }}</td>
              <td class="px-6 py-4">{{ post.image }}</td>
              <td class="px-6 py-4">{{ post.video }}</td>
              <td class="px-6 py-4">{{ post.document }}</td>
              <td class="px-6 py-4">{{ post.pdf }}</td>
              <td class="px-6 py-4">{{ post.tags }}</td>
              <td class="px-6 py-4">{{ post.user_id }}</td>
              <td class="px-6 py-4">{{ post.status }}</td>
              <td class="px-6 py-4">
                <a @click="editPost(post)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a @click="deletePost(post.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Edit Post Modal -->
      <EditPostModal :isOpen="showEditModal" :post="currentPost" @close="showEditModal = false" @updated="fetchPosts" />
  
      <!-- Add Post Modal -->
    </div>
  </template>
  
  
  <script>
  import EditPostModal from '@/components/AdminComponents/EditPostModal.vue'
  import AddPostModal from '@/components/AdminComponents/AddPostModal.vue'
  
  export default {
    components: {
      EditPostModal,
      AddPostModal
    },
    data() {
      return {
        posts: [
          // Static posts as example data
          {
            id: 6,
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
          {
            id: 7,
            title: 'Second Post',
            body: 'This is the body of the second post.',
            image: 'image2.jpg',
            video: 'video2.mp4',
            document: 'document2.docx',
            pdf: 'pdf2.pdf',
            tags: null,
            user_id: 2,
            status: 'draft',
            created_at: '2024-09-03 22:37:29',
            updated_at: '2024-09-03 22:37:29'
          }
          // Add more static posts as needed
        ],
        showEditModal: false,
        showAddModal: false,
        currentPost: null
      }
    },
    methods: {
      editPost(post) {
        this.currentPost = { ...post }; // Create a copy of the post to edit
        this.showEditModal = true;
      },
      deletePost(postId) {
        // Remove the post from the static array
        this.posts = this.posts.filter(post => post.id !== postId);
      },
      fetchPosts() {
        // Fetch or refresh posts from the server or static data
        console.log('Fetching posts...');
      }
    }
  }
  </script>
  
  