export const state = () => ({
  profilePicture: "",
});

export const mutations = {
  updateProfilePic(state, payload) {
    state.profilePicture = payload.path;
  },
};
