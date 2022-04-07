<template>
  <div class="main-wrapper">
    <div class="sub-wrapper">
      <div class="card shadow signup-card">
        <div class="card-body" style="padding: 1.5rem;">
          <div class="card-title border-bottom mb-4">
            <h3>Signup</h3>
            <div class="mb-4"></div>
          </div>
          <SignupComponent />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SignupComponent from '../components/SignupComponent.vue'
export default {
  name: 'HomeView',
  components: {
    SignupComponent
  }
}
</script>

<style scoped>
@import '../assets/login.css';

</style>