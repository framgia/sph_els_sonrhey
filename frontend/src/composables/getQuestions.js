import axios from 'axios'
import { ref } from 'vue'
import commonService from './commonService'

const getQuestions = () => {
  const csvc = commonService()
  const questionList = ref()

  const fetchQuestions = async () => {
    const questions = await axios.get('http://localhost/api/get-questions', {
      headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })  
  
    const response = await questions.data.data
    questionList.value = response
  }

  return { fetchQuestions, questionList }
}

export default getQuestions