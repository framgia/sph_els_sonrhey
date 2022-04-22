<template>
  <div class="mt-4">
    <div class="card shadow dashboard-activity-card">
      <div class="card-body">
        <div class="dashboard-activity-list">
          <div class="dashboard-activity-title border-bottom">
            <h4>User Activities</h4>
          </div>
            <div class="container mt-3">
              <div class="activity-list">
                <DashboardActivityListComponent v-for="userActivity in allUserActivities" :key="userActivity.user_activity_id" :userActivity="userActivity" @actionLoader="actionLoaderList"/>
              </div>
            </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import DashboardActivityListComponent from '../components/DashboardActivityListComponent.vue'
import getUserActivity from '../composables/getUserActivity'

export default {
  name: 'DashboardActivityComponent',
  components: {
    DashboardActivityListComponent
  },
  emits: ['actionLoader'],
  setup(props, context) {
    const { allUserActivities, allUserActivity } = getUserActivity()
    const callUserActivity = allUserActivity()
    const actionLoaderList = () => {
      context.emit('actionLoader', true)
    }
    return { allUserActivities, actionLoaderList }
  }
}
</script>

<style scoped>
.dashboard-activity-card {
  margin: auto;
  background: #2d3748;
}
.dashboard-activity-list {
  color: white;
  vertical-align: middle;
}
</style>