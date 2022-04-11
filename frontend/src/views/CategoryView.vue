<template>
  <NavbarComponent />
  <CategoryMainComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import CategoryMainComponent from '../components/CategoryMainComponent.vue'

export default {
  name: 'CategoryView',
  components: {
    NavbarComponent,
    CategoryMainComponent
  }
}
</script>

<style>

</style>