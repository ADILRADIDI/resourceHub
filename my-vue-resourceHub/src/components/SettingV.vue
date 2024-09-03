<script setup>
import { ref } from 'vue';

const user = ref({
  name: 'ADIL RADIDI',
  email: 'adilradidi212@gmail.com',
  website: 'https://adilradidi.netlify.app/',
  location: 'Casablanca, Morocco',
  bio: 'Développeur Full Stack Junior spécialisé dans la pile Vue.js / Laravel',
  coding: '',
  availableFor: '',
  skills: 'laravel, vuejs, Nextjs, Uml, javascript, PHP, Html5 & css, tailwind css, bootstrap, sql, mysql',
  currentlyHackingOn: '',
  pronouns: '',
  work: '',
  education: '',
  brandColor: '#ffffff',
  currentPassword: '',
  newPassword: '',
  confirmPassword: '',
  profileImage: ''
});

const showDeleteModal = ref(false);
const handleDeleteAccount = () => {
  showDeleteModal.value = true;
};
const confirmDelete = () => {
  // Handle account deletion logic here
  showDeleteModal.value = false;
};
const cancelDelete = () => {
  showDeleteModal.value = false;
};
</script>

<template>
  <div class="container mx-auto px-4 py-8">
    <div class="profile-settings bg-white p-6 border rounded-lg shadow-lg mb-8">
      <h1 class="font-bold text-3xl text-gray-800 mb-6">Profile Settings</h1>


      <!-- Profile Image -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Profile Image</h2>
        <div class="flex items-center">
          <img :src="user.profileImage" alt="Profile Image" class="w-24 h-24 rounded-full mr-4" />
          <input type="file" class="p-2 border rounded-lg" />
        </div>
      </div>

      
      <!-- User Info -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">User Information</h2>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Name</label>
          <input type="text" v-model="user.name" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Email</label>
          <input type="email" v-model="user.email" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <button class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg">Save Profile Information</button>
        </div>
      </div>



      <!-- Account -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Account</h2>
        <p>Email verification. You have requested a change to <strong>{{ user.email }}</strong>. Check your inbox for the verification link to finalize the change.</p>
        <!-- Social Authentication Buttons -->
        <div class="flex justify-center space-x-4 mt-6 mb-10">
          <button class="w-32 py-2 px-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            <img src="../../public/img/githubIcon.png" alt="GitHub" class="mx-auto h-6">
          </button>
          <button class="w-32 py-2 px-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            <img src="../../public/img/gitlabIcon.png" alt="GitLab" class="mx-auto h-8">
          </button>
          <button class="w-32 py-2 px-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
            <img src="../../public/img/googleIcon.png" alt="Google" class="mx-auto h-8">
          </button>
        </div>
      </div>

      <!-- Password Change -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Change Password</h2>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Current Password</label>
          <input type="password" v-model="user.currentPassword" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">New Password</label>
          <input type="password" v-model="user.newPassword" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
          <input type="password" v-model="user.confirmPassword" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <button class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg">Change Password</button>
        </div>
      </div>

      

      

      <!-- Customization -->
      <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Customization</h2>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Website URL</label>
          <input type="url" v-model="user.website" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Location</label>
          <input type="text" v-model="user.location" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Bio</label>
          <textarea v-model="user.bio" class="p-2 border rounded-lg w-full" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Coding</label>
          <textarea v-model="user.coding" class="p-2 border rounded-lg w-full" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Available For</label>
          <textarea v-model="user.availableFor" class="p-2 border rounded-lg w-full" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Skills/Languages</label>
          <textarea v-model="user.skills" class="p-2 border rounded-lg w-full" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Currently Hacking On</label>
          <textarea v-model="user.currentlyHackingOn" class="p-2 border rounded-lg w-full" rows="3"></textarea>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Pronouns</label>
          <input type="text" v-model="user.pronouns" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Work</label>
          <input type="text" v-model="user.work" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 font-medium mb-1">Education</label>
          <input type="text" v-model="user.education" class="p-2 border rounded-lg w-full" />
        </div>
        <div class="mb-4">
          <label for="hs-color-input" class="block text-sm font-medium mb-2">Brand Color for your background-Cover</label>
          <input type="color" class="p-1 h-10 w-14 block bg-gray-300 border border-gray-200 cursor-pointer rounded-lg disabled:opacity-50 disabled:pointer-events-none" id="hs-color-input" v-model="user.brandColor" title="Choose your color" />
        </div>

        <!--  -->
        <!-- Delete Account -->
      <div class="mb-6">
        <button @click="handleDeleteAccount" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg">Delete My Account</button>
      </div>

      <!-- Modal -->
      <div v-if="showDeleteModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-6 border rounded-lg shadow-lg w-96">
          <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
          <p class="mb-4">Please type "I want delete" to confirm account deletion.</p>
          <input type="text" v-model="confirmDeleteInput" class="p-2 border rounded-lg w-full mb-4" placeholder="Type here..." />
          <div class="flex justify-end space-x-4">
            <button @click="confirmDelete" class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg">Delete</button>
            <button @click="cancelDelete" class="px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg">Cancel</button>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 1200px;
}

.profile-settings {
  background-color: #ffffff;
}

input[type="text"], input[type="email"], input[type="url"], textarea {
  border: 1px solid #d1d5db;
}

input[type="color"] {
  border: none;
}

button {
  cursor: pointer;
}

button:hover {
  opacity: 0.9;
}

.bg-blue-600 {
  background-color: #1d4ed8;
}

.bg-green-600 {
  background-color: #16a34a;
}

.bg-red-600 {
  background-color: #dc2626;
}

.bg-gray-600 {
  background-color: #4b5563;
}

@media (max-width: 768px) {
  .container {
    padding: 2rem;
  }

  .profile-settings {
    padding: 2rem;
  }
}
</style>
