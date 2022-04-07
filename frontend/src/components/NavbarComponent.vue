<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <Navlist />
  </nav>
</template>

<script>
import Navlist from '../components/NavlistComponent.vue'

export default {
  name: 'Navbar',
  components: {
    Navlist
  }
}
</script>

<style scoped>
.bg-dark {
  background: #2d3748 !important;
}
</style>