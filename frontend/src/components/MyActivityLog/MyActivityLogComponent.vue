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
                  <MyActivityLogListComponent />
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

export default {
  name: 'MyActivityLogComponent',
  components: {
    MyActivityLogListComponent
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