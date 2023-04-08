export const state = () => ({
  user: "",
});

export const mutations = {
  changeUser(state, payload) {
    state.user = payload.user;
  },
};
