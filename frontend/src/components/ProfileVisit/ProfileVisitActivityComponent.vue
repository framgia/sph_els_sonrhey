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
              <ProfileVisitListComponent v-for="activity in activities" :key="activity.user_activity_id" :activity="activity"/>
            </div>
          </div>
          <nav>
            <ul class="pagination mt-3">
              <li class="page-item" :class="{'disabled' : page.active || page.url == null}" v-for="page in pages" :key="page.label"><a class="page-link" href="#" @click="nextActivity(page.url)" v-html="page.label"></a></li>
            </ul>
          </nav>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import ProfileVisitListComponent from './ProfileVisitListComponent.vue'
import commonService from '../../composables/commonService'
import { ref } from 'vue'
import axios from 'axios'
import config from '../../composables/config'

export default {
  name: 'ProfileVisitActivityComponent',
  props: ['activities', 'pages', 'user'],
  components: {
    ProfileVisitListComponent
  },
  setup(props, context) {
    const csvc = commonService()
    const pages = ref()
    const activities = ref()
    const { link } = config()
    pages.value = props.pages
    activities.value = props.activities

    const nextActivity = async (url) => {
      context.emit('actionLoader')
      const userIn = {
        "user_id" : props.user.user_id
      }
      const gActivity = await axios.post(`${link}/api/get-user-activities-by-user/${url}`, userIn, {
        headers: {
          Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
      })
      const response = await gActivity.data.data
      pages.value = response.user_activity.links
      activities.value = response.user_activity.data
      context.emit('actionLoader')
    }

    return { nextActivity, pages, activities }
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