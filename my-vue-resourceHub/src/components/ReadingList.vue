<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '../config';

const readingList = ref([]);
const userName = ref('');

// Fetch token from cookies
const token = localStorage.getItem('user-token');

if (!token) {
    console.error("Token is not available!");
}

// Fetch bookmarks from the API
const fetchBookmarks = async () => {
    try {
        const response = await axios.get(`${API_BASE_URL}bookmarks`, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        readingList.value = response.data.bookmarks.map(bookmark => ({
            ...bookmark,
            read: !!bookmark.read,
            created_at: bookmark.created_at ? new Date(bookmark.created_at).toLocaleDateString() : 'Date unknown'
        }));
        userName.value = response.data.user.name;
        console.log(readingList.value);
    } catch (error) {
        console.error("Error fetching bookmarks:", error);
    }
};

onMounted(() => {
    fetchBookmarks();
});

const archiveItem = async (index, id) => {
    if (!id) {
        console.error("Invalid ID provided for archiving.");
        return;
    }

    try {
        await axios.post(`${API_BASE_URL}bookmarks/${id}/archive`, {}, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
        readingList.value[index].read = true;
        readingList.value.splice(index, 1);
    } catch (error) {
        console.error("Error archiving the item:", error);
    }
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
                    <li v-for="(item, index) in readingList" :key="item.id" class="mb-4 bg-white rounded-xl p-4 shadow md:p-6">
                        <div class="post-header flex items-center mb-4">
                            <img v-if="item.post.image" :src="`/path/to/images/${item.post.image}`" alt="Post Image" class="w-10 h-10 rounded-full mr-4">
                            <img v-else src="https://via.placeholder.com/40" alt="Placeholder Image" class="w-10 h-10 rounded-full mr-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ userName }}</p>
                                <p class="text-sm text-gray-500">{{ item.created_at }}</p>
                            </div>
                        </div>

                        <router-link to="/Pd/1" class="hover:text-blue-600">
                            <h2 class="font-bold text-lg mb-2">{{ item.post.title }}</h2>
                        </router-link>
                        <p class="text-sm">{{ item.post.body }}</p>
                        
                        <button 
                            @click="archiveItem(index, item.id)" 
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
    background-color: #F5F5F5;
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
