<template>
  <div class="flex flex-col lg:flex-row">
    <!-- Sidebar Component -->
    <Sidebar class="lg:w-1/4 lg:flex-shrink-0 lg:sticky lg:top-0 lg:h-screen" />

    <!-- Main Content -->
    <div class="flex-1 p-4 lg:p-10 lg:ml-56 md:ml-32 lg:pl-10 lg:mt-10">
      <h1 class="text-2xl font-bold mb-6">Manage YouTube Channels</h1>

      <div class="mb-4">
        <button @click="openAddChannelModal" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add Channel</button>
      </div>

      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Channel Name</th>
              <th scope="col" class="px-6 py-3">Channel URL</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="channel in channels" :key="channel.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="px-6 py-4">{{ channel.id }}</td>
              <td class="px-6 py-4">{{ channel.channel_name }}</td>
              <td class="px-6 py-4">
                <a :href="channel.channel_url" class="text-blue-600 dark:text-blue-500 hover:underline" target="_blank">
                  {{ channel.channel_url }}
                </a>
              </td>
              <td class="px-6 py-4">
                <span :class="getStatusColor(channel.status)">
                  {{ channel.status }}
                </span>
              </td>
              <td class="px-6 py-4 flex space-x-4">
                <button @click="openEditChannelModal(channel)" class="text-blue-600 hover:underline">Edit</button>
                <button @click="confirmDeleteChannel(channel)" class="text-red-600 hover:underline">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add Channel Modal -->
      <div v-if="showAddChannelModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96">
          <h3 class="text-xl font-semibold mb-4">Add YouTube Channel</h3>
          <form @submit.prevent="addChannel">
            <div class="mb-4">
              <label for="channel-name" class="block text-gray-700">Channel Name</label>
              <input v-model="newChannel.channel_name" id="channel-name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="channel-url" class="block text-gray-700">Channel URL</label>
              <input v-model="newChannel.channel_url" id="channel-url" type="url" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="status" class="block text-gray-700">Status</label>
              <select v-model="newChannel.status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
              </select>
            </div>
            <div class="flex justify-end">
              <button type="button" @click="closeAddChannelModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
              <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Edit Channel Modal -->
      <div v-if="showEditChannelModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96">
          <h3 class="text-xl font-semibold mb-4">Edit YouTube Channel</h3>
          <form @submit.prevent="updateChannel">
            <div class="mb-4">
              <label for="edit-channel-name" class="block text-gray-700">Channel Name</label>
              <input v-model="currentChannel.channel_name" id="edit-channel-name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="edit-channel-url" class="block text-gray-700">Channel URL</label>
              <input v-model="currentChannel.channel_url" id="edit-channel-url" type="url" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="edit-status" class="block text-gray-700">Status</label>
              <select v-model="currentChannel.status" id="edit-status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
              </select>
            </div>
            <div class="flex justify-end">
              <button type="button" @click="closeEditChannelModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
              <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Delete Confirmation Modal -->
      <div v-if="showDeleteConfirmation" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full sm:w-96">
          <h3 class="text-xl font-semibold mb-4">Confirm Delete</h3>
          <p>Are you sure you want to delete the channel <strong>{{ channelToDelete.channel_name }}</strong>?</p>
          <div class="flex justify-end mt-4">
            <button type="button" @click="closeDeleteConfirmation" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="button" @click="deleteChannel" class="ml-3 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Sidebar from './Sidebar.vue'; // Import Sidebar component

export default {
  components: {
    Sidebar // Register Sidebar component
  },
  data() {
    return {
      channels: [],
      showAddChannelModal: false,
      showEditChannelModal: false,
      showDeleteConfirmation: false,
      newChannel: {
        channel_name: '',
        channel_url: '',
        status: 'draft',
      },
      currentChannel: null,
      channelToDelete: null,
    };
  },
  methods: {
    openAddChannelModal() {
      this.showAddChannelModal = true;
    },
    closeAddChannelModal() {
      this.showAddChannelModal = false;
    },
    openEditChannelModal(channel) {
      this.currentChannel = { ...channel };
      this.showEditChannelModal = true;
    },
    closeEditChannelModal() {
      this.showEditChannelModal = false;
    },
    confirmDeleteChannel(channel) {
      this.channelToDelete = channel;
      this.showDeleteConfirmation = true;
    },
    closeDeleteConfirmation() {
      this.showDeleteConfirmation = false;
    },
    addChannel() {
      // Logic to add channel
      this.closeAddChannelModal();
    },
    updateChannel() {
      // Logic to update channel
      this.closeEditChannelModal();
    },
    deleteChannel() {
      // Logic to delete channel
      this.closeDeleteConfirmation();
    },
    getStatusColor(status) {
      switch (status) {
        case 'published':
          return 'text-green-500';
        case 'draft':
          return 'text-yellow-500';
        case 'archived':
          return 'text-gray-500';
        default:
          return 'text-red-500';
      }
    }
  },
};
</script>

<style scoped>
/* Media query for responsive layout adjustments */
@media (max-width: 1024px) {
  .lg\:w-1\/4 {
    width: 100%;
  }
  .lg\:sticky {
    position: relative;
    top: auto;
  }
  .lg\:h-screen {
    height: auto;
  }
}
</style>
