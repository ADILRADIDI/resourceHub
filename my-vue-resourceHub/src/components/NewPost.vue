<script setup>
import { ref, computed } from 'vue';

// Array of available tags
const tagOptions = ref(['Technology', 'Education', 'Health', 'Science', 'Entertainment', 'Finance', 'Travel', 'Food', 'Sports', 'Music', 'Movies', 'Books', 'Art', 'Politics', 'Environment']);

const postTitle = ref('');
const postContent = ref('');
const coverImage = ref(null);
const selectedTags = ref([]);
const searchQuery = ref('');
const posts = ref([]);

const isEditing = ref(true);

// Computed property to filter options based on the search query
const filteredTags = computed(() => {
  return tagOptions.value.filter(tag => tag.toLowerCase().includes(searchQuery.value.toLowerCase()));
});

// Method to add a tag to selectedTags
const addTag = (tag) => {
  if (selectedTags.value.length < 10 && !selectedTags.value.includes(tag)) {
    selectedTags.value.push(tag);
  }
};

// Method to remove a tag from selectedTags
const removeTag = (tag) => {
  selectedTags.value = selectedTags.value.filter(t => t !== tag);
};

const handleSubmit = () => {
  if (postTitle.value && postContent.value) {
    posts.value.push({
      id: posts.value.length + 1,
      userProfileImage: 'https://via.placeholder.com/40',
      username: 'john_doe',
      timeCreated: 'Just now',
      title: postTitle.value,
      content: postContent.value,
      images: coverImage.value ? [URL.createObjectURL(coverImage.value)] : [],
      tags: selectedTags.value,
      liked: false,
      saved: false,
    });

    // Reset form
    postTitle.value = '';
    postContent.value = '';
    coverImage.value = null;
    selectedTags.value = [];
    searchQuery.value = '';
  }
};

const handleEditClick = () => {
  isEditing.value = true;
};

const handlePreviewClick = () => {
  isEditing.value = false;
};

const toggleLike = (postId) => {
  const post = posts.value.find(p => p.id === postId);
  if (post) post.liked = !post.liked;
};

const toggleSave = (postId) => {
  const post = posts.value.find(p => p.id === postId);
  if (post) post.saved = !post.saved;
};
</script>

<template>
    <div class="container mx-auto p-4">
      <div class="create-post mb-8">
        <div class="flex justify-between">
          <h1 class="text-2xl font-bold mb-4">Create New Post</h1>
          <div class="">
            <button @click="handleEditClick" class="hover:bg-gray-300 text-black rounded-lg px-4 py-2">Edit</button>
            <button @click="handlePreviewClick" class="hover:bg-gray-300 text-black rounded-lg px-4 py-2">Preview</button>
          </div>
        </div>
  
        <form v-if="isEditing" @submit.prevent="handleSubmit" class="bg-white p-6 rounded-lg shadow-md">
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Post Title</label>
            <input type="text" v-model="postTitle" class="p-2 border rounded-lg w-full outline-none placeholder-bold" placeholder="Enter post title" required />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Post Content</label>
            <textarea v-model="postContent" rows="4" class="p-2 border rounded-lg w-full outline-none placeholder-bold" placeholder="Enter post content" required></textarea>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Cover Image</label>
            <input type="file" @change="event => coverImage.value = event.target.files[0]" class="p-2 border rounded-lg w-full" />
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Tags</label>
            <div class="flex flex-wrap mb-4">
              <span v-for="tag in selectedTags" :key="tag" class="inline-block bg-blue-500 text-white px-2 py-1 rounded-full text-sm mr-2 mb-2">
                {{ tag }}
                <button @click="removeTag(tag)" class="text-white ml-2">&times;</button>
              </span>
            </div>
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search tags..."
              class="p-2 border rounded-lg w-full outline-none placeholder-bold mb-4"
            />
            <div class="border rounded-lg max-h-60 overflow-y-auto">
              <ul>
                <li
                  v-for="tag in filteredTags"
                  :key="tag"
                  @click="addTag(tag)"
                  class="cursor-pointer p-2 hover:bg-gray-200"
                  :class="{'bg-blue-100': selectedTags.includes(tag)}"
                >
                  {{ tag }}
                </li>
              </ul>
            </div>
            <p v-if="selectedTags.length >= 10" class="text-red-500 text-sm mt-2">You can only select up to 10 tags.</p>
          </div>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Create Post</button>
        </form>
      </div>
  
      <div v-if="!isEditing" class="post-preview">
        <h2 class="text-xl font-bold mb-4">Post Preview</h2>
        <div v-for="post in posts" :key="post.id" class="post-container bg-white p-6 rounded-lg shadow-md mb-3 relative">
          <div class="post-header flex items-center mb-4">
            <img :src="post.userProfileImage" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
            <div>
              <p class="font-semibold text-gray-800">{{ post.username }}</p>
              <p class="text-sm text-gray-500">{{ post.timeCreated }}</p>
            </div>
          </div>
          <h2 class="text-xl font-bold text-gray-900 mb-4">{{ post.title }}</h2>
          <div class="text-gray-700 mb-6">
            <p class="mb-6">{{ post.content }}</p>
            <div v-if="post.images && post.images.length > 0" class="my-4">
              <img v-for="(image, index) in post.images" :key="index" :src="image" alt="Post Image" class="w-full rounded-lg mt-2">
            </div>
            <div class="mt-2">
              <span v-for="tag in post.tags" :key="tag" class="inline-block bg-blue-500 text-white px-2 py-1 rounded-full text-sm mr-2">{{ tag }}</span>
            </div>
          </div>
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <button @click="toggleLike(post.id)" class="flex items-center mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-red-500': post.liked, 'text-gray-500': !post.liked}" viewBox="0 0 20 20">
                  <path d="M3.172 5.172a4.2 4.2 0 015.656 0L10 6.343l1.172-1.171a4.2 4.2 0 015.656 5.656L10 18.828l-6.828-6.828a4.2 4.2 0 010-5.656z"/>
                </svg>
                <span class="ml-1 text-gray-700">{{ post.liked ? 'Liked' : 'Like' }}</span>
              </button>
              <button class="flex items-center mr-4">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 5h3a6 6 0 110 12v2.625c-3.75-1.5-9-3.75-9-8.625a6 6 0 016-6zM12 15.5h1.5a4.501 4.501 0 001.722-8.657A4.5 4.5 0 0013.5 6.5h-3A4.5 4.5 0 006 11c0 2.707 1.846 4.475 6 6.36V15.5z"/></svg>
                <span class="ml-1 text-gray-700">Comments</span>
              </button>
              <button @click="toggleSave(post.id)" class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-yellow-500': post.saved, 'text-gray-500': !post.saved}" viewBox="0 0 20 20">
                  <path d="M10 18l-6-6 1.5-1.5L10 15l4.5-4.5L16 12l-6 6z"/>
                </svg>
                <span class="ml-1 text-gray-700">{{ post.saved ? 'Saved' : 'Save' }}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

<style scoped>
.container {
  max-width: 800px;
}

input::placeholder {
  font-weight: bold;
}

.post-container {
  position: relative;
}

.post-header img {
  border-radius: 50%;
}

.post-preview {
  padding: 2rem;
}

</style>
