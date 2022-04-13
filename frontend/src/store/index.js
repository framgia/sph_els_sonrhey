import { createStore } from 'vuex'

export default createStore({
  state: {
    category : [],
    question : []
  },
  getters: {
  },
  mutations: {
    setCategory(state, value) {
      state.category = value
    },
    setQuestion(state, value) {
      state.question = value
    }
  },
  actions: {
  },
  modules: {
  }
})
