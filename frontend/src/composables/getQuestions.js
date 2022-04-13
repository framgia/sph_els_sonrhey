import axios from 'axios'
import { ref } from 'vue'
import commonService from './commonService'
import config from './config'

const getQuestions = () => {
  const csvc = commonService()
  const { link } = config()
  const questionList = ref()

  const fetchQuestions = async () => {
    const questions = await axios.get(`${link}/api/get-questions`, {
      headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })  
  
    const response = await questions.data.data
    questionList.value = response.filter(q => q.category != null)
  }

  return { fetchQuestions, questionList }
}

export default getQuestions