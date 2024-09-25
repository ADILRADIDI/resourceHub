<template>
  <!-- Main Container -->
  <div id="header" class="bg-white shadow-md py-4 px-6 flex items-center justify-between">
    <!-- Menu Button (Visible on mobile and tablets) -->
    <button @click="toggleAside" class="md:hidden p-2 rounded-full hover:bg-gray-100 mx-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>

    <!-- Header Section with Logo and Search -->
    <div class="flex items-center space-x-4 w-full">
      <!-- Logo -->
      <div class="logo text-white p-2 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
        <router-link to="/">
          <h1>RDEV</h1>
        </router-link>
      </div>
    </div>

    <!-- Create Post Button -->
    <router-link to="/new" class="text-blue-700 border-solid border-indigo-500 border-2 
      hover:text-white hover:bg-indigo-500 py-2 px-4 rounded-lg w-36">
      <span class="flex items-center justify-center">Create Post</span>
    </router-link>

    <!-- Notifications Icon -->
    <router-link to="/Mynotification">
      <button class="p-2 rounded-full hover:bg-gray-100 mx-2 relative">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
        <!-- Notification Counter (only show if unreadNotifications > 0) -->
        <span v-if="unreadNotifications > 0"
          class="absolute top-1 right-1 inline-block w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full">
          {{ unreadNotifications }}
        </span>
      </button>
    </router-link>

    <!-- User Avatar -->
    <div class="relative" @click="toggleDropdown" tabindex="0">
      <img
        :src="userProfile.profile_picture ? `http://localhost:8000/storage/uploads/profile_pictures/${userProfile.profile_picture}` : Image_Unkown_user"
        :alt="`${userProfile.name} profile picture`"
        class=" rounded-full mx-10 object-cover cursor-pointer w-11 h-11 flex items-center justify-center"
      />
      <!-- Dropdown menu -->
      <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg">
        <router-link to="/me" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition transform hover:-translate-y-1">Profile</router-link>
        <router-link to="/SettingV" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition transform hover:-translate-y-1">Settings</router-link>
        <button @click="logout" class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100 text-left transition transform hover:-translate-y-1">Logout</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { API_BASE_URL, API_BASE_URL_WITHOUT, Image_Unkown_user } from '@/config'; // Ensure these constants are defined
// import Image_Unkown_user from '@/assets/unknown-user.jpg';

export default {
  data() {
    return {
      isDropdownOpen: false,
      unreadNotifications: 0,
      userProfile: {
        profile_picture: null,
        name: 'User',
      },
      loading: true,
      errorMessage: '',
    };
  },
  setup() {
    const userProfile = ref({});
    const loading = ref(true);
    const errorMessage = ref('');

    const router = useRouter();

    const logout = async () => {
      try {
        await axios.post(`${API_BASE_URL}logout`, {}, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`
          }
        });
        // Clear the token from localStorage
        localStorage.removeItem('user-token');
        localStorage.removeItem('user-id');
        // Redirect to login or home page
        router.push('/login');
      } catch (error) {
        console.error('Logout error:', error);
      }
    };

    const fetchUserProfile = async () => {
      try {
        const userId = localStorage.getItem('user-id');
        const response = await axios.get(`${API_BASE_URL}profile/${userId}`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        userProfile.value = response.data;
        console.log('User profile fetched:', userProfile.value);
      } catch (error) {
        console.error('Error fetching user profile:', error);
        errorMessage.value = 'Error fetching user profile. Please try again later.';
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      fetchUserProfile();
    });

    return { logout, userProfile, loading, errorMessage };
  },
  methods: {
    toggleDropdown(event) {
      this.isDropdownOpen = !this.isDropdownOpen;
      event.stopPropagation();
    },
    closeDropdown(event) {
      if (!this.$el.contains(event.relatedTarget)) {
        this.isDropdownOpen = false;
      }
    },
    async fetchUnreadNotifications() {
      try {
        const response = await axios.get(`${API_BASE_URL}notifications`, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('user-token')}`
          }
        });

        if (Array.isArray(response.data)) {
          this.unreadNotifications = response.data.filter(notification => notification.read === 0).length;
        } else {
          this.unreadNotifications = 0;
        }
      } catch (error) {
        console.error('Error fetching notifications:', error);
      }
    }
  },
  mounted() {
    this.fetchUnreadNotifications();
    setInterval(() => {
      this.fetchUnreadNotifications();
    }, 60000);
  }
};
</script>


