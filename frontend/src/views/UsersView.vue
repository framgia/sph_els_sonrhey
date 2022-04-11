<template>
  <NavbarComponent />
  <UserMainComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import UserMainComponent from '../components/UserMainComponent.vue'

export default {
  name: 'UsersView',
  components: {
    NavbarComponent,
    UserMainComponent
  }
}
</script>

<style>

</style>