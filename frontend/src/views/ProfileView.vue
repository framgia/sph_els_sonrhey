<template>
  <NavbarComponent />
  <ProfileComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import ProfileComponent from '../components/ProfileComponent.vue'

export default {
  name: 'ProfileView',
  components: {
    NavbarComponent,
    ProfileComponent
  }
}
</script>

<style>

</style>