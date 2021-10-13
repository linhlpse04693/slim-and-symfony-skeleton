export const actions = {
  async updateUser(_, { id, payload }) {
    return await this.$axios.patch(`/api/v1/users/${ id }`, payload);
  }
}
