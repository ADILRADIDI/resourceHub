<template>
  <div>
    <!-- Header and Add User Button -->
    <div class="flex justify-between items-center mx-20 mt-20 bg-gray-50 rounded-full px-10 shadow-md">
      <h1 class="font-bold text-2xl">Manage Users</h1>
      <div class="mb-4">
        <button @click="openAddModal" class="bg-blue-500 text-white px-4 py-2 rounded-full mt-3 hover:bg-blue-600">
          Add User
        </button>
      </div>
    </div>

    <!-- User Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-20 mt-5">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">Roles</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">{{ user.name }}</td>
            <td class="px-6 py-4">{{ user.email }}</td>
            <td class="px-6 py-4">
              <span v-for="role in user.roles" :key="role.id" class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                {{ role.name }}
              </span>
            </td>
            <td class="px-6 py-4">
              <button @click="openEditModal(user)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">
                Edit
              </button>
              <button @click="deleteUser(user.id)" class="font-medium mr-3 text-black hover:underline">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Add User Modal -->
    <div v-if="showAddModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-xl font-semibold">Add User</h3>
        <form @submit.prevent="addUser">
          <div class="mb-4">
            <label for="add-name" class="block text-gray-700">Name</label>
            <input v-model="newUser.name" id="add-name" type="text" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
          </div>
          <div class="mb-4">
            <label for="add-email" class="block text-gray-700">Email</label>
            <input v-model="newUser.email" id="add-email" type="email" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
          </div>
          <div class="mb-4">
            <label for="add-password" class="block text-gray-700">Password</label>
            <input v-model="newUser.password" id="add-password" type="password" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
          </div>
          <div class="mb-4">
            <label for="add-password-confirmation" class="block text-gray-700">Confirm Password</label>
            <input v-model="newUser.password_confirmation" id="add-password-confirmation" type="password" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Role</label>
            <select v-model="newUser.role" required class="mt-1 block w-full border border-gray-300 rounded-md py-2 outline-none shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option value="">Select Role</option>
              <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
            </select>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="closeAddModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit User Modal -->
    <div v-if="showEditModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg p-6 w-1/3">
        <h3 class="text-xl font-semibold">Edit User</h3>
        <form @submit.prevent="updateUser">
          <div class="mb-4">
            <label for="edit-name" class="block text-gray-700">Name</label>
            <input v-model="currentUser.name" id="edit-name" type="text" class="mt-1 block w-full outline-none h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
          </div>
          <div class="mb-4">
            <label for="edit-email" class="block text-gray-700">Email</label>
            <input v-model="currentUser.email" id="edit-email" type="email" class="mt-1 block w-full outline-none h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required />
          </div>
          <!-- <div class="mb-4">
            <label class="block text-gray-700">Role</label>
            <select v-model="currentUser.role" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
              <option value="">Select Role</option>
              <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
            </select>
          </div> -->
          <div class="flex justify-end">
            <button type="button" @click="closeEditModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { API_BASE_URL } from "@/config"; // API base URL from your configuration

// Set token for authenticated requests
const token = localStorage.getItem("user-token");
if (token) {
  axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}

export default {
  data() {
    return {
      users: [],
      newUser: { name: "", email: "", password: "", password_confirmation: "", role: "" },
      currentUser: {},
      roles: [], // Make sure to fetch user roles
      showAddModal: false,
      showEditModal: false,
    };
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await axios.get(`${API_BASE_URL}users`);
        this.users = response.data;
      } catch (error) {
        console.error("Error fetching users:", error);
      }
    },
    async fetchRoles() {
      try {
        const response = await axios.get(`${API_BASE_URL}roles`);
        this.roles = response.data;
      } catch (error) {
        console.error("Error fetching roles:", error);
      }
    },
    openAddModal() {
      this.showAddModal = true;
      this.newUser = { name: "", email: "", password: "", password_confirmation: "", role: "" }; // Reset form
    },
    closeAddModal() {
      this.showAddModal = false;
    },
    async addUser() {
      try {
        await axios.post(`${API_BASE_URL}users`, this.newUser);
        this.fetchUsers(); // Refresh users
        this.closeAddModal();
      } catch (error) {
        console.error("Error adding user:", error);
        alert("Failed to add user. Please try again."); // Display error message
      }
    },
    openEditModal(user) {
      this.currentUser = { ...user }; // Populate the current user data
      this.showEditModal = true;
    },
    closeEditModal() {
      this.showEditModal = false;
      this.currentUser = {}; // Reset currentUser
    },
    async updateUser() {
      try {
        await axios.put(`${API_BASE_URL}users/${this.currentUser.id}`, this.currentUser);
        this.fetchUsers(); // Refresh users
        this.closeEditModal();
      } catch (error) {
        console.error("Error updating user:", error);
        alert("Failed to update user. Please try again."); // Display error message
      }
    },
    async deleteUser(userId) {
      if (confirm("Are you sure you want to delete this user?")) {
        try {
          await axios.delete(`${API_BASE_URL}users/${userId}`);
          this.fetchUsers(); // Refresh users
        } catch (error) {
          console.error("Error deleting user:", error);
          alert("Failed to delete user. Please try again."); // Display error message
        }
      }
    },
  },
  created() {
    this.fetchUsers();
    this.fetchRoles();
  },
};
</script>

<style scoped>
/* Add your custom styles here */
</style>
