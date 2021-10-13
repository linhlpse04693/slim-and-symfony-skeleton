export const state = () => ({
  roles: [],
});

export const actions = {
  async fetchRoles({ commit }) {
    const {
      data: roles
    } = await this.$axios.get('/api/v1/roles');

    commit('SET_ROLES', roles);
  }
}

export const mutations = {
  SET_ROLES(state, roles) {
    state.roles = roles;
  }
}
