<template>
  <div>
    <div class="flex justify-between items-center mx-20 mt-20 bg-gray-50 rounded-full px-10 shadow-md py-3">
      <h1 class="font-bold text-2xl">Manage Roles</h1>
      <button @click="openAddRoleModal" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-transparent hover:text-black">Add Role</button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-20 mt-5">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Role Name</th>
            <th scope="col" class="px-6 py-3">Assigned Permissions</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="role in roles" :key="role.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">{{ role.name }}</td>
            <td class="px-6 py-4">
              <button v-if="!role.showPermissions" @click="seePer(role)" class="bg-orange-500 text-white px-3 py-1 rounded-lg">See Permissions</button>
              <button v-else @click="seePer(role)" class="bg-orange-500 text-white px-3 py-1 rounded-lg">Close Permissions</button>
              <div v-if="role.showPermissions" class="overflow-y-auto h-32 border border-gray-300 rounded-md">
                <label v-for="permission in role.permissions" :key="permission.id" class="flex items-center p-2">
                  <input type="radio" :value="permission.name" v-model="role.permissions" class="mr-2" :disabled="!currentRole.permissions.includes(permission.name)" />
                  {{ permission.name }}
                </label>
              </div>
            </td>
            <td class="px-6 py-4">
              <button @click="openEditRoleModal(role)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
              <button @click="deleteRole(role.id)" class="font-medium mr-3 text-black hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Add Role Modal -->
     <!-- Add Role Modal -->
<div v-if="showAddRoleModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
  <div class="bg-white p-6 rounded-lg shadow-lg w-96">
    <h3 class="text-xl font-semibold mb-4">Add Role</h3>
    <form @submit.prevent="addRole">
      <div class="mb-4">
        <label for="new-role-name" class="block text-gray-700">Role Name</label>
        <input v-model="newRole.name" id="new-role-name" type="text" class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
        <p v-if="roleNameError" class="text-red-500 text-xs mt-1">{{ roleNameError }}</p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700">Assign Permissions</label>
        <div class="overflow-y-auto h-40 border border-gray-300 rounded-md">
          <label v-for="permission in permissions" :key="permission.id" class="flex items-center p-2">
            <input type="checkbox" :value="permission.name" v-model="newRole.permissions" class="mr-2" />
            {{ permission.name }}
          </label>
        </div>
        <p v-if="newRole.permissions.length === 0" class="text-red-500 text-xs mt-1">Please select at least one permission.</p>
      </div>
      <div class="flex justify-end">
        <button type="button" @click="closeAddRoleModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
        <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
      </div>
    </form>
  </div>
</div>

    <!-- Same as before -->

    <!-- Edit Role Modal -->
    <div v-if="showEditRoleModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Edit Role</h3>
        <form @submit.prevent="updateRole">
          <div class="mb-4">
            <label for="edit-role-name" class="block text-gray-700">Role Name</label>
            <input v-model="currentRole.name" id="edit-role-name" type="text" class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            <p v-if="roleNameError" class="text-red-500 text-xs mt-1">{{ roleNameError }}</p>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Assign Permissions</label>
            <div class="overflow-y-auto h-40 border border-gray-300 rounded-md">
              <label v-for="permission in permissions" :key="permission.id" class="flex items-center p-2">
                <input type="checkbox" :value="permission.name" v-model="currentRole.permissions" class="mr-2" />
                {{ permission.name }}
              </label>
            </div>
            <p v-if="currentRole.permissions.length === 0" class="text-red-500 text-xs mt-1">Please select at least one permission.</p>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="closeEditRoleModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
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

const setAuthorizationToken = () => {
  const token = localStorage.getItem("user-token");
  if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
  }
};

export default {
  data() {
    return {
      roles: [],
      permissions: [],
      showAddRoleModal: false,
      showEditRoleModal: false,
      newRole: {
        name: '',
        permissions: [],
      },
      currentRole: {
        id: null,
        name: '',
        permissions: [],
      },
      roleNameError: '',
      loading: false,
    };
  },
  created() {
    setAuthorizationToken();
    this.fetchRoles();
    this.fetchPermissions();
  },
  methods: {
    async fetchRoles() {
      this.loading = true;
      try {
        const response = await axios.get(`${API_BASE_URL}roles`);
        this.roles = response.data.map(role => ({ ...role, showPermissions: false }));
      } catch (error) {
        console.error('Error fetching roles:', error);
      } finally {
        this.loading = false;
      }
    },
    async fetchPermissions() {
      this.loading = true;
      try {
        const response = await axios.get(`${API_BASE_URL}permissions`);
        this.permissions = response.data;
      } catch (error) {
        console.error('Error fetching permissions:', error);
      } finally {
        this.loading = false;
      }
    },
    openAddRoleModal() {
      this.showAddRoleModal = true;
      this.newRole.name = '';
      this.newRole.permissions = [];
      this.roleNameError = '';
    },
    closeAddRoleModal() {
      this.showAddRoleModal = false;
    },
    async addRole() {
      try {
        await axios.post(`${API_BASE_URL}roles`, this.newRole);
        this.fetchRoles();
        this.closeAddRoleModal();
      } catch (error) {
        console.error('Error adding role:', error);
        this.roleNameError = 'Failed to add role. Please try again.';
      }
    },
    openEditRoleModal(role) {
      this.showEditRoleModal = true;
      this.currentRole.id = role.id;
      this.currentRole.name = role.name;
      this.currentRole.permissions = [...role.permissions]; // Clone the permissions array
    },
    closeEditRoleModal() {
      this.showEditRoleModal = false;
    },
    async updateRole() {
      // Reset error message
      this.roleNameError = '';

      // Validate role name
      if (!this.currentRole.name) {
          this.roleNameError = 'Role name is required.';
          return;
      }

      // Ensure permissions are strings
      const stringPermissions = this.currentRole.permissions.map(permission => {
          return typeof permission === 'object' ? permission.name : permission;
      });

      // Check if permissions are valid
      if (!Array.isArray(stringPermissions) || stringPermissions.length === 0) {
          this.roleNameError = 'Please select at least one permission.';
          return;
      }

      try {
          await axios.put(`${API_BASE_URL}roles/${this.currentRole.id}`, {
              name: this.currentRole.name,
              permissions: stringPermissions
          });
          this.fetchRoles();
          this.closeEditRoleModal();
      } catch (error) {
          console.error('Error updating role:', error);
          this.roleNameError = 'Failed to update role. Please try again.';
      }
    },
    async deleteRole(id) {

        try {
          await axios.delete(`${API_BASE_URL}roles/${id}`);
          this.fetchRoles();
        } catch (error) {
          console.error('Error deleting role:', error);
        }
    },
    seePer(role) {
      role.showPermissions = !role.showPermissions;
    },
  },
};
</script>
