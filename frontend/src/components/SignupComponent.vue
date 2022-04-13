<template>
  <form @submit.prevent="submit">
    <div class="row">
      <div class="col-md-6">
        <div class="mt-2 mb-3">
          <label class="mb-3">Full Name</label>
          <input type="text" class="form-control form-control-lg" placeholder="John Doe" v-model="full_name" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mt-2 mb-3">
          <label class="mb-3">Email Address</label>
          <input type="email" class="form-control form-control-lg" placeholder="your@email.com" v-model="email_address" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="mb-4">
          <label class="mb-3">Password</label>
          <input type="password" class="form-control form-control-lg" placeholder="Enter your Password" v-model="password" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-4">
          <label class="mb-3">Confirm Password</label>
          <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" v-model="c_password" required>
          <span v-if="password !== c_password" style="color:red">Password Don't match!</span>
        </div>
      </div>
    </div>
    <div class="mb-4">
      <label for="formFile" class="form-label">Upload Avatar</label>
      <input class="form-control" type="file" id="formFile" :onChange="pickImage">
    </div>
    <div class="d-grid mb-4">
      <button type="submit" class="btn btn-primary btn-lg">Register Now</button>
    </div>
    <div class="d-grid mb-3 text-center">
      <span class="text-muted">Already have an account? <router-link to="/">Login</router-link></span>
    </div>
  </form>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import commonService from '../composables/commonService'
import getHeaders from '../composables/headers'
import config from '../composables/config'

export default {
  name: 'SignupComponent',
  setup() {
    const csvc = commonService()
    const headers = getHeaders()
    const router = useRouter()
    const { link } = config()
    const full_name = ref("")
    const email_address = ref("")
    const password = ref("")
    const c_password = ref("")
    const image = ref("")

    const pickImage = async(e) => {
      image.value = e.target.files[0]
    }

    const submit = async() => {
      const formData = new FormData();
      formData.append('full_name', full_name.value)
      formData.append('email_address', email_address.value)
      formData.append('password', password.value)
      formData.append('image', image.value)

      const submitRequest = await axios.post(`${link}/api/register`, formData, headers)
      const response = await submitRequest.data
      if (response.status_code === 1) {
          csvc.setUserAndToken(response.data.user, response.data.token)
          router.push({ path : '/dashboard' })
      }
    }

    return { full_name, email_address, password, c_password, image, submit, pickImage }
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