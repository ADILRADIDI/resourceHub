<template>
    <div v-if="isOpen" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-gray-900 opacity-60" @click="$emit('close')"></div>
      <div class="bg-white p-6 rounded-lg shadow-xl z-10 w-full max-w-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Event</h2>
        <div v-if="currentStep === 1">
          <form @submit.prevent="nextStep">
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
              <input v-model="event.title" type="text" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
              <textarea v-model="event.description" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" rows="4" required></textarea>
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
              <input v-model="event.city" type="text" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>
            <div class="flex justify-between mb-4">
              <button type="button" @click="$emit('close')" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Next</button>
            </div>
          </form>
        </div>
        <div v-if="currentStep === 2">
          <form @submit.prevent="updateEvent">
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">Start Time</label>
              <input v-model="event.start_time" type="datetime-local" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>
            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-2">End Time</label>
              <input v-model="event.end_time" type="datetime-local" class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>
            <div class="flex justify-between mb-4">
              <button type="button" @click="prevStep" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Back</button>
              <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      isOpen: {
        type: Boolean,
        required: true
      },
      eventId: {
        type: Number,
        required: true
      }
    },
    data() {
      return {
        currentStep: 1,
        event: {
          title: '',
          description: '',
          city: '',
          start_time: '',
          end_time: '',
          status: 'planned'
        }
      };
    },
    methods: {
      nextStep() {
        this.currentStep = 2;
      },
      prevStep() {
        this.currentStep = 1;
      },
      updateEvent() {
        // Logic to update the event with this.eventId
        this.$emit('close');
      }
    }
  };
  </script>
  
  <style scoped>
  /* Modal styling */
  .fixed.inset-0 {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  </style>
  