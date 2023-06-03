export const state = () => ({
  refreshRequestTable: 0,
});

export const mutations = {
  updateRefreshRequestTable(state, count) {
    state.refreshRequestTable = count;
  },
};
