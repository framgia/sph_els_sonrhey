import axios from 'axios'
import { ref, computed } from 'vue'
import commonService from './commonService'
import config from './config'

const getAnswer = () => {
  const { getUserAndToken } = commonService()
  const { link } = config()
  const userAnswer = ref([])
  const results = ref([])

  const answer = (question) => {
    if (question.length == undefined) {
      const selAnswer = question.choices.map(q => {
        return q.choice_id ==  question.answer.choice_id ? {...q, selected: true} : q 
      })
      return selAnswer
    }
  }

  const getUserAnswer = async (userId) => {
    try {
      const answer = await axios.get(`${link}/api/get-user-answer/${userId}`, {
        headers: {
          Authorization: `Bearer ${getUserAndToken('token')}`
        }
      })
      const response = answer.data.data
      userAnswer.value = response
    } catch (e) {
      console.error(e)
    }
  }

  const viewResult = async (request) => {
    try {
      const result = await axios.post(`${link}/api/get-result`, request, {
        headers: {
            Authorization: `Bearer ${getUserAndToken('token')}`
        }
      })
      const response = result.data.data
      results.value = response
    } catch (e) {
      console.error(e)
    }
  }

  return { answer, getUserAnswer, userAnswer, viewResult, results }
}

export default getAnswer