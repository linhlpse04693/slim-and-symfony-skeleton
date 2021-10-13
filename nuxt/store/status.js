export const state = () => ({
  statuses: [],
});

export const actions = {
  async fetchStatuses({ commit }) {
    const {
      data: statuses
    } = await this.$axios.get('/api/v1/statuses');

    commit('SET_STATUSES', statuses);
  }
}

export const mutations = {
  SET_STATUSES(state, statuses) {
    state.statuses = statuses;
  }
}
