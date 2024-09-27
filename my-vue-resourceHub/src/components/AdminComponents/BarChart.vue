<template>
    <div>
      <Bar :chart-data="chartData" />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Bar } from 'vue-chartjs';
  import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js';
  
  // Register necessary components
  ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);
  
  const chartData = ref({
    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
    datasets: [
      {
        label: 'Active Users',
        backgroundColor: '#42A5F5',
        data: [40, 20, 12, 39, 10, 40],
      },
    ],
  });
  </script>
  
  <style scoped>
  /* Add additional styling if necessary */
  </style>
  