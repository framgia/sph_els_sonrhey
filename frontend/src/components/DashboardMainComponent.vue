<template>
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <DashboardProfileComponent />
    </div>
    <div class="col-md-8">
      <DashboardActivityComponent @actionLoader="actionLoader"/>
    </div>
  </div>
</div>
<Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import DashboardProfileComponent from '../components/DashboardProfileComponent.vue'
import DashboardActivityComponent from '../components/DashboardActivityComponent.vue'
import Loader from '../components/LoadingComponent.vue'
import { ref } from 'vue'

export default {
  name: 'DashboardComponent',
  components: {
    DashboardProfileComponent,
    DashboardActivityComponent,
    Loader
  },
  setup() {
    const isShowLoading = ref(false)
    const actionLoader = () => {
      isShowLoading.value = !isShowLoading.value
    }
    return { isShowLoading, actionLoader }
  }
}
</script>