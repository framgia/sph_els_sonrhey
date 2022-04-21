<template>
  <NavbarComponent />
  <MyActivityLogComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import MyActivityLogComponent from '../components/MyActivityLog/MyActivityLogComponent.vue'

export default {
  name: 'MyActivityLogView',
  components: {
    NavbarComponent,
    MyActivityLogComponent
  }
}
</script>

<style>

</style>