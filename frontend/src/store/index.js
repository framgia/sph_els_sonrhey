import { createStore } from 'vuex'

export default createStore({
  state: {
    category : [],
    question : [],
    results : []
  },
  getters: {
  },
  mutations: {
    setCategory(state, value) {
      state.category = value
    },
    setQuestion(state, value) {
      state.question = value
    },
    setResults(state, value) {
      state.results = value
    }
  },
  actions: {
  },
  modules: {
  }
})
