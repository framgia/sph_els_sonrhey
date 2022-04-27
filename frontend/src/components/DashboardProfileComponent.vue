<template>
  <div class="mt-4">
    <div class="card shadow dashboard-card">
      <div class="card-body">
        <div class="dashboard-list">
          <div class="main-wrapper">
            <div class="sub-wrapper text-center">
                <img :src="'http://'+user.avatar" onerror="this.onerror=null;this.src='https://dummyimage.com/200';" width="200" style="border-radius: 10em;">
                <hr>
              <div class="">
                <h3 class="fw-bold">{{ user.full_name }}</h3>
                <h6 class="text-muted">{{ user.role.name }}</h6>
                <div class="mb-4"></div>
                <span class="badge bg-warning me-2 p-learned">Answered {{ questionsAnswered }} questions</span>
                <span class="badge bg-primary p-finished">Finished {{ categoriesFinished }} categories</span>
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
import commonService from '../composables/commonService'
import getUserActivity from '../composables/getUserActivity'

export default {
  name: 'DashboardProfileComponent',
  setup() {
    const { getUserAndToken } = commonService()
    const { getMyLearnings, myLearningList, isLoaded } = getUserActivity()
    const user = JSON.parse(getUserAndToken('user'))

    getMyLearnings()

    const questionsAnswered = computed(() => {
      if (isLoaded.value) {
        return myLearningList.value.questions_answered
      }
      return 0
    })

    const categoriesFinished = computed(() => {
      if (isLoaded.value) {
        return myLearningList.value.categories_finished
      }
      return 0
    })

    return { user, myLearningList, questionsAnswered, categoriesFinished }
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