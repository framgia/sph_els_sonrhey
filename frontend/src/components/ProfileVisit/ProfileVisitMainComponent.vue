<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <ProfileVisitProfileComponent :user="user"/>
      </div>
      <div class="col-md-8">
        <ProfileVisitActivityComponent :activities="activities" :pages="pages" :total="total" :user="user" @actionLoader="actionLoader"/>
      </div>
    </div>
  </div>
  <Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import ProfileVisitProfileComponent from './ProfileVisitProfileComponent.vue'
import ProfileVisitActivityComponent from './ProfileVisitActivityComponent.vue'
import commonService from '../../composables/commonService'
import Loader from '../../components/LoadingComponent.vue'
import { ref } from 'vue'

export default {
  name: 'ProfileVisitMainComponent',
  components: {
    ProfileVisitProfileComponent,
    ProfileVisitActivityComponent,
    Loader
  },
  setup() {
    const { getVisitedUser } = commonService()
    const isShowLoading = ref(false)
    const visitedDetails = getVisitedUser()
    const user = visitedDetails.user
    const activities = visitedDetails.user_activity.data
    const pages = ref([])
    const total = ref(0)
    pages.value = visitedDetails.user_activity.links
    total.value = visitedDetails.user_activity.total

    const actionLoader = () => {
      isShowLoading.value = !isShowLoading.value
    }

    return { user, activities, pages, actionLoader, isShowLoading, total }
  }
}
</script>