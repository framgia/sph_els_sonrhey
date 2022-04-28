import axios from 'axios'
import { ref } from 'vue'
import commonService from './commonService'
import config from './config'

const getQuestions = () => {
  const csvc = commonService()
  const { link } = config()
  const questionList = ref([])
  const pages = ref([])
  const isLoaded = ref(false)
  const total = ref(0)

  const fetchQuestions = async () => {
    const questions = await axios.get(`${link}/api/get-questions`, {
      headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })  
  
    const response = await questions.data.data
    isLoaded.value = true
    total.value = response.total
    pages.value = response.links
    questionList.value = response.data.filter(q => q.category != null)
  }

  const getNextQuestion = async (url) => {
    const questions = await axios.get(`${link}/api/get-questions${url}`, {
      headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })  
  
    const response = await questions.data.data
    isLoaded.value = true
    pages.value = response.links
    questionList.value = response.data.filter(q => q.category != null)
  }

  return { fetchQuestions, questionList, pages, isLoaded, getNextQuestion, total }
}

export default getQuestions