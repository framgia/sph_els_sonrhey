<template>
  <div class="main-wrapper">
    <div class="sub-wrapper">
      <div class="card shadow login-card">
        <div class="card-body" style="padding: 1.5rem;">
          <div class="card-title border-bottom mb-4">
            <h3>Login</h3>
            <div class="mb-4"></div>
          </div>
          <LoginComponent />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LoginComponent from '../components/LoginComponent.vue'
export default {
  name: 'HomeView',
  components: {
    LoginComponent
  }
}
</script>

<style scoped>
@import '../assets/login.css';
</style>