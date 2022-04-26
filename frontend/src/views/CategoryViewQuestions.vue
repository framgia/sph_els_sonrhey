<template>
  <navbar-component />
  <category-view-main-component />
</template>

<script>
import CategoryViewMainComponent from '@/components/CategoryViewMainComponent.vue'
import NavbarComponent from '@/components/NavbarComponent.vue'
export default {
  components: { 
    CategoryViewMainComponent,
    NavbarComponent 
  }
}
</script>

<style>

</style>