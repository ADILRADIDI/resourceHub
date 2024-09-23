<template>
  <div class="container mx-auto px-4 py-8">
    <div class="profile-settings bg-white p-6 border rounded-lg shadow-lg mb-8">
      <h1 class="font-bold text-3xl text-gray-800 mb-6">Profile Settings</h1>

      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-semibold mb-2">Profile Image</h2>
        <div class="flex items-center">
          <img :src="user.profileImage || Image_Unkown_user" alt="Profile Image" class="w-24 h-24 rounded-full mr-4" />
          <input type="file" @change="handleProfilePictureUpload" class="p-2 border rounded-lg" />
        </div>
        <button @click="updateProfilePicture" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-full ">Update Profile Picture</button>
      </div>

      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">User Information</h2>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Name</label>
          <input type="text" v-model="user.name" class="p-2 border rounded-lg w-full" />
          <button @click="updateName" class="px-4 py-2 bg-gray-300 text-white font-semibold rounded-full mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
              <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
            </svg>
          </button>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Email</label>
          <input type="email" v-model="user.email" class="p-2 border rounded-lg w-full" />
          <button @click="updateEmail" class="px-4 py-2 bg-gray-300 text-white font-semibold rounded-full mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
               <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Bio</h2>
        <textarea v-model="user.bio" class="p-2 border rounded-lg w-full" rows="4" placeholder="Tell us about yourself"></textarea>
        <button @click="updateBio" class="flex items-center px-4 py-2 bg-gray-300 text-white font-semibold rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
            <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
          </svg>
        </button>
      </div>

      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Skills</h2>
        <input type="text" v-model="user.skills" class="p-2 border rounded-lg w-full" placeholder="Enter your skills (comma-separated)" />
        <button @click="updateSkills" class="px-4 py-2 bg-gray-300 text-white font-semibold rounded-full mt-2">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
            <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
          </svg>
        </button>
      </div>

      <!-- <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Change Password</h2>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Current Password</label>
          <input type="password" v-model="user.current_password" required class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">New Password</label>
          <input type="password" v-model="user.new_password" required class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
          <input type="password" v-model="user.confirm_password" required class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <button @click="changePassword" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg">Change Password</button>
        </div>
      </div> -->


      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Customization</h2>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Website URL</label>
          <input type="url" v-model="user.website" class="p-2 border rounded-lg w-full" />
          <button @click="updateWebsite" class="px-4 py-2 bg-gray-300 text-white font-semibold rounded-full mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
            <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
          </svg>
          </button>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">GitHub URL</label>
          <input type="url" v-model="user.github" placeholder="https://github.com/yourusername" class="p-2 border rounded-lg w-full" />
          <button @click="updateGithub" class="px-4 py-2 bg-gray-300 text-white font-semibold rounded-full mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
              <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
            </svg>
          </button>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Location</label>
          <input type="text" v-model="user.location" class="p-2 border rounded-lg w-full" />
          <button @click="updateLocation" class="px-4 py-2 bg-gray-300 text-white font-semibold rounded-full mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4 mr-1">
              <path d="M368.4 18.3L312.7 74.1 437.9 199.3l55.7-55.7c21.9-21.9 21.9-57.3 0-79.2L447.6 18.3c-21.9-21.9-57.3-21.9-79.2 0zM288 94.6l-9.2 2.8L134.7 140.6c-19.9 6-35.7 21.2-42.3 41L3.8 445.8c-3.8 11.3-1 23.9 7.3 32.4L164.7 324.7c-3-6.3-4.7-13.3-4.7-20.7c0-26.5 21.5-48 48-48s48 21.5 48 48s-21.5 48-48 48c-7.4 0-14.4-1.7-20.7-4.7L33.7 500.9c8.6 8.3 21.1 11.2 32.4 7.3l264.3-88.6c19.7-6.6 35-22.4 41-42.3l43.2-144.1 2.7-9.2L288 94.6z"/>
            </svg>
          </button>
        </div>
      </div>

      <div>
        <button @click="deleteAccount" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-full">Delete Account</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { API_BASE_URL, Image_Unkown_user } from '@/config';

export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
        website: '',
        github: '',
        location: '',
        bio: '', // Add this line
        skills: '', // Add this line
        current_password: '',
        new_password: '',  
        confirm_password: '',
        confirmPassword: '',
        profileImage: null,
      },
    };
  },
  mounted() {
    this.fetchUserProfile();
  },
  methods: {
    async fetchUserProfile() {
      const userId = localStorage.getItem('user-id');
      try {
        const response = await axios.get(`${API_BASE_URL}profile/${userId}`, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        this.user = response.data;
      } catch (error) {
        console.error(error);
      }
    },
    handleProfilePictureUpload(event) {
      const file = event.target.files[0];
      this.user.profileImage = file;
    },
    async updateProfilePicture() {
      const formData = new FormData();
      if (this.user.profileImage) {
        formData.append('profile_image', this.user.profileImage);
      }

      try {
        await axios.post(`${API_BASE_URL}profile/update/profile-picture`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        alert('Profile picture updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update profile picture');
      }
    },
    async updateName() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/name`, { name: this.user.name }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        // alert('Name updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update name');
      }
    },
    async updateEmail() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/email`, { email: this.user.email }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        // alert('Email updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update email');
      }
    },
    async updateBio() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/bio`, { bio: this.user.bio }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        // alert('Bio updated successfully');
        console.log('Bio updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update bio');
      }
    },

    async updateSkills() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/skills`, { skills: this.user.skills }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        console.log('Skills updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update skills');
      }
    },

    async updateWebsite() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/website`, { website: this.user.website }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        // alert('Website updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update website');
      }
    },
    async updateGithub() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/github`, { github: this.user.github }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        // alert('GitHub URL updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update GitHub URL');
      }
    },
    async updateLocation() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/location`, { location: this.user.location }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        // alert('Location updated successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to update location');
      }
    },
    async changePassword() {
      if (!this.user.current_password || !this.user.new_password || !this.user.confirm_password) {
        alert('All fields are required.');
        return;
      }

      if (this.user.new_password !== this.user.confirm_password) {
        alert('New passwords do not match.');
        return;
      }

      console.log('Current Password:', this.user.current_password);
      console.log('New Password:', this.user.new_password);
      console.log('Confirm New Password:', this.user.confirm_password);

      const payload = {
        current_password: this.user.current_password,
        new_password: this.user.new_password,
        new_password_confirmation: this.user.confirm_password,
      };

      try {
        const response = await axios.post(`${API_BASE_URL}profile/update/password`, payload, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        alert('Password changed successfully');
      } catch (error) {
          console.error('Error details:', error);
          if (error.response) {
            console.error('Response data:', error.response.data);
            console.error('Response status:', error.response.status);
          }
          const errorMessage = error.response?.data?.message || 'Failed to change password';
          alert(errorMessage);
      }

    }
,

    async deleteAccount() {
      const confirmDelete = confirm('Are you sure you want to delete your account?');
      if (!confirmDelete) return;

      try {
        await axios.delete(`${API_BASE_URL}profile/delete-account`, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        alert('Account deleted successfully');
      } catch (error) {
        console.error(error);
        alert('Failed to delete account');
      }
    },
  },
};
</script>

<style scoped>
</style>
