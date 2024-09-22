<template>
  <div>
    <div class="tags-component mb-6 flex flex-wrap items-center justify-between mt-20 bg-gray-100 rounded-lg mx-20 px-10 py-8 shadow-md">
      <h1 class="text-4xl font-bold mb-4">{{ tagName }}</h1>
      <div>
        <button
          v-if="isFollowing"
          @click="unfollowTag"
          class="bg-red-600 text-white py-2 px-8 rounded-full hover:bg-red-700"
          aria-label="Unfollow tag"
        >
          Unfollow
        </button>
        <button
          v-else
          @click="followTag"
          class="bg-blue-600 text-white py-2 px-8 rounded-full hover:bg-blue-700"
          aria-label="Follow tag"
        >
          Follow
        </button>
      </div>
    </div>

    <div v-if="loading" class="text-center my-4">Loading posts...</div>
    <div v-else-if="filteredPosts.length === 0" class="text-center my-4">No posts found for this tag.</div>
    <div v-else class="posts-list">
      <Post v-for="post in filteredPosts" :key="post.id" :post="post" class="w-[85%] ml-20" />
    </div>

    <div v-if="errorMessage" class="text-red-600 text-center my-4">{{ errorMessage }}</div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import Post from '../components/Post.vue';
import { API_BASE_URL } from '@/config';
import Header from '../components/Header.vue'; // Adjust the path as necessary


const route = useRoute();
const tagName = ref(route.params.tag || 'VueJS');
const isFollowing = ref(false);
const posts = ref([]);
const loading = ref(true);
const errorMessage = ref(null);

const fetchPostsByTag = async () => {
    loading.value = true;
    errorMessage.value = null;
    const token = localStorage.getItem('user-token');
    try {
        const response = await axios.post(`${API_BASE_URL}posts/by-tag`, { tag: tagName.value }, {
            headers: {
                Authorization: `Bearer ${token}`,
                Accept: 'application/json',
            },
        });
        posts.value = response.data; // Should only contain posts with the specified tag
    } catch (error) {
        errorMessage.value = 'Error fetching posts. Please try again later.';
        console.error('Error fetching posts:', error);
    } finally {
        loading.value = false;
    }
};

const followTag = () => {
    isFollowing.value = true;
};

const unfollowTag = () => {
    isFollowing.value = false;
};

const filteredPosts = computed(() => {
    return posts.value.filter(post => 
        post.tags.some(tag => tag.name === tagName.value) // Assuming tag is an object with a name property
    );
});

onMounted(() => {
    fetchPostsByTag();
});

watch(() => route.params.tag, (newTag) => {
    tagName.value = newTag;
    fetchPostsByTag();
});
</script>
