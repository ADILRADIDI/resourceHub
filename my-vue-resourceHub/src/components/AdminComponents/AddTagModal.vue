<!-- AddTagModal.vue -->
<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-gray-900 opacity-60" @click="$emit('close')"></div>
      <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Add New Tag</h2>
        <form @submit.prevent="addTag">
          <!-- Tag Name -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
            <input v-model="tag.name" type="text" class="p-3 border border-gray-300 rounded-lg w-full" required />
          </div>
          <!-- Status -->
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select v-model="tag.status" class="p-3 border border-gray-300 rounded-lg w-full" required>
              <option value="published">Published</option>
              <option value="draft">Draft</option>
            </select>
          </div>
          <!-- Submit -->
          <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Tag</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      isOpen: {
        type: Boolean,
        required: true,
      },
    },
    data() {
      return {
        tag: {
          name: "",
          status: "draft",
        },
      };
    },
    methods: {
      addTag() {
        // Add new tag logic (for now, just console log)
        console.log("Tag added:", this.tag);
        this.$emit("added");
        this.$emit("close");
      },
    },
  };
  </script>
  