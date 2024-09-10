<script setup>
// Update Vue.js Component
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';

const store = useStore();
const notifications = ref([]);
const selectedFilter = ref('all');

// Fetch notifications from the Laravel API
const fetchNotifications = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/notifications');
    notifications.value = response.data;
    store.commit('SET_NOTIFICATIONS', response.data);
    console.log(response.data);
  } catch (error) {
    console.error('Error fetching notifications:', error);
  }
};

onMounted(() => {
  fetchNotifications();
});

// Computed property to filter notifications based on the selected filter
const filteredNotifications = computed(() => {
  if (selectedFilter.value === 'all') {
    return notifications.value;
  }
  return notifications.value.filter(notification => notification.type === selectedFilter.value);
});

// Function to mark a single notification as read
const markAsRead = async (id) => {
  try {
    await axios.post(`http://127.0.0.1:8000/api/notifications/${id}/mark-as-read`);
    store.dispatch('markAsRead', id);
    // Optionally update the local notifications state
    notifications.value = notifications.value.map(notification =>
      notification.id === id ? { ...notification, read: true } : notification
    );
  } catch (error) {
    console.error('Error marking notification as read:', error);
  }
};

// Function to mark all notifications as read
const markAllAsRead = async () => {
  try {
    await axios.post('http://127.0.0.1:8000/api/notifications/mark-all-as-read');
    store.dispatch('markAllAsRead');
    notifications.value = notifications.value.map(notification => ({ ...notification, read: true }));
  } catch (error) {
    console.error('Error marking all notifications as read:', error);
  }
};

// Function to clear all notifications
const clearAllNotifications = async () => {
  try {
    await axios.delete('http://127.0.0.1:8000/api/notifications');
    store.dispatch('clearNotifications');
    notifications.value = [];
  } catch (error) {
    console.error('Error clearing notifications:', error);
  }
};

</script>

<template>
  <main class="main-container flex justify-center">
    <div class="w-full max-w-3xl">
      <div class="flex items-center justify-between mx-12 mt-8">
        <h1 class="text-3xl font-bold">Notifications</h1>
      </div>

      <!-- Filter Options -->
      <div class="flex justify-between items-center mx-12 mt-4">
        <div class="flex space-x-4">
          <button
            @click="selectedFilter = 'all'"
            :class="selectedFilter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
            class="px-4 py-2 rounded-lg"
          >
            All
          </button>
          <button
            @click="selectedFilter = 'follow'"
            :class="selectedFilter === 'follow' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
            class="px-4 py-2 rounded-lg"
          >
            Followed
          </button>
          <button
            @click="selectedFilter = 'like'"
            :class="selectedFilter === 'like' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700'"
            class="px-4 py-2 rounded-lg"
          >
            Liked Posts
          </button>
        </div>

        <!-- Mark all as read button -->
        <button @click="markAllAsRead" class="text-lg hover:bg-gray-300 px-5 py-2 rounded-lg">
          Mark All as Read
        </button>

        <button @click="clearAllNotifications" class="text-lg hover:bg-gray-300 px-5 py-2 rounded-lg">
          Clear All
        </button>
      </div>

      <!-- Notifications List -->
      <div class="notification-wrapper mt-10 mx-10">
        <div
          v-for="notification in filteredNotifications"
          :key="notification.id"
          @click="markAsRead(notification.id)"
          class="notification-container p-6 rounded-lg shadow-md mb-6 h-32"
          :class="notification.read ? 'bg-gray-200 border-gray-500' : 'bg-white border-blue-500'"
        >
          <div class="flex items-center">
            <img
              src="https://via.placeholder.com/40"
              alt="Profile Picture"
              class="w-10 h-10 rounded-full mr-4"
            />
            <div>
              <router-link :to="notification.userLink">
                <p class="font-semibold text-gray-800 hover:text-blue-500">
                  {{ notification.username }}
                </p>
              </router-link>
              <p class="text-sm text-gray-500">{{ notification.time }}</p>
            </div>
          </div>
          <p class="mt-5 text-gray-700">
            <router-link :to="notification.userLink" class="font-bold text-blue-500">
              {{ notification.username }}
            </router-link>
            {{ notification.action }}
            <template v-if="notification.type === 'like'">
              your
              <router-link :to="notification.postLink" class="text-blue-500 font-semibold">
                post
              </router-link>
              .
            </template>
          </p>
        </div>
      </div>
    </div>
  </main>
</template>

<style>
.main-container {
  background-color: #F5F5F5;
  min-height: 100vh;
}
</style>
