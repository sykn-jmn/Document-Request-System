export const state = () => ({
  request: {
    selectedDocuments: [],
    form: {},
    pickUpDate: {},
  },
});

export const mutations = {
  updateSelectedDocuments(state, payload) {
    state.request.selectedDocuments = payload.selectedDocuments;
  },
  updateRequestForm(state, payload) {
    state.request.form = payload.requestForm;
  },
  updatepickUpDate(state, payload) {
    state.request.pickUpDate = payload.pickUpDate;
  },
  updateValidID(state, payload) {
    state.request.form.validID = payload.validID;
  },
  updateSupportingDocuments(state, payload) {
    state.request.form.supportingDocuments = payload.supportingDocuments;
  },
};
