<template>
    <div>
      <h1 class="mx-20 mt-20 mb-5 font-bold text-2xl">Manage Resources</h1>
      
      <!-- Add Resource Button -->
      <button
        @click="showAddModal = true"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-20 mb-5"
      >
        Add Resource
      </button>
  
      <!-- Add Resource Modal -->
      <AddResourceModal :isOpen="showAddModal" @close="showAddModal = false" @added="fetchResources" />
  
      <!-- Resources Table -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-20">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Body</th>
              <th scope="col" class="px-6 py-3">Image</th>
              <th scope="col" class="px-6 py-3">Url</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="resource in resources"
              :key="resource.id"
              class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
            >
              <td class="px-6 py-4">{{ resource.title }}</td>
              <td class="px-6 py-4">{{ resource.body }}</td>
              <td class="px-6 py-4">
                <img :src="resource.image" alt="Resource Image" class="w-16 h-16 object-cover rounded" />
              </td>
              <td class="px-6 py-4">{{ resource.url }}</td>
              <td class="px-6 py-4">{{ resource.status }}</td>
              <td class="px-6 py-4">
                <a @click="editResource(resource)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                <a @click="deleteResource(resource.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Edit Resource Modal -->
      <EditResourceModal :isOpen="showEditModal" :resource="currentResource" @close="showEditModal = false" @updated="fetchResources" />
    </div>
  </template>
  
  <script>
  import EditResourceModal from '@/components/AdminComponents/EditResourceModal.vue';
  import AddResourceModal from '@/components/AdminComponents/AddResourceModal.vue';
  
  export default {
    components: {
      EditResourceModal,
      AddResourceModal,
    },
    data() {
      return {
        resources: [
          {
            id: 1,
            title: 'First Resource',
            body: 'This is the body of the first resource.',
            image: 'image1.jpg',
            url: 'https://example.com/resource1',
            status: 'published',
          },
          {
            id: 2,
            title: 'Second Resource',
            body: 'This is the body of the second resource.',
            image: 'image2.jpg',
            url: 'https://example.com/resource2',
            status: 'draft',
          },
        ],
        showEditModal: false,
        showAddModal: false,
        currentResource: null,
      };
    },
    methods: {
      editResource(resource) {
        this.currentResource = { ...resource }; // Create a copy of the resource to edit
        this.showEditModal = true;
      },
      deleteResource(resourceId) {
        // Remove the resource from the static array
        this.resources = this.resources.filter((resource) => resource.id !== resourceId);
      },
      fetchResources() {
        // Fetch or refresh resources from the server or static data
        console.log('Fetching resources...');
      },
    },
  };
  </script>
  