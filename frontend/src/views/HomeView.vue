<template>
  <div class="main-wrapper">
    <div class="sub-wrapper">
      <div class="card shadow login-card">
        <div class="card-body" style="padding: 1.5rem;">
          <div class="card-title border-bottom mb-4">
            <h3>Login</h3>
            <div class="mb-4"></div>
          </div>
          <div class="alert alert-danger error" :class="{'d-none' : !isIncorrect}" role="alert">
            <strong>Erorr!</strong> {{ message }}
          </div>
          <LoginComponent @errorLogin="errorLogin"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import LoginComponent from '../components/LoginComponent.vue'
export default {
  name: 'HomeView',
  components: {
    LoginComponent
  },
  setup() {
    const isIncorrect = ref(false)
    const message = ref('')

    const errorLogin = (errorMessage) => {
      isIncorrect.value = true
      message.value = errorMessage
    }
    
    return { isIncorrect, message, errorLogin }
  }
}
</script>

<style scoped>
@import '../assets/login.css';
</style>