<template>
    <div class="ad-container">

        <!-- Ad 2 -->
      <div class="ad-item mt-5 mb-5 mx-3">
        <img src="../../public/img/logoWithoutBackground.png" alt="Ad Image 2" class="ad-image">
        <div class="ad-content">
          <h3 class="ad-heading">Get account premium in resourceHub</h3>
          <p class="ad-text">This is a brief description of the ad. It highlights key information and benefits.</p>
          <a href="#" class="ad-button">Get Now</a>
        </div>
      </div>

      <!-- Ad 1 -->
      <div class="ad-item mt-5 mb-5 mx-3">
        <img src="https://res.cloudinary.com/practicaldev/image/fetch/s--GPRPp7Ba--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_100%2Cw_350/https://billboards.forem.tools/rails/active_storage/blobs/redirect/eyJfcmFpbHMiOnsibWVzc2FnZSI6IkJBaHBBbGNDIiwiZXhwIjpudWxsLCJwdXIiOiJibG9iX2lkIn19--81f4f05c27808f68c1e91590ff950026157d3fd0/Screenshot%25202024-07-19%2520at%252012.04.24%25E2%2580%25AFPM.png"
         alt="Ad Image 1" class="ad-image">
        <div class="ad-content">
          <h3 class="ad-heading">Ad Heading 1</h3>
          <p class="ad-text">Neon is the official database partner of Resource .</p>
          <a href="#" class="ad-button">Visit Now</a>
        </div>
      </div>
  
      
  
      <!-- Ad 3 -->
      <div class="ad-item mt-5 mb-5 mx-3">
        <img src="../../public/img/backgroundRegister.png" alt="Ad Image 3" class="ad-image">
        <div class="ad-content">
          <h3 class="ad-heading">Do you know Perplexity ai</h3>
          <p class="ad-text">This is a brief description of the ad. It highlights key information and benefits.</p>
          <a href="#" class="ad-button">Visit Now</a>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  </script>
  
  <style scoped>
  .ad-container {
    gap: 1rem;
    margin: 2rem auto;
    max-width: 1200px;
  }
  
  .ad-item {
    display: flex;
    flex-direction: column;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    background-color: #ffffff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }
  
  .ad-image {
    width: 100%;
    height: auto;
  }
  
  .ad-content {
    padding: 1rem;
  }
  
  .ad-heading {
    font-size: 1.25rem;
    font-weight: bold;
    color: #1f2937;
  }
  
  .ad-text {
    font-size: 1rem;
    color: #4b5563;
    margin: 0.5rem 0;
  }
  
  .ad-button {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: bold;
    color: #ffffff;
    background-color: #3b82f6;
    border-radius: 0.375rem;
    text-align: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }
  
  .ad-button:hover {
    background-color: #2563eb;
    transform: scale(1.05);
  }
  
  @media (min-width: 768px) {
    .ad-container {
      flex-direction: row;
      flex-wrap: wrap;
      gap: 1.5rem;
    }
    .ad-item {
      flex: 1;
      max-width: 100%;
    }
  }
  </style>
  