import axios from 'axios'
import { ref } from 'vue'
import config from './config' 
import commonService from '../composables/commonService'

const getUserActivity = () => {
  const { link } = config()
  const csvc = commonService()
  const allUserActivities = ref([])
  const visitedUserActivity = ref([])
  const isLoaded = ref(false)
  const myLearningList = ref()
  const myActivityLogs = ref([])
  const myFollows = ref([])

  const allUserActivity = async () => {
    try {
      const getactivity = await axios.get(`${link}/api/get-user-activities`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await getactivity.data.data
      allUserActivities.value = response
      isLoaded.value = true
    } catch(e) {
      console.error(e)
    }
  }

  const getVisitedUserActivity = async (userIn) => {
    try {
      const gActivity = await axios.post(`${link}/api/get-user-activities-by-user`, userIn, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await gActivity.data.data
      visitedUserActivity.value = response
      isLoaded.value = true
    } catch (e) {
      console.error(e)
    }
  }

  const getMyLearnings = async () => {
    try {
      const myLearning = await axios.get(`${link}/api/get-my-learnings`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await myLearning.data.data
      myLearningList.value = response
      isLoaded.value = true
    } catch (e) {
      console.error(e)
    }
  }

  const getMyActivityLog = async () => {
    try {
      const myLogs = await axios.get(`${link}/api/get-my-activities`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await myLogs.data.data
      myActivityLogs.value = response
      isLoaded.value = true
    } catch (e) {
      console.error(e)
    }
  }

  const getMyFollowers = async () => {
    try {
      const myFollowers = await axios.get(`${link}/api/get-my-followers`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await myFollowers.data.data
      myFollows.value = response
      isLoaded.value = true
    } catch (e) {

    }
  }

  return { allUserActivities, allUserActivity, isLoaded, getVisitedUserActivity, visitedUserActivity, getMyLearnings, myLearningList, getMyActivityLog, myActivityLogs, getMyFollowers, myFollows }
}

export default getUserActivity