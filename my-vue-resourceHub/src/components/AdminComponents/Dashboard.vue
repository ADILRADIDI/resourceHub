<template>
  <div class="container mx-auto px-4 py-6">
    <!-- Welcome Section -->
    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-blue-600 mb-4">Welcome to RDEV Admin Panel</h1>
    </div>

    <!-- Key Metrics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ml-36">
      <div class="p-6 bg-yellow-500 text-white rounded-lg shadow-lg">
        <h2 class="text-xl font-bold">Total Posts not Accepted</h2>
        <p class="text-2xl mt-2">1,234</p>
      </div>
      <div class="p-6 bg-blue-500 text-white rounded-lg shadow-lg">
        <h2 class="text-xl font-bold">Total Podcasts not Accepted</h2>
        <p class="text-2xl mt-2">567</p>
      </div>
      <div class="p-6 bg-green-500 text-white rounded-lg shadow-lg">
        <h2 class="text-xl font-bold">Total Events not Accepted</h2>
        <p class="text-2xl mt-2">567</p>
      </div>
      <div class="p-6 bg-blue-500 text-white rounded-lg shadow-lg">
        <h2 class="text-xl font-bold">Total Tags not Accepted</h2>
        <p class="text-2xl mt-2">600</p>
      </div>
      <div class="p-6 bg-yellow-500 text-white rounded-lg shadow-lg">
        <h2 class="text-xl font-bold">Total Yt-channels not Accepted</h2>
        <p class="text-2xl mt-2">1,234</p>
      </div>
    </div>

    <!-- Chart Section -->
    <!-- <div class="mt-10  bg-white rounded-lg shadow-lg p-6">
      <canvas id="userChart" width="400" height="200"></canvas>
    </div> -->
  </div>
</template>

<script>
// import { Chart, registerables } from 'chart.js';

export default {
  name: 'Dashboard',
  mounted() {
    // Register the chart components
    Chart.register(...registerables);

    this.$nextTick(() => {
      this.renderChart();
    });
  },
  methods: {
    renderChart() {
      const ctx = document.getElementById('userChart').getContext('2d');
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June'],
          datasets: [
            {
              label: 'User Growth',
              data: [100, 200, 300, 400, 500, 600],
              backgroundColor: 'rgba(54, 162, 235, 0.2)',
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
            },
          ],
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    },
  },
};

</script>

<style scoped>
/* Responsive grid and typography */
.container {
  max-width: 1200px;
}
</style>
