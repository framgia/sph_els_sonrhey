<template>
  <NavbarComponent />
  <LessonsMainComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import LessonsMainComponent from '../components/LessonsMainComponent.vue'

export default {
  name: 'LessonsView',
  components: {
    NavbarComponent,
    LessonsMainComponent
  }
}
</script>

<style>

</style>