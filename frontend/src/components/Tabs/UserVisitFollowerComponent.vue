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
                  <button type="button" class="btn btn-primary" v-if="checkUser(follow.followed_back.user_id) === isFollowUser" @click="followUser(follow.followed_back.user_id)" :disabled=isFollow>
                  <span v-if="!isFollow">Follow</span>
                  <span v-else>Following</span>  
                  </button>
                  <button type="button" class="btn btn-warning" v-if="checkUser(follow.followed_back.user_id) === isFollowBackUser" @click="followUser(follow.followed_back.user_id)"  :disabled=isFollow>
                  <span v-if="!isFollow">Follow Back</span>
                  <span v-else>Following</span>  
                  </button>
                  <button type="button" class="btn btn-danger" v-if="checkUser(follow.followed_back.user_id) === isUnFollowUser" @click="unfollowUser(follow.followed_back.user_id)"  :disabled=isFollow>
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
import commonService from '../../composables/commonService'
import userActions from '../../composables/userActions'
import relationships from '../../composables/relationships'
import { ref } from 'vue'

export default {
  name: 'UserVisitFollowerComponent',
  props: ['follow'],
  setup(props, context) {
    const { getUserFollowers, getUserAndToken } = commonService()
    const { unfollow_user, follow_user, response } = relationships()
    const { isFollowUser, isFollowBackUser, isUnFollowUser } = userActions()
    const myUserId = JSON.parse(getUserAndToken('user')).user_id
    const myFollowers = getUserFollowers()
    const isFollow = ref(false)

    const checkUser = (userId) => {

      if (userId === myUserId) {
        return
      }

      let indFollowing = false
      let indFollower = false
      const checkFollowed = myFollowers.following.filter(q => q.followed_id === userId)
      if (checkFollowed.length) {
        indFollower = true
      }

      const checkFollowing = myFollowers.followed.filter(q => q.following_id === userId)
      if (checkFollowing.length) {
        indFollowing = true
      }

      if ((indFollowing && indFollower) || indFollowing) {
        return isUnFollowUser
      } else if (indFollower) {
        return isFollowBackUser
      }
      return isFollowUser
    }

    const followUser = async (userId) => {
      isFollow.value = !isFollow.value
      const follow = await follow_user(userId)
      isFollow.value = !isFollow.value
      context.emit('showMessage', response.value)
    }

    const unfollowUser = async (userId) => {
      isFollow.value = !isFollow.value
      const unfollow = await unfollow_user(userId)
      isFollow.value = !isFollow.value
      context.emit('showMessage', response.value)
    }

    return { checkUser, isFollowUser, isFollowBackUser, isUnFollowUser, followUser, unfollowUser, isFollow }
  }
}
</script>

<style>

</style>