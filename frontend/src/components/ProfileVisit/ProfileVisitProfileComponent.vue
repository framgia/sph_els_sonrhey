<template>
  <div class="mt-4">
    <div class="card shadow dashboard-card">
      <div class="card-body">
        <div class="dashboard-list">
          <div class="main-wrapper">
            <div class="sub-wrapper text-center">
                <img :src="'http://'+user.avatar" width="200">
                <hr>
              <div>
                <h3 class="fw-bold">{{ user.full_name }}</h3>
                <h6 class="text-muted">{{ user.role.name }}</h6>
                <div class="mb-4"></div>
                <span class="badge bg-warning me-2 p-learned">{{ followedCount }} followers</span>
                <span class="badge bg-primary p-finished">{{ followingCount }} following</span>
              </div>
              <div class="mt-3 d-grid">
                <button class="btn btn-danger" v-if="checkFollow" >Unfollow</button>
                <button class="btn btn-primary" v-if="!checkFollow">Follow</button>
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
</template>

<script>
import { computed } from 'vue'
import commonService from '../../composables/commonService'

export default {
  name: 'ProfileVisitProfileComponent',
  props: ['user'],
  setup(props) {
    const { getUserAndToken } = commonService()
    const userId = JSON.parse(getUserAndToken('user')).user_id

    const checkFollow = computed(() => {
      const isFollowed = props.user.following.filter(q => q.followed_id === userId)
      if (isFollowed.length) {
        return true
      }
      return false
    })

    const followingCount = computed(() => {
      return props.user.followed.length
    })

    const followedCount = computed(() => {
      return props.user.following.length
    })

    return { followingCount, followedCount, checkFollow }
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