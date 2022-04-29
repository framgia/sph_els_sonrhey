<template>
  <div class="mt-4">
    <div class="card shadow dashboard-card">
      <div class="card-body">
        <div class="dashboard-list">
          <div class="main-wrapper">
            <div class="sub-wrapper text-center">
                <img :src="'http://'+user.avatar" onerror="this.onerror=null;this.src='https://dummyimage.com/200';" width="200">
                <hr>
              <div>
                <h3 class="fw-bold">{{ user.full_name }}</h3>
                <h6 class="text-muted">{{ user.role.name }}</h6>
                <div class="mb-4"></div>
                <div class="follows" data-bs-toggle="modal" data-bs-target="#followsModal" @click="viewFollows">
                  <span class="badge bg-warning me-2 p-learned">{{ followedCount }} followers</span>
                  <span class="badge bg-primary p-finished">{{ followingCount }} following</span>
                </div>
              </div>
              <div class="mt-3 d-grid">
                <button class="btn btn-danger" v-if="checkFollow === isUnFollowUser" @click="unfollow_user(user.user_id)" :disabled=isFollow>
                  <span v-if="!isFollow">Unfollow</span>
                  <span v-else>Unfollowing</span>
                </button>
                <button class="btn btn-warning" v-if="checkFollow === isFollowBackUser" @click="follow_user(user.user_id)" :disabled=isFollow>
                  <span v-if="!isFollow">Follow Back</span>
                  <span v-else>Following</span>
                </button>
                <button class="btn btn-primary" v-if="checkFollow === isFollowUser" @click="follow_user(user.user_id)" :disabled=isFollow>
                  <span v-if="!isFollow">Follow</span>
                  <span v-else>Following</span>
                </button>
              </div>
              <div class="mt-3 d-grid">
                <span class="f-lessons">Finished {{ user.category.length }} Lessons</span>
              </div>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <UserVisitRelationshipComponent @unfollowUser="unfollow_user" />
</template>

<script>
import { computed, ref } from 'vue'
import commonService from '../../composables/commonService'
import getUserActivity from '../../composables/getUserActivity'
import axios from 'axios'
import config from '../../composables/config'
import userActions from '../../composables/userActions'
import UserVisitRelationshipComponent from '../../components/Tabs/UserVisitRelationshipComponent.vue'
import { useStore } from 'vuex'

export default {
  name: 'ProfileVisitProfileComponent',
  props: ['user'],
  components: {
    UserVisitRelationshipComponent
  },
  setup(props) {
    const stored = useStore()
    const { getUserAndToken, setVisitedUser, setUserFollowers, getUserFollowers } = commonService()
    const { getVisitedUserActivity, visitedUserActivity, isLoaded, getMyFollowers, myFollows } = getUserActivity()
    const { isFollowUser, isFollowBackUser, isUnFollowUser } = userActions()
    const userId = JSON.parse(getUserAndToken('user')).user_id
    const user = ref(props.user)
    const isFollow = ref(false)
    const { link } = config()

    const refreshVisit = async (visitUserId) => {
      const userIn = {
        user_id : visitUserId
      }
      const getAct = await getVisitedUserActivity(userIn)
      if (isLoaded.value) {
        setVisitedUser(visitedUserActivity.value)
        location.reload()
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
        const response = await unfollow.data.data
        refreshVisit(unFollowUserId)
      } catch(e) {
        console.error(e)
      }
    }

    const follow_user = async (followUserId) => {
      isFollow.value = !isFollow.value
      try {
        const followIn = {
          "following_id" : followUserId
        }
        const follow = await axios.post(`${link}/api/follow`, followIn ,{
          headers: {
              Authorization: `Bearer ${getUserAndToken('token')}`
          }
        })
        const response = await follow.data.data
        refreshVisit(followUserId)
      } catch(e) {
        console.error(e)
      }
    }

    const checkFollow = computed(() => {
      const isFollowed = props.user.following.filter(q => q.followed_id === userId)
      if (isFollowed.length) {
        return isUnFollowUser
      }
      const isFollowing = props.user.followed.filter(q => q.following_id === userId)
      if (isFollowing.length) {
        return isFollowBackUser
      }
      return isFollowUser
    })

    const viewFollows = computed(() => {
      const followed = props.user.followed
      if (followed.length) {
        stored.commit('setFollowing', followed)
      }
      const following = props.user.following
      if (following.length) {
        stored.commit('setFollowers', following)
      }
    })

    const followingCount = computed(() => {
      return props.user.followed.length
    })

    const followedCount = computed(() => {
      return props.user.following.length
    })

    const myRelationships = async () => {
      const myFollowers = await getMyFollowers()
      setUserFollowers(myFollows.value)
    }
    myRelationships()

    return { followingCount, followedCount, checkFollow, unfollow_user, follow_user, user, isFollow, isFollowUser, isFollowBackUser, isUnFollowUser, viewFollows }
  }
}
</script>

<style scoped>
.dashboard-card {
  margin: auto;
  background: #2d3748;
}
.dashboard-list {
  color: white;
  vertical-align: middle;
}
</style>