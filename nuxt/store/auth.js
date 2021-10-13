import Cookie from 'js-cookie';

export const state = () => ({
  user: null,
  loggedIn: false,
  token: '',
  refreshTask: null,
  tokenExpiredIn: 0,
});

export const actions = {
  async login({ commit, dispatch }, { credentials }) {
    try {
      const {
        user,
        access_token: accessToken,
        expires_in: expiresIn,
      } = await this.$axios.post('/api/auth/login', credentials);

      commit('SET_USER', user);
      commit('SET_TOKEN', accessToken);
      commit('SET_TOKEN_EXPIRED_IN', expiresIn);
      Cookie.set('accessToken', accessToken, {
        sameSite: 'None',
        secure: true,
        expires: (expiresIn / 3600) / 24,
      });

      const timeUntilRefresh = expiresIn * 1000 - 5 * 60 * 1000;
      const task = setInterval(() => dispatch('refresh'), timeUntilRefresh);
      commit('SET_REFRESH_TASK', task);
    } catch (e) {
      Cookie.remove('refreshToken');

      return Promise.reject(e);
    }
  },

  logout({ commit, state }) {
    commit('SET_USER', null);
    commit('SET_TOKEN', '');
    clearInterval(state.refreshTask);
    Cookie.remove('accessToken');
    Cookie.remove('refreshToken');
  },
};

export const mutations = {
  SET_TOKEN(state, token) {
    state.token = token;
  },

  SET_TOKEN_EXPIRED_IN(state, tokenExpiredIn) {
    state.tokenExpiredIn = tokenExpiredIn;
  },

  SET_USER(state, user) {
    state.user = user;
  },

  SET_REFRESH_TASK(state, task) {
    state.refreshTask = task;
  },

  SET_TIME_UNTIL_REFRESH(state, timeUntilRefresh) {
    state.timeUntilRefresh = timeUntilRefresh;
  }
};
