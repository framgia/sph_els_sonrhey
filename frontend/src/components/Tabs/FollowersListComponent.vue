<template>
  <div class="card shadow mb-3" style="background: #1a202c">
    <div class="card-body">
      <div class="user-wrapper-container">
        <div class="user-wrapper">
          <table>
            <tbody>
              <tr>
                <td>
                  <img :src="`http://${follow.followed_back.avatar}`" onerror="this.onerror=null;this.src='https://dummyimage.com/70';" width="70">
                </td>
                <td style="width: 3em">
                </td>
                <td style="text-align: left; width: 30em">
                  <h4>{{ follow.followed_back.full_name }}</h4>
                  <h5>{{ follow.followed_back.email_address }}</h5>
                </td>
                <td>
                  <button type="button" class="btn btn-danger" v-if="followed === isUnFollowUser" @click="unfollow_user(follow.followed_back.user_id)" :disabled=isFollow>
                    <span v-if="!isFollow">Unfollow</span>
                    <span v-else>Unfollowing</span>  
                  </button>
                </td>
                <td>
                  <button type="button" class="btn btn-warning" v-if="followed === isFollowBackUser" @click="follow_user(follow.followed_back.user_id)" :disabled=isFollow>
                    <span v-if="!isFollow">Follow Back</span>
                    <span v-else>Following</span>  
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
import { ref, watchEffect, computed } from 'vue'
import commonService from '../../composables/commonService'
import userActions from '../../composables/userActions'
import config from '../../composables/config'
import axios from 'axios'
import store from '@/store'

export default {
  name: 'FollowersListComponent',
  props:['follow'],
  emits: ['show'],
  setup(props, context) {
    const isFollow = ref(false)
    const { link } = config()
    const { getUserAndToken } = commonService()
    const { isFollowBackUser, isUnFollowUser } = userActions()
    const userId = JSON.parse(getUserAndToken('user')).user_id
    
    const followed = computed(() => {
      const following = store.state.following
      if (following.length) {
        const unfollow = following.filter(q => q.following_id === props.follow.followed_id) 
        if (unfollow.length) {
          return isUnFollowUser
        } 
      }
      return isFollowBackUser
    })

    const follow_user = async (user_id) => {
      isFollow.value = !isFollow.value
      try {
        const followIn = {
          "following_id" : user_id
        }
        const follow = await axios.post(`${link}/api/follow`, followIn ,{
          headers: {
              Authorization: `Bearer ${getUserAndToken('token')}`
          }
        })
        isFollow.value = !isFollow.value
        const response = await follow.data.data
        context.emit('show', response)
      } catch(e) {
        console.error(e)
      }
    }

    const unfollow_user = async (unFollowUserId) => {
      isFollow.value = !isFollow.value
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
        isFollow.value = !isFollow.value
        const response = await unfollow.data.data
        context.emit('show', response)
      } catch(e) {
        console.error(e)
      }
    }

    return { followed, isFollowBackUser, isUnFollowUser, follow_user, unfollow_user, isFollow }
  }
}
</script>

<style>

</style>