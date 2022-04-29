import axios from "axios"
import { ref } from 'vue'
import commonService from '../composables/commonService'
import config from '../composables/config'

const relationships = () => {
  const { getUserAndToken } = commonService()
  const { link } = config()
  const response = ref()
  const userId = JSON.parse(getUserAndToken('user')).user_id

  const unfollow_user = async (unFollowUserId) => {
    try {
      const unFollowingIn = {
        "following_id" : unFollowUserId,
        "followed_id" : userId
      }
      const unfollow = await axios.post(`${link}/api/unfollow`, unFollowingIn ,{
        headers: {
          Authorization: `Bearer ${getUserAndToken('token')}`
        }
      })
      response.value = await unfollow.data.data
    } catch(e) {
      console.error(e.message)
    }
  }
  
  const follow_user = async (user_id) => {
    try {
      const followIn = {
        "following_id" : user_id
      }
      const follow = await axios.post(`${link}/api/follow`, followIn ,{
        headers: {
            Authorization: `Bearer ${getUserAndToken('token')}`
        }
      })
      response.value = await follow.data.data
    } catch(e) {
      console.error(e)
    }
  }

  return { unfollow_user, follow_user, response }
}

export default relationships