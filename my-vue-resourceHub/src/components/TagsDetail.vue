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
      <div v-for="post in filteredPosts" :key="post.id" class="w-[85%] ml-20 bg-white p-6 rounded-lg shadow-md relative mb-3">
        <div class="flex items-center mb-4 justify-start">
          <img :src="post.userProfileImage || 'default-image-url.jpg'" alt="Profile Picture" class="w-10 h-10 rounded-full mr-4">
          <div>
            <router-link :to="`/u/${post.user_id}`">
              <p class="font-semibold text-gray-800 hover:text-blue-500">{{ post.user.name }}</p>
            </router-link>
            <p class="text-sm text-gray-500">{{ new Date(post.created_at).toLocaleString() }}</p>
          </div>
        </div>

        <router-link :to="`/Pd/${post.id}`">
          <h2 class="post-title text-xl font-bold text-gray-900 mb-4 hover:text-blue-500">{{ post.title }}</h2>
        </router-link>
        <div class="post-content text-gray-700 mb-6">
          <p class="mb-6">{{ post.body }}</p>
          <div class="hashtags mb-4">
            <span v-for="(tag, index) in post.tags" :key="index">
              <router-link :to="`/t/${tag}`" class="text-blue-500 hover:underline mr-2">#{{ tag }}</router-link>
            </span>
          </div>
        </div>
      </div>
    </div>

    <div v-if="errorMessage" class="text-red-600 text-center my-4">{{ errorMessage }}</div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { API_BASE_URL } from '@/config';

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
    posts.value = response.data;
  } catch (error) {
    errorMessage.value = 'Error fetching posts. Please try again later.';
    console.error('Error fetching posts:', error.response ? error.response.data : error);
  } finally {
    loading.value = false;
  }
};

const checkFollowingStatus = async () => {
  const token = localStorage.getItem('user-token');
  const tagId = await getTagIdByName(tagName.value);

  try {
    const response = await axios.get(`${API_BASE_URL}tags/${tagId}/is-following`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    });
    console.log(response.data.isFollowing);
    isFollowing.value = response.data.isFollowing;
  } catch (error) {
    console.error('Error checking following status:', error);
  }
};

const followTag = async () => {
  const token = localStorage.getItem('user-token');
  try {
    const tagId = await getTagIdByName(tagName.value);
    await axios.post(`${API_BASE_URL}tags/${tagId}/follow`, {}, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    });
    isFollowing.value = true;
  } catch (error) {
    errorMessage.value = 'Error following the tag. Please try again.';
    console.error('Error following tag:', error.response ? error.response.data : error);
  }
};

const unfollowTag = async () => {
  const token = localStorage.getItem('user-token');
  try {
    const tagId = await getTagIdByName(tagName.value);
    await axios.delete(`${API_BASE_URL}tags/${tagId}/unfollow`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    });
    isFollowing.value = false;
  } catch (error) {
    errorMessage.value = 'Error unfollowing the tag. Please try again.';
    console.error('Error unfollowing tag:', error.response ? error.response.data : error);
  }
};

const getTagIdByName = async (tagName) => {
  const token = localStorage.getItem('user-token');
  try {
    const response = await axios.get(`${API_BASE_URL}tags/by-name/${tagName}`, {
      headers: {
        Authorization: `Bearer ${token}`,
        Accept: 'application/json',
      },
    });
    console.log(response.data);
    
    return response.data.id;
  } catch (error) {
    console.error('Error fetching tag ID:', error.response ? error.response.data : error);
    throw error; // Rethrow the error to handle it in followTag
  }
};


const filteredPosts = computed(() => posts.value);

onMounted(() => {
  fetchPostsByTag();
  checkFollowingStatus();
  getTagIdByName();

});

watch(() => route.params.tag, (newTag) => {
  tagName.value = newTag;
  fetchPostsByTag();
  checkFollowingStatus();
  getTagIdByName();
});
</script>

<style scoped>
.tags-component {
  transition: all 0.3s ease;
}

.post-title {
  transition: color 0.3s ease;
}
</style>
