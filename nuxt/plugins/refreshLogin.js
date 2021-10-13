import Cookie from "js-cookie";

export default ({ store: { state, dispatch, commit } }) => {
  if (state.auth.token) {
    const task = setInterval(() => dispatch('auth/refresh'), state.auth.timeUntilRefresh);
    commit('auth/SET_REFRESH_TASK', task);
    Cookie.set('accessToken', state.auth.token, {
      sameSite: 'None',
      secure: true,
      expires: (state.auth.tokenExpiredIn / 3600) / 24,
    });
  }
}
