<template>
    <div class="flex justify-between items-center mx-20 mt-20 bg-gray-50 rounded-full px-10 shadow-md">
      <h1 class="font-bold text-2xl">Manage Roles</h1>
      <div class="mb-4">
        <button @click="openAddRoleModal" class="bg-blue-500 text-white px-4 py-2 rounded-full mt-3 hover:bg-blue-600">Add Role</button>
      </div>
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
              <ul>
                <li v-for="permission in role.permissions" :key="permission.id">{{ permission.name }}</li>
              </ul>
            </td>
            <td class="px-6 py-4">
              <button @click="openEditRoleModal(role)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
              <button @click="deleteRole(role)" class="font-medium mr-3 text-black hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  
    <!-- Add Role Modal -->
    <div v-if="showAddRoleModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Add Role</h3>
        <form @submit.prevent="addRole">
          <div class="mb-4">
            <label for="role-name" class="block text-gray-700">Role Name</label>
            <input v-model="newRole.name" id="role-name" type="text" class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Assign Permissions</label>
            <div v-for="permission in permissions" :key="permission.id" class="flex items-center">
              <input type="checkbox" :value="permission.id" v-model="newRole.permissions" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
              <label :for="permission.name" class="ml-2">{{ permission.name }}</label>
            </div>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="closeAddRoleModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Add</button>
          </div>
        </form>
      </div>
    </div>
  
    <!-- Edit Role Modal -->
    <div v-if="showEditRoleModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h3 class="text-xl font-semibold mb-4">Edit Role</h3>
        <form @submit.prevent="updateRole">
          <div class="mb-4">
            <label for="edit-role-name" class="block text-gray-700">Role Name</label>
            <input v-model="currentRole.name" id="edit-role-name" type="text" class="mt-1 block w-full h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700">Assign Permissions</label>
            <div v-for="permission in permissions" :key="permission.id" class="flex items-center">
              <input type="checkbox" :value="permission.id" v-model="currentRole.permissions" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
              <label :for="permission.name" class="ml-2">{{ permission.name }}</label>
            </div>
          </div>
          <div class="flex justify-end">
            <button type="button" @click="closeEditRoleModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
            <button type="submit" class="ml-3 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        roles: [
          {
            id: 1,
            name: 'Admin',
            permissions: [{ id: 1, name: 'Create' }, { id: 2, name: 'Edit' }]
          },
          {
            id: 2,
            name: 'User',
            permissions: [{ id: 3, name: 'View' }]
          }
        ],
        permissions: [
          { id: 1, name: 'Create' },
          { id: 2, name: 'Edit' },
          { id: 3, name: 'View' },
          { id: 4, name: 'Delete' }
        ],
        showAddRoleModal: false,
        showEditRoleModal: false,
        newRole: {
          name: '',
          permissions: []
        },
        currentRole: {}
      };
    },
    methods: {
      openAddRoleModal() {
        this.showAddRoleModal = true;
      },
      closeAddRoleModal() {
        this.showAddRoleModal = false;
        this.resetNewRole();
      },
      openEditRoleModal(role) {
        this.currentRole = { ...role, permissions: role.permissions.map(p => p.id) }; // Convert permissions to IDs
        this.showEditRoleModal = true;
      },
      closeEditRoleModal() {
        this.showEditRoleModal = false;
        this.resetCurrentRole();
      },
      addRole() {
        if (this.newRole.name && this.newRole.permissions.length > 0) {
          const newRole = {
            ...this.newRole,
            id: this.roles.length + 1,
            permissions: this.permissions.filter(permission => this.newRole.permissions.includes(permission.id))
          };
          this.roles.push(newRole);
          this.closeAddRoleModal();
        }
      },
      updateRole() {
        const index = this.roles.findIndex(role => role.id === this.currentRole.id);
        if (index !== -1) {
          const updatedRole = {
            ...this.currentRole,
            permissions: this.permissions.filter(permission => this.currentRole.permissions.includes(permission.id))
          };
          this.roles.splice(index, 1, updatedRole);
          this.closeEditRoleModal();
        }
      },
      deleteRole(role) {
        this.roles = this.roles.filter(r => r.id !== role.id);
      },
      resetNewRole() {
        this.newRole = {
          name: '',
          permissions: []
        };
      },
      resetCurrentRole() {
        this.currentRole = {};
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add additional styling here if necessary */
  </style>
  