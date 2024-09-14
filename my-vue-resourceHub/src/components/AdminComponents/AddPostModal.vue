<template>
    <div class="container mx-auto p-4">
      <!-- Trigger Button -->
      <button @click="openCreateModal" class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700 transition">Create New Post</button>
  
      <!-- Create Post Modal -->
      <transition name="fade">
        <div v-if="isCreateModalOpen" class="fixed inset-0 flex items-center justify-center z-50 h-20 mt-96">
          <div class="fixed inset-0 bg-gray-900 opacity-60" @click="closeCreateModal"></div>
          <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-2xl">
            <h2 class="text-xl font-semibold mb-6 text-gray-800">Create New Post</h2>
            
            <!-- Stepper Navigation -->
            <div class="flex mb-6">
              <button @click="currentStep = 1" :class="{'bg-blue-600': currentStep === 1, 'bg-gray-300': currentStep !== 1}" class="px-4 py-2 rounded-l-lg transition">Step 1</button>
              <button @click="currentStep = 2" :class="{'bg-blue-600': currentStep === 2, 'bg-gray-300': currentStep !== 2}" class="px-4 py-2 transition">Step 2</button>
              <button @click="currentStep = 3" :class="{'bg-blue-600': currentStep === 3, 'bg-gray-300': currentStep !== 3}" class="px-4 py-2 rounded-r-lg transition">Step 3</button>
            </div>
            
            <!-- Form Steps -->
            <form @submit.prevent="handleSubmit" class="space-y-4">
              <!-- Step 1: Post Title -->
              <div v-if="currentStep === 1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                <input type="text" v-model="postTitle" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400" placeholder="Enter post title" required />
              </div>
  
              <!-- Step 2: Post Content -->
              <div v-if="currentStep === 2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Post Content</label>
                <textarea v-model="postContent" rows="6" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400" placeholder="Enter post content" required></textarea>
              </div>
  
              <!-- Step 3: Attachments and Tags -->
              <div v-if="currentStep === 3">
                <div class="mb-4">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Attachments</label>
                  <div class="flex space-x-4 mb-4">
                    <span class="material-symbols-outlined cursor-pointer text-gray-600 hover:text-gray-800" @click="triggerFileInput('image')">image</span>
                    <span class="material-symbols-outlined cursor-pointer text-gray-600 hover:text-gray-800" @click="triggerFileInput('video')">video_library</span>
                    <span class="material-symbols-outlined cursor-pointer text-gray-600 hover:text-gray-800" @click="triggerFileInput('pdf')">picture_as_pdf</span>
                  </div>
                  <input type="file" ref="imageInput" @change="handleFileChange('image', $event)" class="hidden" accept="image/*" />
                  <input type="file" ref="videoInput" @change="handleFileChange('video', $event)" class="hidden" accept="video/*" />
                  <input type="file" ref="pdfInput" @change="handleFileChange('pdf', $event)" class="hidden" accept="application/pdf" />
                </div>
  
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                  <div class="flex flex-wrap mb-4">
                    <span v-for="tag in selectedTags" :key="tag" class="inline-block bg-blue-500 text-white px-3 py-1 rounded-full text-sm mr-2 mb-2">
                      {{ tag }}
                      <button @click="removeTag(tag)" class="text-white ml-2">&times;</button>
                    </span>
                  </div>
                  <input type="text" v-model="searchQuery" placeholder="Search tags..." class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 mb-4" />
                  <div class="border border-gray-300 rounded-lg max-h-60 overflow-y-auto">
                    <ul>
                      <li v-for="tag in filteredTags" :key="tag" @click="addTag(tag)" class="cursor-pointer p-2 hover:bg-gray-100" :class="{'bg-blue-100': selectedTags.includes(tag)}">
                        {{ tag }}
                      </li>
                    </ul>
                  </div>
                  <p v-if="selectedTags.length >= 10" class="text-red-500 text-sm mt-2">You can only select up to 10 tags.</p>
                </div>
              </div>
  
              <!-- Navigation Buttons -->
              <div class="flex justify-between">
                <button v-if="currentStep > 1" type="button" @click="currentStep--" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Previous</button>
                <button v-if="currentStep < 3" type="button" @click="currentStep++" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Next</button>
                <button v-if="currentStep === 3" type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Create Post</button>
                <button type="button" @click="closeCreateModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </transition>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue';
  
  const tagOptions = ref(['Technology', 'Education', 'Health', 'Finance', 'Travel', 'Lifestyle', 'Food', 'Sports', 'Entertainment', 'Science']);
  const selectedTags = ref([]);
  const searchQuery = ref('');
  
  const isCreateModalOpen = ref(false);
  const postTitle = ref('');
  const postContent = ref('');
  const currentStep = ref(1); // Track current step
  const fileInputs = ref({ image: null, video: null, pdf: null });
  
  const openCreateModal = () => {
    isCreateModalOpen.value = true;
  };
  
  const closeCreateModal = () => {
    isCreateModalOpen.value = false;
    postTitle.value = '';
    postContent.value = '';
    selectedTags.value = [];
    currentStep.value = 1; // Reset step to 1
  };
  
  const handleSubmit = () => {
    // Handle post creation logic
    console.log('Post Created:', {
      title: postTitle.value,
      content: postContent.value,
      tags: selectedTags.value,
      files: [] // Add logic to handle file uploads
    });
    closeCreateModal();
  };
  
  const triggerFileInput = (type) => {
    fileInputs.value[type]?.click();
  };
  
  const handleFileChange = (type, event) => {
    const file = event.target.files[0];
    if (file) {
      // Handle file uploads and store file information
      console.log(`File selected (${type}):`, file);
    }
  };
  
  const addTag = (tag) => {
    if (selectedTags.value.length < 10 && !selectedTags.value.includes(tag)) {
      selectedTags.value.push(tag);
    }
  };
  
  const removeTag = (tag) => {
    selectedTags.value = selectedTags.value.filter(t => t !== tag);
  };
  
  const filteredTags = computed(() => {
    return tagOptions.value.filter(tag => tag.toLowerCase().includes(searchQuery.value.toLowerCase()));
  });
  </script>
  
  <style scoped>
  /* Modal fade transition styles */
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.3s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  
  /* Stepper button styles */
  .stepper-button {
    background-color: #e2e8f0; /* Gray */
    color: #2d3748; /* Dark gray */
  }
  
  .stepper-button.active {
    background-color: green;
    color: #fff;
  }
  </style>
  