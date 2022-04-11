import { createStore } from 'vuex'

export default createStore({
  state: {
    category : []
  },
  getters: {
  },
  mutations: {
    set_category(state, value) {
      state.category = value
    }
  },
  actions: {
  },
  modules: {
  }
})
