<template>
  <div class="modal" tabindex="-1" ref="res" id="followsModal" data-backdrop="static">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background: #2d3748;">
        <div class="modal-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="following-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Following</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="followers-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Followers</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="following-tab">
              <table class="table mt-4">
                <tbody>
                  <tr v-for="follow in following" :key="follow.user_relationship_id">
                    <td>{{ follow.following.full_name }}</td>
                    <td><a href="#" @click="unfollow_user(follow.following.user_id)">
                      <span v-if="!isFollow">Unfollow</span>
                      <span v-else>Unfollowing</span>  
                    </a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="followers-tab">
              <table class="table mt-4">
                <tbody>
                  <tr v-for="follow in followers" :key="follow.user_relationship_id">
                    <td>{{ follow.followed_back.full_name }}</td>
                    <td><a href="#" v-if="followed === isUnFollowUser" @click="unfollow_user(follow.followed_back.user_id)">
                      <span v-if="!isFollow">Unfollow</span>
                      <span v-else>Unfollowing</span>  
                    </a></td>
                    <td><a href="#" v-if="followed === isFollowBackUser" @click="follow_user(follow.followed_back.user_id)">
                      <span v-if="!isFollow">Follow Back</span>
                      <span v-else>Following</span>  
                    </a></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '@/store'
import { ref, watchEffect, computed } from 'vue'
import commonService from '../../composables/commonService'
import userActions from '../../composables/userActions'
import config from '../../composables/config'
import axios from 'axios'

export default {
  name: 'UserRelationshipComponent',
  setup(props, context) {
    const following = ref()
    const followers = ref()
    const isFollow = ref(false)
    const { link } = config()
    const { getUserAndToken } = commonService()
    const { isFollowBackUser, isUnFollowUser } = userActions()
    const userId = JSON.parse(getUserAndToken('user')).user_id

    watchEffect(() => {
      if (store.state.following.length) {
        following.value = store.state.following
      }
      if (store.state.followers.length) {
        followers.value = store.state.followers
      }
    })

    const followed = computed(() => {
      if (store.state.following.length) {
        const isFollow = following.value.filter(q => q.followed_id === userId)
        if (isFollow.length) {
          return isUnFollowUser
        }
      }

      if (store.state.followers.length) {
        const followBack = followers.value.filter(q => q.following_id === userId)
        if (followBack.length) {
          return isFollowBackUser
        }
      }
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

    return { following, followers, followed, isFollowBackUser, isUnFollowUser, follow_user, isFollow, unfollow_user }
  }
}
</script>

<style scoped>
.nav-tabs .nav-link.active {
  background: #1a202c !important;
  color: white !important;
}
.table {
  color: white;
}
</style>