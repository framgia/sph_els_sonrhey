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
                <ProfileVisitListComponent />
              </div>
            </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import ProfileVisitListComponent from './ProfileVisitListComponent.vue'

export default {
  name: 'ProfileVisitActivityComponent',
  components: {
    ProfileVisitListComponent
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