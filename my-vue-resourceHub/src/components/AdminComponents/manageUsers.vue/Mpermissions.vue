<template>
  <div>
    <div class="flex justify-between items-center mx-20 mt-20 bg-gray-50 rounded-full px-10 shadow-md">
      <h1 class="font-bold text-2xl">Manage Permissions</h1>
      <div class="mb-4">
        <button @click="openAddPermissionModal" class="bg-blue-500 text-white px-4 py-2 rounded-full mt-3 hover:bg-blue-600">
          Add Permission
        </button>
      </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-20 mt-5">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Permission Name</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="permission in permissions" :key="permission.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">{{ permission.name }}</td>
            <td class="px-6 py-4">
              <button @click="openEditPermissionModal(permission)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
              <button @click="deletePermission(permission.id)" class="font-medium text-black hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Add Permission Modal -->
    <div v-if="showAddPermissionModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Add Permission</h3>
        <form @submit.prevent="addPermission">
          <div class="mb-4">
            <label for="permission-name" class="block text-gray-700">Permission Name</label>
            <input v-model="newPermission.name" id="permission-name" type="text" class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="closeAddPermissionModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit Permission Modal -->
    <div v-if="showEditPermissionModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Edit Permission</h3>
        <form @submit.prevent="updatePermission">
          <div class="mb-4">
            <label for="edit-permission-name" class="block text-gray-700">Permission Name</label>
            <input v-model="currentPermission.name" id="edit-permission-name" type="text" class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="closeEditPermissionModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { API_BASE_URL } from '@/config';
import axios from 'axios';

export default {
  data() {
    return {
      permissions: [],
      showAddPermissionModal: false,
      showEditPermissionModal: false,
      newPermission: {
        name: ''
      },
      currentPermission: {}
    };
  },
  created() {
    this.fetchPermissions();
  },
  methods: {
    fetchPermissions() {
      axios.get(`${API_BASE_URL}permissions`)
        .then(response => {
          this.permissions = response.data;
        })
        .catch(error => {
          console.error('Error fetching permissions:', error);
        });
    },
    openAddPermissionModal() {
      this.showAddPermissionModal = true;
    },
    closeAddPermissionModal() {
      this.showAddPermissionModal = false;
      this.resetNewPermission();
    },
    openEditPermissionModal(permission) {
      this.currentPermission = { ...permission };
      this.showEditPermissionModal = true;
    },
    closeEditPermissionModal() {
      this.showEditPermissionModal = false;
      this.resetCurrentPermission();
    },
    addPermission() {
      axios.post(`${API_BASE_URL}permissions`, this.newPermission)
        .then(response => {
          this.permissions.push(response.data.permission);
          this.closeAddPermissionModal();
        })
        .catch(error => {
          console.error('Error adding permission:', error);
        });
    },
    updatePermission() {
      axios.put(`${API_BASE_URL}permissions/${this.currentPermission.id}`, this.currentPermission)
        .then(response => {
          const index = this.permissions.findIndex(permission => permission.id === this.currentPermission.id);
          this.permissions.splice(index, 1, response.data.permission);
          this.closeEditPermissionModal();
        })
        .catch(error => {
          console.error('Error updating permission:', error);
        });
    },
    deletePermission(id) {
      axios.delete(`${API_BASE_URL}permissions/${id}`)
        .then(response => {
          this.permissions = this.permissions.filter(permission => permission.id !== id);
        })
        .catch(error => {
          console.error('Error deleting permission:', error);
        });
    },
    resetNewPermission() {
      this.newPermission = {
        name: ''
      };
    },
    resetCurrentPermission() {
      this.currentPermission = {};
    }
  }
};
</script>

<style scoped>
/* Add any additional styles if necessary */
</style>
