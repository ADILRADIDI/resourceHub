<template>
  <div class="container mx-auto p-4">
    <div class="create-post mb-8">
      <div class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">Create New Post</h1>
        <div>
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
          <div class="flex items-center mb-2">
            <span class="material-symbols-outlined cursor-pointer" @click="triggerFileInput('image')">image</span>
            <span class="material-symbols-outlined cursor-pointer ml-4" @click="triggerFileInput('video')">video_library</span>
            <span class="material-symbols-outlined cursor-pointer ml-4" @click="triggerFileInput('pdf')">picture_as_pdf</span>
          </div>
          <input type="file" ref="imageInput" @change="handleFileChange('image', $event)" class="hidden" accept="image/*" />
          <input type="file" ref="videoInput" @change="handleFileChange('video', $event)" class="hidden" accept="video/*" />
          <input type="file" ref="pdfInput" @change="handleFileChange('pdf', $event)" class="hidden" accept="application/pdf" />
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
          <div v-if="post.files && post.files.length > 0" class="my-4">
            <div v-for="(file, index) in post.files" :key="index" class="mb-2">
              <img v-if="file.type.startsWith('image')" :src="file.url" alt="Post Image" class="w-full rounded-lg mt-2" />
              <video v-if="file.type.startsWith('video')" controls class="w-full rounded-lg mt-2">
                <source :src="file.url" type="video/mp4" />
                Your browser does not support the video tag.
              </video>
              <a v-if="file.type === 'application/pdf'" :href="file.url" target="_blank" class="text-blue-600 underline mt-2">View PDF</a>
            </div>
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
            <button @click="toggleSave(post.id)" class="flex items-center mr-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" :class="{'text-blue-500': post.saved, 'text-gray-500': !post.saved}" viewBox="0 0 20 20">
                <path d="M3 2a3 3 0 00-3 3v10a3 3 0 003 3h11a3 3 0 003-3V5a3 3 0 00-3-3H3z"/>
              </svg>
              <span class="ml-1 text-gray-700">{{ post.saved ? 'Saved' : 'Save' }}</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const tagOptions = ref(['Technology', 'Education', 'Health', 'Science', 'Entertainment', 'Finance', 'Travel', 'Food', 'Sports', 'Music', 'Movies', 'Books', 'Art', 'Politics', 'Environment']);

const postTitle = ref('');
const postContent = ref('');
const coverFile = ref(null);
const selectedTags = ref([]);
const searchQuery = ref('');
const posts = ref([]);

const isEditing = ref(true);

const filteredTags = computed(() => {
  return tagOptions.value.filter(tag => tag.toLowerCase().includes(searchQuery.value.toLowerCase()));
});

const addTag = (tag) => {
  if (selectedTags.value.length < 10 && !selectedTags.value.includes(tag)) {
    selectedTags.value.push(tag);
  }
};

const removeTag = (tag) => {
  selectedTags.value = selectedTags.value.filter(t => t !== tag);
};

const handleFileChange = (type, event) => {
  const file = event.target.files[0];
  if (type === 'image') {
    coverFile.value = { url: URL.createObjectURL(file), type: file.type };
  } else if (type === 'video') {
    coverFile.value = { url: URL.createObjectURL(file), type: file.type };
  } else if (type === 'pdf') {
    coverFile.value = { url: URL.createObjectURL(file), type: file.type };
  }
};

const triggerFileInput = (type) => {
  if (type === 'image') {
    document.querySelector('input[type=file][accept="image/*"]').click();
  } else if (type === 'video') {
    document.querySelector('input[type=file][accept="video/*"]').click();
  } else if (type === 'pdf') {
    document.querySelector('input[type=file][accept="application/pdf"]').click();
  }
};

const handleSubmit = () => {
  const newPost = {
    id: posts.value.length + 1,
    title: postTitle.value,
    content: postContent.value,
    files: coverFile.value ? [coverFile.value] : [],
    tags: selectedTags.value,
    liked: false,
    saved: false,
    userProfileImage: 'https://via.placeholder.com/40',
    username: 'User Name',
    timeCreated: new Date().toLocaleString()
  };
  posts.value.push(newPost);
  resetForm();
};

const resetForm = () => {
  postTitle.value = '';
  postContent.value = '';
  coverFile.value = null;
  selectedTags.value = [];
};

const toggleLike = (postId) => {
  const post = posts.value.find(p => p.id === postId);
  if (post) post.liked = !post.liked;
};

const toggleSave = (postId) => {
  const post = posts.value.find(p => p.id === postId);
  if (post) post.saved = !post.saved;
};

const handleEditClick = () => {
  isEditing.value = true;
};

const handlePreviewClick = () => {
  isEditing.value = false;
};
</script>
<style scoped>
.container {
  max-width: 800px;
}

.create-post {
  background-color: #f9f9f9;
  border-radius: 10px;
}

.post-preview {
  background-color: #f9f9f9;
  border-radius: 10px;
}

.post-container {
  border: 1px solid #ddd;
}

.material-symbols-outlined {
  font-size: 24px;
  cursor: pointer;
}
</style>
