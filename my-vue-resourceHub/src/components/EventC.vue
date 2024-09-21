<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '../config';

// Events data
const events = ref([]);
const selectedLocation = ref('All');
const searchQuery = ref('');
const isModalOpen = ref(false);
const modalMessage = ref('');

const fetchEvents = async () => {
  try {
    const token = localStorage.getItem('user-token');
    const response = await axios.get(`${API_BASE_URL}events`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    events.value = response.data; 
  } catch (error) {
    console.error('Error fetching events:', error);
  }
};

const filteredEvents = computed(() => {
  return events.value.filter(event => {
    const matchesQuery = event.title.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesLocation = selectedLocation.value === 'All' || event.city === selectedLocation.value;
    return matchesQuery && matchesLocation;
  });
});

const registerForEvent = async (eventId) => {
  const eventToRegister = events.value.find(event => event.id === eventId);
  if (eventToRegister.is_registered) {
    modalMessage.value = 'You are already registered for this event check you mail.';
    isModalOpen.value = true;
  } else {
    try {
      const token = localStorage.getItem('user-token');
      await axios.post(`${API_BASE_URL}events/${eventId}/register`, {}, {
        headers: {
          Authorization: `Bearer ${token}`
        }
      });
      eventToRegister.is_registered = true;
      modalMessage.value = 'You have successfully registered! Please check your email for confirmation.';
      isModalOpen.value = true;
    } catch (error) {
      console.error('Error registering for event:', error);
    }
  }
};

onMounted(fetchEvents);
</script>

<template>
  <section id="events">
    <div class="filter-container">
      <input type="text" v-model="searchQuery" placeholder="Search events..." class="input-field outline-none w-[45%]" />
      <select v-model="selectedLocation" class="input-field">
        <option value="All">All</option>
        <option value="Casablanca">Casablanca</option>
        <option value="Agadir">Agadir</option>
        <option value="Tangier">Tangier</option>
        <option value="Rabat">Rabat</option>
        <option value="Marrakech">Marrakech</option>
        <option value="Fes">Fes</option>
        <option value="Essaouira">Essaouira</option>
        <option value="Oujda">Oujda</option>
        <option value="Meknes">Meknes</option>
        <option value="Tétouan">Tétouan</option>
    </select>
    </div>

    <div class="events-box-container">
      <div v-if="filteredEvents.length === 0" class="no-events">
                <img src="../../public/img/readingListIcon1.png" alt="Empty List" class="w-1/4 mx-auto mt-10">
                <p class="text-2xl text-gray-600 font-bold text-center mt-10">
                    Now, no events in your city.
                </p>
      </div>
      <div class="events-box flex items-center justify-center text-center" v-for="event in filteredEvents" :key="event.id">
        <div class="events-box-inner">
          <div class="events-box-front">
            <div class="events-text ">
              <h1 class="text-green-500 font-bold text-xl">
                {{ event.title }}
              </h1>
              <br>
              <br>
              <span class="flex items-center justify-center">
                <span class="material-symbols-outlined">
                    location_on
                </span>
                <span class="location ml-1">in {{ event.location }}</span>  
              </span>
              <p class="font-semibold mt-16">{{ event.formatted_date }}</p>
            </div>
          </div>

          <div class="events-box-back">
            <div class="back-content ">
              <strong class="event-title text-xl">{{ event.title }}</strong>
              <!-- <p class="my-5 "><strong>{{ event.formatted_date }}</strong></p> -->
              <p class="mt-10">{{ event.description }}</p>
              <span class="flex items-center justify-around ">
                <p class="status my-6 text-xl text-green-500">{{ event.status }}</p>              
                <button @click="registerForEvent(event.id)" class="register-button bg-green-500 hover:bg-green-600
                text-white">
                {{ event.is_registered ? 'Already Registered' : 'Register' }}
              </button>
              </span>
              
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="isModalOpen" class="modal">
      <div class="modal-content w-1/3 flex flex-col items-center justify-center">
        <h3 class="text-green-600 text-2xl font-bold">Registration Status</h3>
        <img class="w-72" src="../../public/img/iconmail.png" alt="icon mail">
        <p class="my-10 font-semibold text-xl text-center">{{ modalMessage }}</p>
        <button @click="isModalOpen = false" class="close-button bg-green-400 rounded-full
        px-8 py-2 hover:bg-transparent hover:shadow-2xl">Close</button>
      </div>
    </div>

  </section>
</template>

<style scoped>
#events {
  max-width: 1200px;
  margin: 80px auto;
}

.filter-container {
  display: flex;
  justify-content: space-around;
  margin-bottom: 20px;
}

.input-field {
  padding: 10px;
  font-size: 1rem;
  border-radius: 8px;
  border: 1px solid #ccc;
  transition: border 0.3s;
}

.input-field:hover {
  border: 1px solid #007bff;
}

.events-box-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.no-events {
  width: 100%;
  text-align: center;
  margin-top: 20px;
}

.events-box {
  max-width: 275px;
  width: 100%;
  margin: 10px;
  perspective: 1000px;
}

.events-box-inner {
  position: relative;
  width: 100%;
  height: 350px;
  transition: transform 0.6s;
  transform-style: preserve-3d;
}

.events-box:hover .events-box-inner {
  transform: rotateY(180deg);
}

.events-box-front, .events-box-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.events-box-front {
  background-color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
}

.events-text {
  padding: 10px;
}

.events-text strong {
  color: #027179;
  font-size: 1.3rem;
}

.events-box-back {
  color: black;
  transform: rotateY(180deg);
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #f0f0f0;
}

.back-content {
  padding: 20px;
  text-align: center;
}

.event-title {
  font-weight: bold;
}

.status {
  padding: 10px 20px;
  border-radius: 100px;


}

.register-button {
  padding: 10px 20px;
  border: none;
  border-radius: 25px;
  cursor: pointer;
  transition: background-color 0.3s;
  color:white;
}

.modal {
  position: fixed;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, 0.5);
  z-index: 50;
}

.modal-content {
  background: white;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
}
.modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
  display: flex;
  align-items: center; /* Center vertically */
  justify-content: center; /* Center horizontally */
}


</style>
