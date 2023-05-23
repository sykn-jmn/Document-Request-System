export const state = () => ({
  selectedDate: "",
  meridem: "",
});

export const mutations = {
  updatePickUpDate(state, payload) {
    state.selectedDate = payload.pickUpDate.selectedDate;
    state.meridiem = payload.pickUpDate.meridiem;
  },
};
