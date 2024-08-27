<script setup>
import { ref } from 'vue';

// Reactive variables for profile data
const name = ref('');
const email = ref('');
const password = ref('');
const newPassword = ref('');
const confirmPassword = ref('');
const profilePhoto = ref(null);
const brandColor = ref('#ffffff'); // Default color
const bio = ref('');
const theme = ref('light'); // Default theme

// Handle form submission for profile updates
const updateProfile = () => {
  console.log('Profile updated with:', {
    name: name.value,
    email: email.value,
    bio: bio.value,
    brandColor: brandColor.value,
  });
};

// Handle password change
const changePassword = () => {
  if (newPassword.value !== confirmPassword.value) {
    console.error('Passwords do not match');
    return;
  }
  console.log('Password changed');
};

// Handle theme change
const changeTheme = (newTheme) => {
  theme.value = newTheme;
  console.log('Theme changed to:', theme.value);
};

// Handle account deletion
const deleteAccount = () => {
  console.log('Account deleted');
};
</script>

<template>
  <div class="profile-settings">
    <h1>Profile Settings</h1>
    
    <!-- Update Profile Information -->
    <section class="update-profile">
      <h2>Update Profile</h2>
      <form @submit.prevent="updateProfile">
        <div>
          <label for="name">Name:</label>
          <input id="name" v-model="name" type="text" />
        </div>
        <div>
          <label for="email">Email:</label>
          <input id="email" v-model="email" type="email" />
        </div>
        <div>
          <label for="bio">Bio:</label>
          <textarea id="bio" v-model="bio"></textarea>
        </div>
        <div>
          <label for="brandColor">Brand Color:</label>
          <input id="brandColor" v-model="brandColor" type="color" />
        </div>
        <div>
          <label for="profilePhoto">Profile Photo:</label>
          <input id="profilePhoto" type="file" @change="e => profilePhoto.value = e.target.files[0]" />
        </div>
        <button type="submit">Update Profile</button>
      </form>
    </section>
    
    <!-- Change Password -->
    <section class="change-password">
      <h2>Change Password</h2>
      <form @submit.prevent="changePassword">
        <div>
          <label for="currentPassword">Current Password:</label>
          <input id="currentPassword" v-model="password" type="password" />
        </div>
        <div>
          <label for="newPassword">New Password:</label>
          <input id="newPassword" v-model="newPassword" type="password" />
        </div>
        <div>
          <label for="confirmPassword">Confirm New Password:</label>
          <input id="confirmPassword" v-model="confirmPassword" type="password" />
        </div>
        <button type="submit">Change Password</button>
      </form>
    </section>
    
    <!-- Theme Customization -->
    <section class="theme-customization">
      <h2>Theme Customization</h2>
      <button @click="changeTheme('light')">Light Theme</button>
      <button @click="changeTheme('dark')">Dark Theme</button>
    </section>
    
    <!-- Delete Account -->
    <section class="delete-account">
      <h2>Delete Account</h2>
      <button @click="deleteAccount">Delete Account</button>
    </section>
  </div>
</template>

<style scoped>
.profile-settings {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

section {
  margin-bottom: 20px;
}

form div {
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea,
input[type="color"],
input[type="file"] {
  width: 100%;
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
