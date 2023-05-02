export const state = () => ({
  profilePicture: "",
});

export const mutations = {
  updateProfilePic(state, payload) {
    state.profilePicture = payload.formData;
    state.profilePicture.append("file", payload.file);
    state.profilePicture.append("hi", "hii");
  },
};
