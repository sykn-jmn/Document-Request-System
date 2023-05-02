export const state = () => ({
  formData: "",
  validIDName: "",
  supportingDocumentsName: [],
  form: "",
  selectedDocuments: [],
  selectedDate: "",
  meridem: "",
  purpose: "",
  // formData: {
  //   selectedDocuments: [],
  //   fee: 0,
  //   form: {
  //     validIDName: "",
  //   },
  //   pickUpDate: "",
  // },
});

export const mutations = {
  updateFormData(state, payload) {
    state.formData = payload.formData;
  },
  updateForm(state, payload) {
    state.form = payload.form;
  },
  updateSelectedDocuments(state, payload) {
    state.formData.append("selected_documents", payload.selectedDocuments);
    state.selectedDocuments = payload.selectedDocuments;
  },
  updatePickUpDate(state, payload) {
    state.formData.append("pickup_date", payload.pickUpDate.selectedDate);
    state.formData.append("meridiem", payload.pickUpDate.meridiem);
    state.selectedDate = payload.pickUpDate.selectedDate;
    state.meridiem = payload.pickUpDate.meridiem;
  },
  updatePurposeOfRequest(state, payload) {
    state.formData.append("purpose", payload.purpose);
    state.purpose = payload.purpose;
  },
  updateValidID(state, payload) {
    state.formData.append("valid_id", payload.validID);
    state.validIDName = payload.validIDName;
  },
  updateSupportingDocuments(state, payload) {
    state.formData.append("supporting_documents", payload.supportingDocuments);
    state.formData.append(
      "supporting_documents_length",
      payload.numberOfSupportingDocuments
    );
    state.supportingDocumentsName = payload.supportingDocumentsName;
  },
  updateFee(state, payload) {
    state.formData.append("fee", payload.fee);
  },
};
