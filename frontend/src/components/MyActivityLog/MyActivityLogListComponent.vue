<template>
  <div class="card shadow mb-2 activity" v-if="categoryUsed">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img :src="'http://'+logs.user.avatar" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6>You completed the category <span class="fw-bold">{{ categoryUsed.title }}</span></h6>
                <p class="text-muted">{{ getDateTimeDifference(logs.created_at) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card shadow mb-2 activity" v-if="relationships">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img :src="'http://'+logs.user.avatar" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6><span class="fw-bold">You </span> followed <span class="fw-bold">{{ relationships.following.full_name }}</span></h6>
                <p class="text-muted">{{ getDateTimeDifference(logs.created_at) }}</p>
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
import getTimeDateYearDifference from '../../composables/getTimeDateDifference'

export default {
  name: 'MyActivityLogListComponent',
  props: ['logs'],
  setup(props) {
    const categoryUsed = computed(() => {
      const category_by_user = props.logs.category
      if (category_by_user) {
        return category_by_user
      }
    })

    const relationships = computed(() => {
      const followed_by_user = props.logs.followed_by_user
      if (followed_by_user) {
        return followed_by_user
      }
    })

    const getDateTimeDifference = (created_at) => {
      const time = getTimeDateYearDifference(created_at)
      return time
    }

    return { categoryUsed, relationships, getDateTimeDifference }
  }
}
</script>

<style scoped>
.activity {
  background: #1a202c;
}
h6, p {
  margin: 0;
}
</style>