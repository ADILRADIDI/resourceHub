<template>
  <div class="container mx-auto px-4 py-8">
    <div class="profile-settings bg-white p-6 border rounded-lg shadow-lg mb-8">
      <h1 class="font-bold text-3xl text-gray-800 mb-6">Profile Settings</h1>

      <!-- <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-semibold mb-2">Profile Image</h2>
        <div class="flex items-center">
          <img
            :src="user.profile_picture ? `http://localhost:8000/storage/uploads/${user.profile_picture}` : Image_Unkown_user"
            width="30"
            height="30"
            class="crayons-avatar__image w-24 h-24 rounded-full mx-10 mt-5"
          />
          <input type="file" @change="handleProfilePictureUpload" class="p-2 border rounded-lg" />
        </div>
        <button @click="updateProfilePicture" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-full ">Update Profile Picture</button>
      </div> -->

      <!-- :src="user.profile_picture ? `http://localhost:8000/storage/uploads/profile_pictures/${user.profile_picture}` : Image_Unkown_user" -->
      <!-- :src="user.profile_picture ? `http://localhost:8000/storage/uploads/profile_pictures/` : Image_Unkown_user" -->

      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-xl font-semibold mb-2">Profile Image</h2>
        <!-- profile_pictures/2DFsjL8mGLU142C1tgRbTjpoCWz5edaWA8Z18wRj.jpg -->
        <div class="flex items-center">
            <img
                :src="user.profile_picture ? `http://localhost:8000/storage/uploads/profile_pictures/${user.profile_picture}` : Image_Unkown_user"
                width="30"
                height="30"
                class="crayons-avatar__image w-24 h-24 rounded-full mx-10 mt-5"
                alt="Profile Image"
            />
            <!-- <input type="file" @change="handleProfilePictureUpload" class="p-2 border rounded-lg" /> -->
            <!-- Custom File Input -->
            <div class="relative">
              <input
                type="file"
                @change="handleProfilePictureUpload"
                id="profile-picture-input"
                class="hidden"
              />
              <label
                for="profile-picture-input"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-lg hover:bg-blue-700 cursor-pointer transition-colors duration-300"
              >
                Update Profile Picture
              </label>
              <span v-if="selectedFileName" class="ml-2 text-gray-500">{{ selectedFileName }}</span>
            </div>
        </div>
        <button 
            @click="updateProfilePicture"
            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-full"
            :disabled="isLoading"
        >
            <span v-if="isLoading">Updating...</span>
            <span v-else>Update Profile Picture</span>
        </button>
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
import { API_BASE_URL,  Image_Unkown_user, API_BASE_URL_WITHOUT} from '@/config';



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
        profile_picture: null,
        current_password: '',
        new_password: '',  
        confirm_password: '',
      },
      isLoading: false,
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
        console.log('this is image in setting', this.user.profile_picture);
        console.log(response.data);
        
      } catch (error) {
        console.error(error);
      }
    },
    handleProfilePictureUpload(event) {
      const file = event.target.files[0];
      this.user.profile_picture = file; // Update to store file in user object
    },
    async updateProfilePicture() {
        if (!this.user.profile_picture) return;
        this.isLoading = true;
        const formData = new FormData();
        formData.append('profile_picture', this.user.profile_picture);

        try {
            const response = await axios.post(`${API_BASE_URL}profile/updatepicture`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
                },
            });

            // Check if response contains the expected profile picture filename
            if (response.data.profile_picture) {
                this.user.profile_picture = response.data.profile_picture; // Set the filename
            } else {
                console.error('No profile picture returned in response:', response.data);
            }

            // Construct the full URL only if the filename exists
            const fullPath = this.user.profile_picture 
                ? `http://localhost:8000/storage/uploads/profile_pictures/${this.user.profile_picture}`
                : Image_Unkown_user; // Use default image if undefined
            console.log('Updated Profile Picture URL:', fullPath);
        } catch (error) {
            console.error('Error updating profile picture:', error);
        } finally {
            this.isLoading = false;
        }
    }

,
    async updateName() {
      try {
        await axios.post(`${API_BASE_URL}profile/update/name`, { name: this.user.name }, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        alert('Name updated successfully');
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
        alert('Email updated successfully');
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
        alert('Website updated successfully');
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
        alert('GitHub URL updated successfully');
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
        alert('Location updated successfully');
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

      const payload = {
        current_password: this.user.current_password,
        new_password: this.user.new_password,
        new_password_confirmation: this.user.confirm_password,
      };

      try {
        await axios.post(`${API_BASE_URL}profile/update/password`, payload, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('user-token')}`,
          },
        });
        alert('Password changed successfully');
      } catch (error) {
        console.error('Error details:', error);
        const errorMessage = error.response?.data?.message || 'Failed to change password';
        alert(errorMessage);
      }
    },
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
