export const state = () => ({
  request: {
    selectedDocuments: [],
    form: {
      validIDName: "",
    },
    pickUpDate: "",
  },
});

export const mutations = {
  updateSelectedDocuments(state, payload) {
    state.request.selectedDocuments = payload.selectedDocuments;
  },
  updateRequestForm(state, payload) {
    state.request.form = payload.requestForm;
  },
  updatePickUpDate(state, payload) {
    state.request.pickUpDate = payload.pickUpDate;
  },
  updatePurposeOfRequest(state, payload) {
    state.request.form.purpose = payload.purpose;
  },
  updateValidID(state, payload) {
    state.request.form.validID = payload.validID;
    state.request.form.validIDName = payload.validIDName;
  },
  updateSupportingDocuments(state, payload) {
    state.request.form.supportingDocuments = payload.supportingDocuments;
    state.request.form.supportingDocumentsName =
      payload.supportingDocumentsName;
  },
};
