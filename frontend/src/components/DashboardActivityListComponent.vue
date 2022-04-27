<template>
  <div class="card shadow mb-2 activity" v-if="categories">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img :src="'http://'+userActivity.user.avatar" onerror="this.onerror=null;this.src='https://dummyimage.com/70';" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6>
                <span v-if="userId === userActivity.user_id" class="fw-bold">You</span>
                <span v-else><a href="#" class="fw-bold" @click="visitUser(userActivity.user_id)">{{ userActivity.user.full_name }}</a></span>
                completed the category <span class="fw-bold">{{ categories.title }}</span></h6>
                <p class="text-muted mt-2">{{ getDateTimeDifference(userActivity.created_at) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card shadow mb-2 activity" v-for="relationship in relationships" :key="relationship.user_relationship_id">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img :src="'http://'+relationship.followed_back.avatar" onerror="this.onerror=null;this.src='https://dummyimage.com/70';" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6>
                  <span v-if="userId === relationship.followed_back.user_id" class="fw-bold">You</span>
                  <span v-else><a href="#" @click="visitUser(relationship.followed_back.user_id)" class="fw-bold">{{ relationship.followed_back.full_name }}</a></span>
                  <span v-if="userId === relationship.followed_back.user_id"> followed </span>
                  <span v-if="userId === relationship.following.user_id || userId !== relationship.followed_back.user_id"> follows </span>
                  <span v-if="userId === relationship.following.user_id">You</span>
                  <span v-else><a href="#" @click="visitUser(relationship.following.user_id)" class="fw-bold">{{ relationship.following.full_name }}</a></span>
                </h6>
                <p class="text-muted mt-2">{{ getDateTimeDifference(userActivity.created_at) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import commonService from '../composables/commonService'
import { computed } from 'vue'
import getUserActivity from '../composables/getUserActivity'
import { useRouter } from 'vue-router'
import getTimeDateYearDifference from '../composables/getTimeDateDifference'

export default {
  name: 'DashboardActivityListComponent',
  props: ['userActivity'],
  emits: ['actionLoader'],
  setup(props, context) {
    const router = useRouter()
    const { getUserAndToken, setVisitedUser } = commonService()
    const { getVisitedUserActivity, visitedUserActivity, isLoaded } = getUserActivity()
    const userId = JSON.parse(getUserAndToken('user')).user_id

    const categories = computed(() => {
      const categoryList = props.userActivity.category
      if (categoryList) {
        return categoryList
      }
    })

    const relationships = computed(() => {
      const relationshipList = props.userActivity.user_relationship
      return relationshipList
    })

    const visitUser = async (userId) => {
      context.emit('actionLoader', true)
      const userIn = {
        user_id : userId
      }
      const getAct = await getVisitedUserActivity(userIn)
      if (isLoaded.value) {
        setVisitedUser(visitedUserActivity.value)
        context.emit('actionLoader', false)
        router.push({ path: '/profile-visit' })
      }
    }

    const getDateTimeDifference = (created_at) => {
      const time = getTimeDateYearDifference(created_at)
      return time
    }
    
    return { categories, relationships, userId, visitUser, getDateTimeDifference }
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