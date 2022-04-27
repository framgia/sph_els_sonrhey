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
                <nav>
                  <ul class="pagination">
                    <li class="page-item" :class="{'disabled' : page.active || page.url == null}" v-for="page in pages" :key="page.label"><a class="page-link" href="#" @click="nextActivity(page.url)" v-html="page.label"></a></li>
                  </ul>
                </nav>
              </div>
          </div>
        </div> 
      </div>
    </div>
  </div>
  <Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import MyActivityLogListComponent from './MyActivityLogListComponent.vue'
import getUserActivity from '../../composables/getUserActivity'
import Loader from '../../components/LoadingComponent.vue'
import { computed, ref } from 'vue'

export default {
  name: 'MyActivityLogComponent',
  components: {
    MyActivityLogListComponent,
    Loader
  },
  setup() {
    const isShowLoading = ref(false)
    const { myActivityLogs, getMyActivityLog, isLoaded, pages, getMyNextActivityLog } = getUserActivity()
    getMyActivityLog()
    const myLogs = computed(() => {
      if (isLoaded.value) {
        return myActivityLogs.value
      }
    })

    const nextActivity = async (url) => {
      isShowLoading.value = !isShowLoading.value
      const myLog = await getMyNextActivityLog(url)
      if (isLoaded.value) {
        isShowLoading.value = !isShowLoading.value
      }
    }

    return { myLogs, pages, isShowLoading, nextActivity }
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