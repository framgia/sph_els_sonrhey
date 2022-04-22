<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <ProfileVisitProfileComponent :user="user"/>
      </div>
      <div class="col-md-8">
        <ProfileVisitActivityComponent :activities="activities"/>
      </div>
    </div>
  </div>
</template>

<script>
import ProfileVisitProfileComponent from './ProfileVisitProfileComponent.vue'
import ProfileVisitActivityComponent from './ProfileVisitActivityComponent.vue'
import commonService from '../../composables/commonService'

export default {
  name: 'ProfileVisitMainComponent',
  components: {
    ProfileVisitProfileComponent,
    ProfileVisitActivityComponent
  },
  setup() {
    const { getVisitedUser } = commonService()
    const visitedDetails = getVisitedUser()
    const user = visitedDetails.user
    const activities = visitedDetails.user_activity

    return { user, activities }
  }
}
</script>