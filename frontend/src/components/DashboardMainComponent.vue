<template>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <DashboardProfileComponent />
    </div>
    <div class="col-md-8">
      <DashboardActivityComponent />
    </div>
  </div>
</div>
</template>

<script>
import DashboardProfileComponent from '../components/DashboardProfileComponent.vue'
import DashboardActivityComponent from '../components/DashboardActivityComponent.vue'

export default {
  name: 'DashboardComponent',
  components: {
    DashboardProfileComponent,
    DashboardActivityComponent
  }
}
</script>