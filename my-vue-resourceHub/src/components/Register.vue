<template>
  <div id="container" class="flex h-screen">
    <!-- Left Side (Image) -->
    <div id="partieLeft" class="hidden md:block w-1/2">
      <img src="../../public/img/backgroundRegister.png" alt="backgroundLogin" class="w-full h-full object-cover" />
    </div>

    <!-- Right Side (Form) -->
    <div id="partieRight" class="flex flex-col justify-center items-center w-full md:w-1/2 p-8 bg-gray-100">
      <img src="../../public/img/logoWithoutBackground.png" alt="logo" class="w-72" />
      <h1 class="text-3xl font-bold mb-6">Create Your Account</h1>

      <!-- Registration Form -->
      <form @submit.prevent="register" class="w-full max-w-sm">
        <div class="mb-4">
          <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="name" type="text" id="name" placeholder="Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="email" type="email" id="email" placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input v-model="password" type="password" id="password" placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="mb-6">
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
          <input v-model="confirmPassword" type="password" id="confirm-password" placeholder="Confirm Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded-full hover:bg-white hover:text-black transition-colors">
          Register
        </button>
      </form>

      <!-- Or Divider -->
      <div class="flex items-center justify-center w-full mt-6">
        <hr class="w-full border-gray-300" />
        <span class="mx-3">or</span>
        <hr class="w-full border-gray-300" />
      </div>

      <!-- Social Authentication Buttons -->
      <div class="flex justify-center space-x-4 mt-6 mb-10">
        <button class="w-32 py-2 px-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
          <img src="../../public/img/githubIcon.png" alt="GitHub" class="mx-auto h-6" />
        </button>
        <button class="w-32 py-2 px-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
          <img src="../../public/img/gitlabIcon.png" alt="GitLab" class="mx-auto h-8" />
        </button>
        <button class="w-32 py-2 px-4 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
          <img src="../../public/img/googleIcon.png" alt="Google" class="mx-auto h-8" />
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios';
import { API_BASE_URL } from '../config';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      confirmPassword: '',
      error: '',
      isLoading: false
    };
  },
  methods: {
    async register() {
      // Check if passwords match
      if (this.password !== this.confirmPassword) {
        this.error = 'Passwords do not match!';
        return;
      }

      try {
        // Send POST request to register endpoint with password confirmation
        const response = await axios.post(`${API_BASE_URL}register`, {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.confirmPassword
        });
        console.log(response.data)
        const token = response.data.token;
        const userId = response.data.user_id;
        const roles = response.data.roles;

        localStorage.setItem('user-token', token);
        localStorage.setItem('user-id', userId);
        localStorage.setItem('user-role', roles); 


        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

        // Redirect to dashboard after successful registration
        this.$router.push('/');
      } catch (error) {
        console.error('Registration error:', error.response ? error.response.data : error.message);
        this.error = error.response?.data?.message || 'An error occurred during registration';
      }
    }
  }
};
</script>

<style scoped>
#container {
  background-color: #f5f5f5;
}
</style>
