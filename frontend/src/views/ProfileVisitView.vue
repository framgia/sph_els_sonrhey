<template>
  <NavbarComponent />
  <ProfileVisitComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import ProfileVisitComponent from '../components/ProfileVisit/ProfileVisitMainComponent.vue'

export default {
  name: 'ProfileVisitView',
  components: {
    NavbarComponent,
    ProfileVisitComponent
  }
}
</script>

<style>

</style>