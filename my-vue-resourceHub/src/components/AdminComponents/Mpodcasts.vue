<template>
  <div class="flex">
    <!-- Sidebar -->
    <Sidebar class="w-56" />

    <!-- Main Content -->
    <div class="flex-1 ml-56 p-4 mt-20">
      <h1 class="font-bold text-2xl mb-5">Manage Podcasts</h1>

      <!-- Add Podcast Button -->
      <button @click="showAddModal = true" class="mb-5 px-4 py-2 bg-blue-500 text-white rounded-lg">
        Add Podcast
      </button>

      <!-- Podcasts Table -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">ID</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="podcast in podcasts" :key="podcast.id" class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700">
              <td class="px-6 py-4">{{ podcast.id }}</td>
              <td class="px-6 py-4">{{ podcast.title }}</td>
              <td class="px-6 py-4">{{ podcast.description }}</td>
              <td class="px-6 py-4">{{ podcast.status }}</td>
              <td class="px-6 py-4">
                <button @click="editPodcast(podcast)" class="mr-3 font-medium text-blue-600 dark:text-blue-500 hover:underline">
                  Edit
                </button>
                <button @click="deletePodcast(podcast.id)" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                  Delete
                </button>
                <button @click="publishPodcast(podcast.id)" class="font-medium text-green-600 dark:text-green-500 hover:underline">
                  Publish
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Add Podcast Modal -->
      <div v-if="showAddModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
          <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Add New Podcast</h3>
            <form @submit.prevent="addPodcast" class="mt-2 text-left">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                  Title
                </label>
                <input v-model="form.title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Podcast Title" required>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                  Description
                </label>
                <textarea v-model="form.description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" placeholder="Podcast Description" required></textarea>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="logo">
                  Logo
                </label>
                <input @change="handleFileUpload" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="logo" type="file" accept="image/*">
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="audio_url">
                  Audio URL
                </label>
                <input v-model="form.audio_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="audio_url" type="text" placeholder="Audio URL">
              </div>
              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Add Podcast
                </button>
                <button @click="showAddModal = false" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Edit Podcast Modal -->
      <div v-if="showEditModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
          <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Podcast</h3>
            <form @submit.prevent="updatePodcast" class="mt-2 text-left">
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit-title">
                  Title
                </label>
                <input v-model="form.title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edit-title" type="text" placeholder="Podcast Title" required>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit-description">
                  Description
                </label>
                <textarea v-model="form.description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edit-description" placeholder="Podcast Description" required></textarea>
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit-logo">
                  Logo
                </label>
                <input @change="handleFileUpload" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edit-logo" type="file" accept="image/*">
              </div>
              <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit-audio_url">
                  Audio URL
                </label>
                <input v-model="form.audio_url" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="edit-audio_url" type="text" placeholder="Audio URL">
              </div>
              <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Update Podcast
                </button>
                <button @click="showEditModal = false" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                  Cancel
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Sidebar from '@/components/AdminComponents/Sidebar.vue';
import { API_BASE_URL } from '@/config';

export default {
  components: {
    Sidebar,
  },
  setup() {
    const podcasts = ref([]);
    const showAddModal = ref(false);
    const showEditModal = ref(false);
    const form = ref({
      title: '',
      description: '',
      logo: null,
      audio_url: '',
    });

    const fetchPodcasts = async () => {
      try {
        const response = await axios.get(`${API_BASE_URL}getAllpd`);
        podcasts.value = response.data;
        console.log(response.data);
      } catch (error) {
        console.error('Error fetching podcasts:', error);
      }
    };

    const handleFileUpload = (event) => {
      form.value.logo = event.target.files[0];
    };

    const addPodcast = async () => {
      try {
        const formData = new FormData();
        formData.append('title', form.value.title);
        formData.append('description', form.value.description);
        formData.append('logo', form.value.logo);
        formData.append('audio_url', form.value.audio_url);

        await axios.post(`${API_BASE_URL}podcasts`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        fetchPodcasts();
        showAddModal.value = false;
      } catch (error) {
        console.error('Error adding podcast:', error);
      }
    };

    const editPodcast = (podcast) => {
      form.value = { ...podcast };
      showEditModal.value = true;
    };

    const updatePodcast = async () => {
      try {
        const formData = new FormData();
        formData.append('title', form.value.title);
        formData.append('description', form.value.description);
        formData.append('logo', form.value.logo);
        formData.append('audio_url', form.value.audio_url);

        await axios.post(`${API_BASE_URL}podcasts/${form.value.id}`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });
        fetchPodcasts();
        showEditModal.value = false;
      } catch (error) {
        console.error('Error updating podcast:', error);
      }
    };

    const deletePodcast = async (id) => {
      try {
        await axios.delete(`${API_BASE_URL}podcasts/${id}`);
        fetchPodcasts();
      } catch (error) {
        console.error('Error deleting podcast:', error);
      }
    };

    const publishPodcast = async (id) => {
      try {
        await axios.post(`${API_BASE_URL}publishPodcast/${id}`);
        fetchPodcasts();
      } catch (error) {
        console.error('Error publishing podcast:', error);
      }
    };

    onMounted(() => {
      fetchPodcasts();
    });

    return {
      podcasts,
      form,
      showAddModal,
      showEditModal,
      addPodcast,
      editPodcast,
      updatePodcast,
      deletePodcast,
      publishPodcast,
      handleFileUpload,
    };
  },
};
</script>

<style scoped>
/* Your styles */
</style>
