<script setup>
import { ref } from 'vue';

const username = 'Adil Doe';
const timeCreated = 'August 25';
const readingList = ref([
    {
        title: "Understanding Vue 3 Composition API",
        description: "A comprehensive guide to Vue 3's Composition API, explaining its features and benefits."
    },
    {
        title: "Mastering Tailwind CSS",
        description: "Learn how to use Tailwind CSS to build responsive and visually appealing web applications."
    },
    {
        title: "Introduction to Vite",
        description: "Get started with Vite, a fast build tool for modern web development."
    },
    {
        title: "Introduction to Vite",
        description: "Get started with Vite, a fast build tool for modern web development."
    },
    {
        title: "Introduction to Vite",
        description: "Get started with Vite, a fast build tool for modern web development."
    }
]);

const archiveItem = (index) => {
    readingList.value.splice(index, 1); // Removes the item from the list
};
</script>

<template>
    <div class="container mx-auto px-4">
        <h1 class="font-bold text-3xl text-black mt-8 mb-4">
            Reading list ({{ readingList.length }})
        </h1>
        
        <div id="container3" class="bg-gray-200 rounded-xl p-4 md:p-6 lg:p-8">
            <template v-if="readingList.length === 0">
                <img src="../../public/img/readingListIcon1.png" alt="Empty List" class="w-1/5 mx-auto mt-10">
                <p class="text-xl font-bold text-center mt-10">
                    Your reading list is empty. Start adding some Posts!
                </p>
            </template>
            
            <template v-else>
                <ul>
                    <li v-for="(item, index) in readingList" :key="index" class="mb-4 bg-white rounded-xl p-4 shadow md:p-6">
                        <!-- Post Header -->
                        <div class="post-header flex items-center mb-4">
                            <img src="https://via.placeholder.com/40" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ username }}</p>
                                <p class="text-sm text-gray-500">{{ timeCreated }}</p>
                            </div>
                        </div>
                        <router-link :to="`/postDetail/${index + 1}`" class="hover:text-blue-600">
                            <h2 class="font-bold text-lg mb-2">{{ item.title }}</h2>
                        </router-link>
                        <p class="text-sm">{{ item.description }}</p>
                        
                        <!-- Archive Button -->
                        <button 
                            @click="archiveItem(index)" 
                            class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                        >
                            Archive
                        </button>
                    </li>
                </ul>
            </template>
        </div>
    </div>
</template>

<style scoped>
#container3 {
    background-color: #f9f9f9;
    padding: 1rem;
    border-radius: 10px;
}

.bg-white {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

button {
    transition: background-color 0.3s;
}
</style>
