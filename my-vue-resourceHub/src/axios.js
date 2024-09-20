// src/axiosConfig.js
import axios from 'axios';
import Cookies from 'js-cookie';

axios.defaults.baseURL = 'http://localhost:8000/api/';
axios.defaults.withCredentials = true; 
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Fetch CSRF token from cookies (Laravel sets the token in cookies)
const csrfToken = Cookies.get('XSRF-TOKEN');
if (csrfToken) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
}

export default axios; 
