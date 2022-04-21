<template>
  <div class="mt-4">
    <div class="card shadow dashboard-card">
      <div class="card-body">
        <div class="dashboard-list">
          <div class="main-wrapper">
            <div class="sub-wrapper text-center">
                <img :src="'http://'+user.avatar" width="200" style="border-radius: 10em;">
                <hr>
              <div class="">
                <h3 class="fw-bold">{{ user.full_name }}</h3>
                <h6 class="text-muted">{{ user.role.name }}</h6>
                <div class="mb-4"></div>
                <span class="badge bg-warning me-2 p-learned">Answered 20 questions</span>
                <span class="badge bg-primary p-finished">Finished 2 categories</span>
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

export default {
  name: 'DashboardProfileComponent',
  setup() {
    const { getUserAndToken } = commonService()
    const user = JSON.parse(getUserAndToken('user'))

    return { user }
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