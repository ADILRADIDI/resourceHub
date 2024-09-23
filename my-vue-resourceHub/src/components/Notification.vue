<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from '../axios'; // Use your axios configuration
import { API_BASE_URL } from '@/config';

const notifications = ref([]);
const selectedFilter = ref('all');

// Fetch notifications from the Laravel API
const fetchNotifications = async () => {
  try {
    const token = localStorage.getItem('user-token'); // Retrieve the token
    const response = await axios.get(`${API_BASE_URL}notifications`, {
      headers: {
        Authorization: `Bearer ${token}` // Set the authorization header
      }
    });
    notifications.value = response.data; // Ensure the response has the correct structure
  } catch (error) {
    console.error('Error fetching notifications:', error);
  }
};

// Fetch notifications on component mount
onMounted(fetchNotifications);

// Computed property to filter notifications
const filteredNotifications = computed(() => {
  return selectedFilter.value === 'all'
    ? notifications.value
    : notifications.value.filter(n => n.type === selectedFilter.value);
});

// Mark a notification as read
const markAsRead = async (id) => {
  try {
    const token = localStorage.getItem('user-token'); // Retrieve the token
    await axios.post(`${API_BASE_URL}notifications/${id}/mark-as-read`, {}, {
      headers: {
        Authorization: `Bearer ${token}` // Set the authorization header
      }
    });
    notifications.value = notifications.value.map(n =>
      n.id === id ? { ...n, read: true } : n
    );
  } catch (error) {
    console.error('Error marking notification as read:', error);
  }
};

// Mark all notifications as read
const markAllAsRead = async () => {
  try {
    const token = localStorage.getItem('user-token'); // Retrieve the token
    await axios.post(`${API_BASE_URL}notifications/mark-all-as-read`, {}, {
      headers: {
        Authorization: `Bearer ${token}` // Set the authorization header
      }
    });
    notifications.value.forEach(n => n.read = true);
  } catch (error) {
    console.error('Error marking all notifications as read:', error);
  }
};

// Clear all notifications
const clearAllNotifications = async () => {
  try {
    const token = localStorage.getItem('user-token'); // Retrieve the token
    await axios.delete(`${API_BASE_URL}notifications`, {
      headers: {
        Authorization: `Bearer ${token}` // Set the authorization header
      }
    });
    notifications.value = [];
    console.log(notifications.value);
  } catch (error) {
    console.error('Error clearing notifications:', error);
  }
};
</script>
<template>
  <main class="main-container flex justify-center">
    <div class="w-full max-w-3xl">
      <h1 class="text-3xl font-bold mx-12 mt-8">Notifications</h1>

      <!-- Filter Options -->
      <div class="flex justify-between items-center mx-12 mt-4">
        <div class="flex space-x-4">
          <button @click="selectedFilter = 'all'" :class="{'bg-blue-500 text-white': selectedFilter === 'all'}" class="px-4 py-2 rounded-lg">All</button>
          <button @click="selectedFilter = 'follow'" :class="{'bg-blue-500 text-white': selectedFilter === 'follow'}" class="px-4 py-2 rounded-lg">Followed</button>
          <button @click="selectedFilter = 'like'" :class="{'bg-blue-500 text-white': selectedFilter === 'like'}" class="px-4 py-2 rounded-lg">Liked Posts</button>
        </div>
        <div class="flex space-x-4">
          <button @click="markAllAsRead" class="text-lg hover:bg-gray-300 px-5 py-2 rounded-lg">Mark All as Read</button>
          <button @click="clearAllNotifications" class="text-lg hover:bg-gray-300 px-5 py-2 rounded-lg">Clear All</button>
        </div>
      </div>

      <!-- Notifications List -->
      <div class="notification-wrapper mb-44 mx-10">
        <template v-if="filteredNotifications.length === 0">
          <img src="../../public/img/readingListIcon1.png" alt="Empty List" class="w-1/3 mx-auto mt-10">
          <p class="text-xl font-bold text-center mt-10">
            No notifications yet. Start engaging with content to receive updates!
          </p>
        </template>
        <template v-else>
          <div v-for="notification in filteredNotifications" :key="notification.id" @click="markAsRead(notification.id)" 
          class="notification-container p-6 rounded-lg shadow-md mb-6 cursor-pointer mt-5" :class="notification.read ? 'bg-gray-200' : 'bg-white'">
            <div>
              <span class="flex items-center justify-start">
                <img src="https://via.placeholder.com/40" alt="Profile" class="w-10 h-10 rounded-full mr-4" />
                <span>
                  <p class="font-semibold">{{ notification.username }}</p>
                  <p class="text-sm text-gray-500">{{ notification.time }}</p>
                </span>
              </span>
              <p class="mt-5 ml-14 text-gray-700 font-mono">{{ notification.action }}</p>
            </div>
          </div>
        </template>
      </div>
    </div>
  </main>
</template>
