<template>
  <div class="card shadow mb-3" style="background: #1a202c">
    <div class="card-body">
      <div class="user-wrapper-container">
        <div class="user-wrapper">
          <table>
            <tbody>
              <tr>
                <td>
                  <img :src="`http://${follow.following.avatar}`" onerror="this.onerror=null;this.src='https://dummyimage.com/70';" width="70">
                </td>
                <td style="width: 3em">
                </td>
                <td style="text-align: left; width: 30em">
                  <h4>{{ follow.following.full_name }}</h4>
                  <h5>{{ follow.following.email_address }}</h5>
                </td>
                <td>
                  <button type="button" class="btn btn-danger" @click="unfollow_user(follow.following.user_id)" :disabled=isFollow>
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
import { ref } from 'vue'
import commonService from '../../composables/commonService'
import axios from 'axios'
import config from '../../composables/config'

export default {
  name: 'FollowingListComponent',
  props: ['follow'],
  emits: ['show'],
  setup(props, context) {
    const isFollow = ref(false)
    const { link } = config()
    const { getUserAndToken } = commonService()
    const userId = JSON.parse(getUserAndToken('user')).user_id

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
    return { isFollow, unfollow_user }
  }
}
</script>

<style>

</style>