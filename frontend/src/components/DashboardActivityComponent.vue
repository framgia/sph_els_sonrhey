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
              <div v-if="!allUserActivities.length" class="text-center">
                {{ checkActivities }}
              </div>
              <nav :class="{'d-none' : total <= paginationTotal}">
                <ul class="pagination">
                  <li class="page-item" :class="{'disabled' : page.active || page.url == null}" v-for="page in pages" :key="page.label"><a class="page-link" href="#" @click="nextActivity(page.url)" v-html="page.label"></a></li>
                </ul>
              </nav>
            </div>
        </div>
      </div>  
    </div>
  </div>
</template>

<script>
import DashboardActivityListComponent from '../components/DashboardActivityListComponent.vue'
import getUserActivity from '../composables/getUserActivity'
import { computed } from 'vue'
import commonService from '../composables/commonService'

export default {
  name: 'DashboardActivityComponent',
  components: {
    DashboardActivityListComponent
  },
  emits: ['actionLoader'],
  setup(props, context) {
    const { allUserActivities, allUserActivity, pages, getNextActivity, isLoaded, total } = getUserActivity()
    const { paginationTotal } = commonService()
    const callUserActivity = allUserActivity()
    const actionLoaderList = () => {
      context.emit('actionLoader', true)
    }

    const nextActivity = async (url) => {
      context.emit('actionLoader', true)
      const getnext = await getNextActivity(url)
      if (isLoaded.value) {
        context.emit('actionLoader', false)
      }
    }

    const checkActivities = computed(() => {
      if (isLoaded.value && !allUserActivities.value.length) {
        return 'No user activities yet.'
      }
      return 'Data is still loading.'
    })

    return { allUserActivities, actionLoaderList, pages, nextActivity, total, checkActivities, paginationTotal }
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
.pagination {
  justify-content: center;
}
</style>