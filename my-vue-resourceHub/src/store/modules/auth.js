const state = {
  user: null,
  token: localStorage.getItem('token') || '',
};

const getters = {
  isAuthenticated: (state) => !!state.token,
  user: (state) => state.user,
};

const actions = {
  async login({ commit }, credentials) {
    try {
      const response = await apiClient.post('/api/login', credentials);
      const { token, user } = response.data;

      localStorage.setItem('token', token);
      apiClient.defaults.headers.common['Authorization'] = `Bearer ${token}`;

      commit('setUser', user);
      commit('setToken', token);
    } catch (error) {
      console.error('Login failed:', error);
    }
  },

  // Other actions...
};

const mutations = {
  setUser(state, user) {
    state.user = user;
  },

  setToken(state, token) {
    state.token = token;
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
