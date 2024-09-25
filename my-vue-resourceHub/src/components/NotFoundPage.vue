<template>
    <div class="not-found-container">
      <div class="content">
        <img src="../../public/img/notFound.jpg" alt="Not Found Icon" class="w-1/4 h-1/4 rounded-lg"/>
        <h1 class="mt-10 text-4xl font-bold mb-5">Oops! Page not found.</h1>
        <p class="mb-10 text-lg text-gray-600">The page you're looking for doesn't exist.</p>
        <button @click="goHome" class="home-btn">Go to Home</button>
      </div>
    </div>
</template>
  
  <script>
  export default {
    methods: {
      goHome() {
        this.$router.push('/');
      }
    }
  }
  </script>
  
  <style scoped>
  .not-found-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f3f4f6;
  }
  
  .content {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  
  .home-btn {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .home-btn:hover {
    background-color: #0056b3;
  }
  
  img {
    object-fit: cover;
  }
  
  h1 {
    font-size: 2.5rem;
    color: #333;
  }
  
  p {
    font-size: 1.2rem;
    color: #666;
  }
  </style>
  