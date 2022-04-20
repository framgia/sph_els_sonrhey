import axios from 'axios'
import { ref, computed } from 'vue'
import commonService from './commonService'
import config from './config'

const getAnswer = () => {
  const { getUserAndToken } = commonService()
  const { link } = config()
  const user_id = JSON.parse(getUserAndToken('user')).user_id
  const userAnswer = ref([])

  const answer = (question) => {
    if (question.length == undefined) {
      const selAnswer = question.choices.map(q => {
        return q.choice_id ==  question.answer.choice_id ? {...q, selected: true} : q 
      })
      return selAnswer
    }
  }

  const getUserAnswer = async (user_id) => {
    try {
      const answer = await axios.get(`${link}/api/get-user-answer/${user_id}`, {
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

  return { answer, getUserAnswer, userAnswer }
}

export default getAnswer