<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import { API_BASE_URL } from '../config';

// Events data
const events = ref([]);
const selectedLocation = ref('All');
const searchQuery = ref('');
const showModal = ref(false);
const currentEventId = ref(null);
const registrationStatus = ref({});

// Fetch events from the API with authorization
const fetchEvents = async () => {
  try {
    const token = localStorage.getItem('user-token');
    const response = await axios.get(`${API_BASE_URL}events`, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    events.value = response.data;

    // Check registration status for each event
    events.value.forEach(event => {
      registrationStatus.value[event.id] = false; // Initialize all as not registered
    });
  } catch (error) {
    console.error('Error fetching events:', error);
  }
};

// Filtered events based on search and city filter
const filteredEvents = computed(() => {
  return events.value.filter(event => {
    const matchesQuery = event.title.toLowerCase().includes(searchQuery.value.toLowerCase());
    const matchesLocation = selectedLocation.value === 'All' || event.city === selectedLocation.value;
    return matchesQuery && matchesLocation;
  });
});

// Handle registration logic
const registerForEvent = (eventId) => {
  if (registrationStatus.value[eventId]) {
    alert(`You are already registered for event ID: ${eventId}`);
  } else {
    currentEventId.value = eventId;
    showModal.value = true;
  }
};

// Confirm registration
const confirmRegistration = async () => {
  try {
    const token = localStorage.getItem('user-token');
    await axios.post(`${API_BASE_URL}events/${currentEventId.value}/register`, {}, {
      headers: {
        Authorization: `Bearer ${token}`
      }
    });
    registrationStatus.value[currentEventId.value] = true; // Mark as registered
    alert(`You have successfully registered for event ID: ${currentEventId.value}`);
  } catch (error) {
    console.error('Error registering for event:', error);
  } finally {
    showModal.value = false;
  }
};

// Fetch events on component mount
onMounted(fetchEvents);
</script>
