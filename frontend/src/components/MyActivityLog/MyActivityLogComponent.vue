<template>
  <div class="container">
    <div class="mt-4">
      <div class="card shadow my-activity-card">
        <div class="card-body">
          <div class="my-activity-list">
            <div class="my-activity-title border-bottom">
              <h4>My Activities</h4>
            </div>
              <div class="container mt-3">
                <div class="activity-list">
                  <MyActivityLogListComponent v-for="logs in myLogs" :key="logs.user_activity_id" :logs="logs"/>
                </div>
              </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
</template>

<script>
import MyActivityLogListComponent from './MyActivityLogListComponent.vue'
import getUserActivity from '../../composables/getUserActivity'
import { computed } from 'vue'

export default {
  name: 'MyActivityLogComponent',
  components: {
    MyActivityLogListComponent
  },
  setup() {
    const { myActivityLogs, getMyActivityLog, isLoaded } = getUserActivity()
    getMyActivityLog()
    const myLogs = computed(() => {
      if (isLoaded.value) {
        return myActivityLogs.value
      }
    })

    return { myLogs }
  }
}
</script>

<style scoped>
.my-activity-card {
  margin: auto;
  padding: 2em;
  width: 90%;
  background: #2d3748;
}
.my-activity-list {
  color: white;
  vertical-align: middle;
}
</style>