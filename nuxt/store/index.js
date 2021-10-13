const Cookies = require('cookies');

export const actions = {
  async nuxtServerInit({ commit, dispatch }, { req, res }) {
    const cookies = new Cookies(req, res);
    const refreshToken = cookies.get('refreshToken');
    const accessToken = cookies.get('accessToken');
    if (refreshToken) {
      await dispatch('auth/loginWithRefreshToken', refreshToken);
    } else if (accessToken) {
      commit('auth/SET_TOKEN', accessToken);
      await dispatch('auth/refresh');
    }
  },
};
