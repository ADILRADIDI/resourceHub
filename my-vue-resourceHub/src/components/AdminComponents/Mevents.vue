<template>
  <div class="flex">
    <!-- Sidebar Component -->
    <Sidebar />

    <!-- Main Content -->
    <main class="flex-1 p-6 mt-20">
      <h1 class="text-2xl font-semibold mb-4">Manage Events</h1>

      <!-- Add Event Button -->
      <div class="mb-4">
        <button @click="openAddModal" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Add Event</button>
      </div>

      <!-- Table Container with Scroll -->
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Start Time</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">End Time</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Example Row, Replace with Dynamic Data -->
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">Tech Conference 2024</td>
              <td class="px-6 py-4 whitespace-nowrap">A conference about the latest in tech.</td>
              <td class="px-6 py-4 whitespace-nowrap">Casablanca</td>
              <td class="px-6 py-4 whitespace-nowrap">2024-09-13 09:00:00</td>
              <td class="px-6 py-4 whitespace-nowrap">2024-09-14 17:00:00</td>
              <td class="px-6 py-4 whitespace-nowrap">Planned</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <button @click="openEditModal(1)" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                <button @click="deleteEvent(1)" class="text-red-600 hover:text-red-900">Delete</button>
              </td>
            </tr>
            <!-- Repeat rows as needed -->
          </tbody>
        </table>
      </div>

      <!-- Add Event Modal -->
      <AddEventModal :isOpen="isAddModalOpen" @close="closeAddModal" />

      <!-- Edit Event Modal -->
      <EditEventModal :isOpen="isEditModalOpen" :eventId="editingEventId" @close="closeEditModal" />
    </main>
  </div>
</template>

<script>
import AddEventModal from './AddEventModal.vue';
import EditEventModal from './EditEventModal.vue';
import Sidebar from './Sidebar.vue';

export default {
  components: {
    AddEventModal,
    EditEventModal,
    Sidebar,
  },
  data() {
    return {
      isAddModalOpen: false,
      isEditModalOpen: false,
      editingEventId: null,
    };
  },
  methods: {
    openAddModal() {
      this.isAddModalOpen = true;
    },
    closeAddModal() {
      this.isAddModalOpen = false;
    },
    openEditModal(eventId) {
      this.editingEventId = eventId;
      this.isEditModalOpen = true;
    },
    closeEditModal() {
      this.isEditModalOpen = false;
    },
    deleteEvent(eventId) {
      // Logic to delete the event
    },
  },
};
</script>

<style scoped>
/* Sidebar styling */
aside {
  min-height: 100vh; /* Ensure sidebar spans full viewport height */
}

/* Main content styling */
main {
  margin-left: 16rem; /* Adjust based on sidebar width */
}
</style>
