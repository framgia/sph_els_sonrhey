<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <ProfileVisitProfileComponent />
      </div>
      <div class="col-md-8">
        <ProfileVisitActivityComponent />
      </div>
    </div>
  </div>
</template>

<script>
import ProfileVisitProfileComponent from './ProfileVisitProfileComponent.vue'
import ProfileVisitActivityComponent from './ProfileVisitActivityComponent.vue'

export default {
  name: 'ProfileVisitMainComponent',
  components: {
    ProfileVisitProfileComponent,
    ProfileVisitActivityComponent
  }
}
</script>