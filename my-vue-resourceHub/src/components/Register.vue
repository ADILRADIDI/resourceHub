<template>
    <div id="container" class="flex h-screen">
      <!-- Left Side (Image) -->
      <div id="partieLeft" class="hidden md:block w-1/2">
        <img src="../../public/img/backgroundRegister.png" alt="backgroundLogin" 
        class="w-full h-full object-cover">
      </div>
      
      <!-- Right Side (Form) -->
      <div id="partieRight" class="flex flex-col justify-center items-center w-full md:w-1/2 p-8 bg-gray-100">
        <img src="../../public/img/logoWithoutBackground.png" alt="logo" class="w-72 ">
        <h1 class="text-3xl font-bold mb-6">Create Your Account</h1>
  
        <!-- Registration Form -->
        <form class="w-full max-w-sm">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" placeholder="Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" placeholder="Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" placeholder="Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="mb-6">
            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="confirm-password" placeholder="Confirm Password" class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-[#EDF2F4] focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          
          <button type="submit" class="w-full py-2 px-4 bg-black text-white rounded-full hover:bg-white hover:text-black transition-colors">
            Register
          </button>
        </form>
  
        <!-- Or Divider -->
        <div class="flex items-center justify-center w-full mt-6">
          <hr class="w-full border-gray-300">
          <span class="mx-3">or</span>
          <hr class="w-full border-gray-300">
        </div>
  
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
    </div>
  </template>
  
  <style scoped>
  #container {
    background-color: #f5f5f5;
  }
  </style>
  