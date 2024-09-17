import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000/api';
axios.defaults.withCredentials = true; // Ensure cookies are sent with every request
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default axios;
