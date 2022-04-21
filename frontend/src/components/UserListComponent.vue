<template>
  <div class="card shadow mb-3" style="background: #1a202c">
    <div class="card-body">
      <div class="user-wrapper-container">
        <div class="user-wrapper">
          <table>
            <tbody>
              <tr>
                <td>
                  <img :src="`http://${user.avatar}`" width="70">
                </td>
                <td style="width: 3em">
                </td>
                <td style="text-align: left; width: 30em">
                  <h4>{{ user.full_name }}</h4>
                  <h5>{{ user.email_address }}</h5>
                </td>
                <td>
                  <button type="button" class="btn btn-primary" v-if="followed === isFollowUser"  @click="follow_user(user.user_id)" :disabled=isFollow>
                    <span v-if="!isFollow">Follow</span>
                    <span v-else>Following</span>
                  </button>
                  <button type="button" class="btn btn-warning" v-if="followed === isFollowBackUser"  @click="follow_user(user.user_id)" :disabled=isFollow>
                    <span v-if="!isFollow">Followback</span>
                    <span v-else>Following</span>
                  </button>
                  <button type="button" class="btn btn-danger" v-if="followed === isUnFollowUser" @click="unfollow_user(user.user_id)" :disabled=isFollow>
                    <span v-if="!isFollow">Unfollow</span>
                    <span v-else>Unfollowing</span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue'
import axios from 'axios'
import commonService from '../composables/commonService'
import config from '../composables/config'
import userActions from '../composables/userActions'

export default {
  name: 'UserListComponent',
  props: ['user'],
  setup(props, context) {
    const csvc = commonService()
    const isFollow = ref(false)
    const { link } = config()
    const { isFollowUser, isFollowBackUser, isUnFollowUser } = userActions()
    const userId = JSON.parse(csvc.getUserAndToken('user')).user_id

    const followed = computed(() => {
      const isFollow = props.user.following.filter(q => q.followed_id === userId)
      if (isFollow.length) {
        return isUnFollowUser
      }
      const followBack = props.user.followed.filter(q => q.following_id === userId)
      if (followBack.length) {
        return isFollowBackUser
      }
      return isFollowUser
    })

    const unfollow_user = async (unFollowUserId) => {
      isFollow.value = !isFollow.value
      try {
        const unFollowingIn = {
          "following_id" : unFollowUserId,
          "followed_id" : userId
        }
        const unfollow = await axios.post(`${link}/api/unfollow`, unFollowingIn ,{
          headers: {
            Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        isFollow.value = !isFollow.value
        const response = await unfollow.data.data
        context.emit('show', response)
      } catch(e) {
        console.error(e)
      }
    }
    
    const follow_user = async (user_id) => {
      isFollow.value = !isFollow.value
      try {
        const followIn = {
          "following_id" : user_id
        }
        const follow = await axios.post(`${link}/api/follow`, followIn ,{
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        isFollow.value = !isFollow.value
        const response = await follow.data.data
        context.emit('show', response)
      } catch(e) {
        console.error(e)
      }
    }
    return { follow_user, isFollow, followed, unfollow_user, isFollowUser, isFollowBackUser, isUnFollowUser  } 
  }
}
</script>

<style>

</style>