<template>
    <div class="mx-20 mt-20">
      <h1 class="mb-5 font-bold text-2xl">Manage Tags</h1>
  
      <!-- Add Tag Button -->
      <button @click="showAddModal = true" class="mb-5 px-4 py-2 bg-blue-500 text-white rounded-lg">
        Add Tag
      </button>
  
      <!-- Tags Table -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Name</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tag in tags" :key="tag.id" class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700">
              <td class="px-6 py-4">{{ tag.id }}</td>
              <td class="px-6 py-4">{{ tag.name }}</td>
              <td class="px-6 py-4">{{ tag.status }}</td>
              <td class="px-6 py-4">
                <button @click="editTag(tag)" class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                  Edit
                </button>
                <button @click="deleteTag(tag.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Add Tag Modal -->
      <AddTagModal :isOpen="showAddModal" @close="showAddModal = false" @added="fetchTags" />
  
      <!-- Edit Tag Modal -->
      <EditTagModal :isOpen="showEditModal" :tag="currentTag" @close="showEditModal = false" @updated="fetchTags" />
    </div>
  </template>
  
  <script>
  import AddTagModal from "@/components/AdminComponents/AddTagModal.vue";
  import EditTagModal from "@/components/AdminComponents/EditTagModal.vue";
  
  export default {
    components: {
      AddTagModal,
      EditTagModal,
    },
    data() {
      return {
        tags: [
          { id: 1, name: 'okok', status: 'draft', created_at: null, updated_at: null },
          { id: 2, name: 'laravel', status: 'draft', created_at: '2024-09-01', updated_at: '2024-09-01' },
          // Add more static tags here
        ],
        showAddModal: false,
        showEditModal: false,
        currentTag: null,
      };
    },
    methods: {
      editTag(tag) {
        this.currentTag = { ...tag };
        this.showEditModal = true;
      },
      deleteTag(tagId) {
        this.tags = this.tags.filter(tag => tag.id !== tagId);
      },
      fetchTags() {
        // Fetch tags from the server (for now, static data)
        console.log("Fetching tags...");
      },
    },
  };
  </script>
  