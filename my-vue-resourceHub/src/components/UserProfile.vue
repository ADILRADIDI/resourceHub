<template>
    <h1 class="text-3xl font-bold mx-10 py-5">Your Profile</h1>
    <div class="user-profile py-6 rounded-lg shadow-md filter backdrop-blur-md mx-4 ">
      <div class="profile-grid">
        <!-- Profile Picture -->
        <div class="profile-image">
          <img :src="userProfileImage" alt="Profile Picture" class="rounded-full shadow-lg">
        </div>
  
        <!-- User Information -->
        <div class="user-info text-center bg-white p-4 rounded-lg shadow-sm">
          <h2 class="text-2xl font-semibold text-gray-800">{{ username }}</h2>
          <p class="text-gray-500">{{ userLocation }}</p>
          <p class="text-gray-500">{{ userPronouns }}</p>
          <p class="text-gray-500">{{ userJoinDate }}</p>
        </div>
  
        <!-- Skills Section -->
        <div class="skills bg-gray-100 p-4 rounded-lg shadow-sm">
          <h3 class="text-lg font-semibold text-gray-800">Skills/Languages</h3>
          <ul class="list-disc list-inside text-gray-700">
            <li v-for="skill in skills" :key="skill">{{ skill }}</li>
          </ul>
        </div>
  
        <!-- Recent Comments Section -->
        <div class="recent-comments bg-white p-4 rounded-lg shadow-sm">
          <h3 class="text-lg font-semibold text-gray-800">Recent Comments</h3>
          <ul class="list-disc list-inside text-gray-700">
            <li v-for="comment in userPosts" :key="comment.id">
              <strong>{{ comment.title }}</strong>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRoute } from 'vue-router';
  
  // Assume you fetch user data based on the user ID
  const route = useRoute();
  const userId = route.params.userId;
  
  const username = ref('João Angelo');
  const userProfileImage = ref('https://via.placeholder.com/80'); // Replace with actual image URL if available
  const userLocation = ref('Brazil');
  const userPronouns = ref('He / Him');
  const userJoinDate = ref('Joined on Oct 8, 2019');
  const skills = ref([
    'Angular', 'Angular Material', 'Nx', 'C#', '.NET Core', 'HTML 5', 'CSS', 
    'Microservices', 'RabbitMQ', 'DDD', 'SOLID', 'Clean Code', 
    'DevOps', 'Docker', 'Kubernetes', 'Bitbucket', 'GitHub'
  ]);
  
  const userPosts = ref([]);
  
  // Fetch user data and posts
  onMounted(() => {
    // Mock data for demonstration
    userPosts.value = [
      {
        id: 1,
        title: 'Dynamic IDs in Angular Components',
        timeCreated: 'Sep 2'
      },
      {
        id: 2,
        title: 'You shouldn\'t use EventEmitters in Angular services',
        timeCreated: 'Sep 2'
      },
      {
        id: 3,
        title: 'Display Angular @empty block at the right time!',
        timeCreated: 'Sep 2'
      }
    ];
  });
  </script>
  
  <style scoped>
  .user-profile {
    max-width: 800px;
    margin: auto;
    background: rgba(255, 255, 255, 0.6); /* Semi-transparent background */
    backdrop-filter: blur(10px); /* Blurred background filter */
    border-radius: 10px;
    padding: 20px;
  }
  
  .profile-grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
    grid-gap: 20px;
    margin: 20px 0;

  }
  
  .profile-image {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .profile-image img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 50%;
  }
  
  .user-info, .skills, .recent-comments {
    padding: 20px;
    border-radius: 10px;
  }
  
  .user-info {
    grid-column: span 2;
    background-color: white;
  }
  
  .skills {
    background-color: #f7f7f7; /* Light gray */
  }
  
  .recent-comments {
    background-color: white;
  }
  
  @media (max-width: 768px) {
    .profile-grid {
      grid-template-columns: 1fr;
      text-align: center;
    }
  
    .user-info, .skills, .recent-comments {
      grid-column: span 1;
    }
  
    .profile-image img {
      width: 120px;
      height: 120px;
    }
  }
  
  @media (max-width: 480px) {
    .user-profile {
      padding: 15px;
    }
  
    .profile-grid {
      grid-gap: 15px;
    }
    
    h1 {
      font-size: 1.75rem;
    }
  }
  </style>
  