<template>
    <div class="flex justify-between items-center mx-20 mt-20 bg-gray-50 rounded-full px-10 shadow-md">
        <h1 class="font-bold text-2xl">Manage Users</h1>
        <div class="mb-4">
          <button @click="openAddModal" class="bg-blue-500 text-white px-4 py-2 rounded-full mt-3 hover:bg-blue-600">Add User</button>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-20 mt-5">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Name</th>
            <th scope="col" class="px-6 py-3">Position</th>
            <th scope="col" class="px-6 py-3">Status</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
              <img :src="user.profile_picture || '/docs/images/people/profile-picture-placeholder.jpg'" alt="Profile image" class="w-10 h-10 rounded-full">
              <div class="ps-3">
                <div class="text-base font-semibold">{{ user.name }}</div>
                <div class="font-normal text-gray-500">{{ user.email }}</div>
              </div>
            </th>
            <td class="px-6 py-4">{{ user.position || 'N/A' }}</td>
            <td class="px-6 py-4">
              <div class="flex items-center">
                <div :class="{'h-2.5 w-2.5 rounded-full': true, 'bg-green-500': user.status === 'Online', 'bg-red-500': user.status !== 'Online'}" class="me-2"></div> {{ user.status || 'Offline' }}
              </div>
            </td>
            <td class="px-6 py-4">
              <button @click="openEditModal(user)" class="font-medium mr-3 text-blue-600 dark:text-blue-500 hover:underline">Edit</button>
              <button @click="Delete(user)" class="font-medium mr-3 text-black  hover:underline">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
  
      <!-- Add User Modal -->
      <div v-if="showAddModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-xl font-semibold mb-4">Add User</h3>
          <form @submit.prevent="addUser">
            <div class="mb-4">
              <label for="add-name" class="block text-gray-700">Name</label>
              <input v-model="newUser.name" id="add-name" type="text" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="add-email" class="block text-gray-700">Email</label>
              <input v-model="newUser.email" id="add-email" type="email" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="add-position" class="block text-gray-700">Position</label>
              <input v-model="newUser.position" id="add-position" type="text" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
              <label for="add-status" class="block text-gray-700">Status</label>
              <select v-model="newUser.status" id="add-status" class="mt-1 block w-full outline-none h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option>Online</option>
                <option>Offline</option>
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
      <div v-if="showEditModal" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
          <h3 class="text-xl font-semibold mb-4">Edit User</h3>
          <form @submit.prevent="updateUser">
            <div class="mb-4">
              <label for="edit-name" class="block text-gray-700">Name</label>
              <input v-model="currentUser.name" id="edit-name" type="text" class="mt-1 block w-full outline-none h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="edit-email" class="block text-gray-700">Email</label>
              <input v-model="currentUser.email" id="edit-email" type="email" class="mt-1 block w-full outline-none h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
              <label for="edit-position" class="block text-gray-700">Position</label>
              <input v-model="currentUser.position" id="edit-position" type="text" class="mt-1 outline-none h-10 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div class="mb-4">
              <label for="edit-status" class="block text-gray-700">Status</label>
              <select v-model="currentUser.status" id="edit-status" class="mt-1 block w-full outline-none h-10 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                <option>Online</option>
                <option>Offline</option>
              </select>
            </div>
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
  export default {
    data() {
      return {
        users: [
          {
            id: 1,
            name: 'Neil Sims',
            email: 'neil.sims@flowbite.com',
            profile_picture: '/docs/images/people/profile-picture-1.jpg',
            position: 'React Developer',
            status: 'Online'
          },
          {
            id: 2,
            name: 'Bonnie Green',
            email: 'bonnie@flowbite.com',
            profile_picture: '/docs/images/people/profile-picture-3.jpg',
            position: 'Designer',
            status: 'Online'
          },
          {
            id: 3,
            name: 'Jese Leos',
            email: 'jese@flowbite.com',
            profile_picture: '/docs/images/people/profile-picture-2.jpg',
            position: 'Vue JS Developer',
            status: 'Online'
          },
          {
            id: 4,
            name: 'Thomas Lean',
            email: 'thomes@flowbite.com',
            profile_picture: '/docs/images/people/profile-picture-5.jpg',
            position: 'UI/UX Engineer',
            status: 'Online'
          },
          {
            id: 5,
            name: 'Leslie Livingston',
            email: 'leslie@flowbite.com',
            profile_picture: '/docs/images/people/profile-picture-4.jpg',
            position: 'SEO Specialist',
            status: 'Offline'
          }
        ],
        showAddModal: false,
        showEditModal: false,
        newUser: {
          name: '',
          email: '',
          position: '',
          status: 'Online'
        },
        currentUser: {}
      };
    },
    methods: {
      openAddModal() {
        this.showAddModal = true;
      },
      closeAddModal() {
        this.showAddModal = false;
        this.resetNewUser();
      },
      openEditModal(user) {
        this.currentUser = { ...user };
        this.showEditModal = true;
      },
      closeEditModal() {
        this.showEditModal = false;
        this.resetCurrentUser();
      },
      addUser() {
        if (this.newUser.name && this.newUser.email) {
          const newUser = { ...this.newUser, id: this.users.length + 1 }; // Simulate ID assignment
          this.users.push(newUser);
          this.closeAddModal();
        }
      },
      updateUser() {
        const index = this.users.findIndex(user => user.id === this.currentUser.id);
        if (index !== -1) {
          this.users.splice(index, 1, this.currentUser);
          this.closeEditModal();
        }
      },
      resetNewUser() {
        this.newUser = {
          name: '',
          email: '',
          position: '',
          status: 'Online'
        };
      },
      resetCurrentUser() {
        this.currentUser = {};
      }
    }
  };
  </script>
  
  <style scoped>
  /* Add any additional styling if necessary */
  </style>
  