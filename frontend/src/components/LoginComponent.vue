<template>
  <form @submit.prevent="submit">
    <div class="mt-2 mb-3">
      <label class="mb-3">Email Address</label>
      <input type="text" class="form-control form-control-lg" placeholder="your@email.com" v-model="email">
    </div>
    <div class="mb-4">
      <label class="mb-3">Password</label>
      <input type="password" class="form-control form-control-lg" placeholder="Enter your Password" v-model="password">
    </div>
    <div class="d-grid mb-4">
      <button type="submit" class="btn btn-primary btn-lg" :disabled="isLoading">
        <span v-if="isLoading">Logging in ...</span>
        <span v-else>Login</span>
      </button>
    </div>
    <div class="d-grid mb-3 text-center">
      <a href="#" class="text-muted">Forgot Password?</a>
    </div>
    <div class="d-grid mb-3 text-center">
      <span class="text-muted">New here? <router-link to="/signup">Sign up</router-link></span>
    </div>
  </form>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import commonService from '../composables/commonService'
import config from '../composables/config'

export default {
  name: 'LoginComponent',
  setup() {
    const csvc = commonService()
    const { link } = config()
    const router = useRouter()
    const { link } = config()
    const email = ref("")
    const password = ref("")
    const isLoading = ref(false)

    const submit = async () => {
      isLoading.value = true

      const formSubmit = {
        "email_address" : email.value,
        "password" : password.value
      }

      const submitRequest = await axios.post(`${link}/api/login`, formSubmit)
      const response = await submitRequest.data

      if (response.status_code === 1) {
          csvc.setUserAndToken(response.data.user, response.data.token)
          router.push({ path : '/dashboard' })
      }

      isLoading.value = false
    }

    return { email, password, submit, isLoading }
  }
}
</script>

<style scoped>
input, button {
  border-radius: 0;
}

button {
  background: #6c63ff;
}
</style>