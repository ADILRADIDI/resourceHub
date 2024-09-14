<template>
  <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="fixed inset-0 bg-gray-900 opacity-60" @click="$emit('close')"></div>
    <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
      <h2 class="text-xl font-semibold mb-4">Edit Post</h2>
      <form @submit.prevent="updatePost">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
          <input v-model="post.title" type="text" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Body</label>
          <textarea v-model="post.body" rows="4" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
          <select v-model="post.status" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="archived">Archived</option>
            <!-- Add more status options if needed -->
          </select>
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Save</button>
          <button type="button" @click="$emit('close')" class="ml-2 bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    isOpen: Boolean,
    post: Object
  },
  methods: {
    updatePost() {
      // Logic to update the post
      console.log('Updated Post:', this.post);
      this.$emit('updated'); // Emit an event to refresh the posts
      this.$emit('close'); // Close the modal
    }
  }
}
</script>
