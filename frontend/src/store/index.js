import { createStore } from 'vuex'

export default createStore({
  state: {
    category : [],
    question : [],
    results : [],
    following: [],
    followers: []
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
    },
    setFollowing(state, value) {
      state.following = value
    },
    setFollowers(state, value) {
      state.followers = value
    }
  },
  actions: {
  },
  modules: {
  }
})
