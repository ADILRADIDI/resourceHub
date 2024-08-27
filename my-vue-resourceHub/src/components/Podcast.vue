<script setup>
import { ref } from 'vue';
import Header from '../components/Header.vue';
import HeaderA from '../components/HeaderA.vue';

const podcasts = ref([
    {
        title: "Learning AI with Matt Eland",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with aymen"
    },
    {
        title: "Tech and Art with Chris Immel",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with Adil"
    },
    {
        title: "The Crossover of Health, Technology, and Art with Daniel Bourke",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with Daniel"
    },
    {
        title: "Facebook's New AI Tricks",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with aymen"
    },
    // Duplicates can be removed or replaced with unique entries
    {
        title: "Facebook's New AI Tricks",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with aymen"    
    },
    {
        title: "Facebook's New AI Tricks",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with aymen"    
    },
    {
        title: "Facebook's New AI Tricks",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with aymen"    
    },
    {
        title: "Facebook's New AI Tricks",
        image: "https://media.dev.to/cdn-cgi/image/width=240,height=240,fit=cover,gravity=auto,format=auto/https%3A%2F%2Fdev-to-uploads.s3.amazonaws.com%2Fuploads%2Fpodcast%2Fimage%2F2%2F2e7a90b5-76bd-4b0f-ae36-11d0f7f4b054.jpg",
        creator: "Code with aymens"    
    }
]);
</script>

<template>
    <Header />
    <div class="container mx-auto p-4 md:p-6 lg:p-8">
        <header class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-black">Podcasts</h1>
        </header>
        
        <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <article v-for="(podcast, index) in podcasts" :key="index" class="bg-white p-4 rounded-lg shadow-lg flex flex-col items-center">
                <img :src="podcast.image" alt="Podcast Image" class="w-full h-55 object-cover rounded-lg mb-4">
                <router-link to="/podcastDetail" >
                    <h2 class="text-lg font-semibold text-gray-800 mb-2 mt-5 hover:text-blue-700">{{ podcast.title }}</h2>
                </router-link>
                <p class="text-gray-600 text-sm">{{ podcast.creator }}</p>
            </article>
        </section>
    </div>
</template>

<style>
/* Add additional styling as needed */
</style>
