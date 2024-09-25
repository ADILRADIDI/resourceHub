<template>
  <div id="container" class="flex h-screen">
    <div id="partieLeft" class="flex flex-col justify-center items-center w-full md:w-1/2 p-8 bg-gray-100">
      <img src="../../public/img/logoWithoutBackground.png" alt="logo" class="w-96">
      <h1 class="text-3xl font-bold mb-6">Welcome Back!</h1>
      <h5 class="text-gray-600 mb-6">Please enter your details</h5>

      <!-- Authentication Buttons -->
      <div class="flex justify-center space-x-4 mt-6">
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

      <!-- Or Divider -->
      <div class="flex items-center justify-center w-full mt-6">
        <hr class="w-full border-gray-300">
        <span class="mx-3">or</span>
        <hr class="w-full border-gray-300">
      </div>

      <!-- Login Form -->
      <form @submit.prevent="login" class="w-full max-w-sm">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="email" type="email" id="email" placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input v-model="password" type="password" id="password" placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center">
            <input type="checkbox" id="remember" class="mr-2 h-4 w-4 text-blue-500 focus:ring-blue-400 border-gray-300 rounded">
            <label for="remember" class="text-sm text-gray-600">Remember me</label>
          </div>
          <!-- <a href="#" class="text-sm text-blue-500 hover:underline">Forgot password?</a> -->
        </div>

        <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded-full hover:bg-white hover:text-black transition-colors">
          Login
        </button>
      </form>
      <br>
      <hr class="my-6 w-full border-gray-300">
      <p class="text-center text-sm text-gray-600">
        New to RDEV Community? 
        <router-link class="text-blue-500 hover:underline" to="/register">Create account</router-link>
      </p>
    </div>

    <div id="partieRight" class="hidden md:block w-1/2">
      <img src="../../public/img/backgroundLogin.png" alt="backgroundLogin" class="w-full h-full object-cover">
    </div>
  </div>
</template>

<script>
// Login.vue
import axios from 'axios';
import { API_BASE_URL } from '../config'; 

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
      error: ''
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post(`${API_BASE_URL}login`, {
          email: this.email,
          password: this.password
        });
        console.log(response.data)
        const token = response.data.token;
        const userid = response.data.user_id;
        const roles = response.data.roles;

        localStorage.setItem('user-token', token);
        localStorage.setItem('user-id', userid);
        localStorage.setItem('user-role', roles); 

        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
        
        if (response.data.roles.includes('super-admin')) {
          console.log('success login')
          this.$router.push('/DashboardAdmin');
        } else {
          this.$router.push('/');
        }
      } catch (error) {
        console.log('failed bro login')
        console.error('Login error:', error.response ? error.response.data : error.message);
        this.error = error.response?.data?.message || 'An error occurred';
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
