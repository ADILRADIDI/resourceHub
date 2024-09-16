<template>
    <div class="mx-10 mt-10">
      <h1 class="text-2xl font-bold mb-6">Manage YouTube Channels</h1>
  
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
                <button @click="acceptChannel(channel)" class="text-green-600 hover:underline">Accept</button>
                <button @click="rejectChannel(channel)" class="text-red-600 hover:underline">Reject</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <!-- Alerts -->
      <div v-if="alert.message" :class="`fixed top-4 right-4 p-4 rounded-lg shadow-lg ${alert.type === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`">
        {{ alert.message }}
        <button @click="alert.message = ''" class="ml-4 text-sm font-semibold underline">Close</button>
      </div>
    </div>
  </template>
<script>
export default {
  data() {
    return {
      channels: [
        {
          id: 17,
          channel_name: 'pofffsss',
          channel_url: 'https://www.youtube.com/channel/Zco3s6lQ4N1xfAYwQ0rILw1bPIxTvXAX38WA...',
          status: 'draft',
          created_at: '2024-09-03 22:37:29',
          updated_at: '2024-09-03 22:37:29',
        },
        // Additional channel objects...
      ],
      alert: {
        type: '',
        message: ''
      }
    };
  },
  methods: {
    acceptChannel(channel) {
      // Logic for accepting the channel
      this.showAlert('success', `Channel ${channel.channel_name} has been accepted.`);
    },
    rejectChannel(channel) {
      // Logic for rejecting the channel
      this.showAlert('error', `Channel ${channel.channel_name} has been rejected.`);
    },
    showAlert(type, message) {
      this.alert.type = type;
      this.alert.message = message;
      setTimeout(() => {
        this.alert.message = '';
      }, 3000); // Hide alert after 3 seconds
    },
    getStatusColor(status) {
      switch (status) {
        case 'published':
          return 'text-green-500';
        case 'archived':
          return 'text-red-500';
        default:
          return 'text-gray-500';
      }
    }
  }
};
</script>
  