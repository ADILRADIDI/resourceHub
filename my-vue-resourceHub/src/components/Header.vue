<template>
    <!-- Main Container -->
    <div id="header" class="bg-white shadow-md py-4 px-6 flex items-center
     justify-between ">
     <!-- fixed top-0 left-0 w-full z-50 -->
      <!-- Header Section with Logo and Search -->
      <div id="header" class="flex items-center space-x-4 w-full">
        <!-- Logo -->
        <div class="logo text-white p-2 rounded-lg flex items-center justify-center bg-black font-bold text-lg">
          <router-link to="/">
            <h1>RDEV</h1>
          </router-link>
        </div>
        <!-- Search Bar -->
        <div class="w-4/5">
          <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <svg xmlns="http://www.w3.org/2000/svg"  class="h-5 w-5 text-gray-500" viewBox="0 -960 960 960"
                 fill="#5f6368"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
            </span>
            <input type="search" placeholder="Search..." name="search" id="search-input"
              class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
          </div>

        </div>
      </div>
      <!-- Navigation Links -->
      <div class="flex items-center space-x-4">
        <router-link to="login" class="text-gray-600 hover:text-black transition transform hover:-translate-y-2">Login</router-link>
        <router-link to="register" class="text-white bg-indigo-600 hover:bg-indigo-700 py-2 px-4 rounded-lg transition transform hover:-translate-y-2 ">Register</router-link>
      </div>
    </div>
  </template>
  
  <script setup>
  </script>
  
  <style scoped>
  /* Adjust container styling for better aesthetics */
  #container {
      /* White background */
    background-color: #ffffff;
  }
  
  /* Styling the search input */
  #search-input {
    background-color: #f7f7f7;
  }
  
  /* Adding hover effects to links */
  a {
    transition: color 0.3s ease;
  }
  
  /* Styling the Create Account button */
  a.bg-indigo-600 {
    transition: background-color 0.3s ease;
  }
  </style>
  