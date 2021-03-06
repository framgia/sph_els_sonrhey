import axios from 'axios'
import { ref } from 'vue'
import config from './config' 
import commonService from '../composables/commonService'
import router from '@/router'

const getUserActivity = () => {
  const { link } = config()
  const csvc = commonService()
  const allUserActivities = ref([])
  const visitedUserActivity = ref([])
  const isLoaded = ref(false)
  const myLearningList = ref()
  const myActivityLogs = ref([])
  const myFollows = ref([])
  const pages = ref([])
  const total = ref(0)

  const allUserActivity = async () => {
    try {
      const getactivity = await axios.get(`${link}/api/get-user-activities`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await getactivity.data.data
      allUserActivities.value = response.data
      pages.value = response.links
      total.value = response.total
      isLoaded.value = true
    } catch(e) {
      checkIfAuthorized(e.response.status)
    }
  }

  const getNextActivity = async (url) => {
    try {
      const getactivity = await axios.get(`${link}/api/get-user-activities${url}`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })
      const response = await getactivity.data.data
      allUserActivities.value = response.data
      pages.value = response.links
      isLoaded.value = true
    } catch(e) {
      console.error(e)
    }
  }

  const checkIfAuthorized = (status_code) => {
    if (status_code === 401) {
      csvc.removeUserAndToken()
      router.push('/')
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
      pages.value = response.links
      total.value = response.total
      myActivityLogs.value = response.data
      isLoaded.value = true
    } catch (e) {
      console.error(e)
    }
  }

  const getMyNextActivityLog = async (url) => {
    try {
      const myLogs = await axios.get(`${link}/api/get-my-activities/${url}`, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })

      const response = await myLogs.data.data
      pages.value = response.links
      myActivityLogs.value = response.data
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

  return { allUserActivities, allUserActivity, isLoaded, getVisitedUserActivity, visitedUserActivity, getMyLearnings, myLearningList, getMyActivityLog, myActivityLogs, getMyFollowers, myFollows, pages, getNextActivity, getMyNextActivityLog, total }
}

export default getUserActivity