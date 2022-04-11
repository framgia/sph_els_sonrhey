<template>
  <div class="mt-4">
    <div class="card shadow login-card">
      <div class="card-body" style="padding: 1.5rem;">
        <div class="card-title border-bottom mb-4 text-center">
          <img :src="'http://'+user.avatar" width="200" style="border-radius: 10em;">
          <div class="mb-3"></div>
          <div class="mb-4"></div>
        </div>
        <div class="row">
          <div class="col-md  -6">
            <div class="mb-4">
              <label class="mb-3">Full Name <a href="#" class="fa fa-edit" :class="[inputsState ? 'd-none' : '']" @click="editInputs('full_name')"></a></label>
              <input type="email" class="form-control form-control-lg" placeholder="your@email.com" ref="full_name" v-model="user.full_name" disabled>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="mb-3">Email Address <a href="#" class="fa fa-edit" :class="[inputsState ? 'd-none' : '']" @click="editInputs('email_address')"></a></label>
              <input type="email" class="form-control form-control-lg" placeholder="your@email.com" ref="email_address" v-model="user.email_address" disabled>
            </div>
          </div>
        </div>
        <div class="mb-4">
          <label class="mb-3">Password <a href="#" class="fa fa-edit" :class="[inputsState ? 'd-none' : '']" @click="editInputs('password')"></a></label>
          <input type="password" class="form-control form-control-lg" ref="password"  value="**********" disabled>
          <span style="color:red" v-if="errorMessage">{{ errorMessage }}</span>
        </div>
        <div class="row" :class="[!editPassword ? 'd-none' : '', inputsState ? 'd-none' : '' ]">
          <div class="col-md-6">
            <div class="mb-4">
              <label class="mb-3">New Password</label>
              <input type="password" class="form-control form-control-lg" v-model="new_password">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="mb-3">Confirm New Password</label>
              <input type="password" class="form-control form-control-lg" v-model="c_password">
            </div>
          </div>
        </div>
        <div class="mb-4">
          <label for="formFile" class="form-label">Update Avatar <a href="#" class="fa fa-edit" :class="[inputsState ? 'd-none' : '']" @click="editInputs('avatar')"></a></label>
          <input class="form-control" type="file" id="formFile" ref="avatar" :onChange="pickImage" disabled>
        </div>
        <div class="d-grid mb-4">
          <button type="submit" class="btn btn-danger btn-lg"  @click="editInfo" :class="[buttonState ? 'd-none' : '']">
            <span v-if="inputsState">Edit Info</span>
            <span v-else>Cancel Edit</span>
          </button>
        </div>
        <div class="d-grid mb-4">
          <button type="submit" class="btn btn-primary btn-lg" :class="[inputsState ? 'd-none' : '']" @click="updateInfo" :disabled="buttonState">
            <span v-if="!buttonState">Update Info</span>
            <span v-else>Updating Profile please wait ...</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue';
import commonService from '../composables/commonService'
import editedField from '../composables/editedFields'
import profileService from '../composables/profileService'

export default {
  name: 'ProfileComponent',
  setup() {
    const csvc = commonService()
    const psvc = profileService()

    const inputsState = ref(true)
    const editPassword = ref(false)
    const buttonState = ref(false)
    const user = JSON.parse(csvc.getUserAndToken('user'))

    const full_name = ref('')
    const email_address = ref('')
    const password = ref('')
    const avatar = ref('')
    const new_password = ref('')
    const c_password = ref('')
    const errorMessage = ref('')

    const editInfo = () => psvc.editInfo(inputsState, errorMessage)

    const editInputs = (value) => {
      const input = eval(value).value
      if (value === 'password') {
        editPassword.value = !editPassword.value
        errorMessage.value = ''
      }
      input.disabled = !input.disabled
      input.focus()
    }

    const pickImage = (e) => {
      avatar.value = e.target.files[0]
    }

    const updateInfo = async () => {
      buttonState.value = true

      const inputStatus = { 
        'full_name' : !full_name.value.disabled,
        'email_address' : !email_address.value.disabled,
        'password' : !password.value.disabled,
        'image' : !avatar.value.disabled
      }

      const inputValues = {
        'full_name' : full_name.value.value,
        'email_address' : email_address.value.value,
        'password' : password.value.value,
        'new_password' : new_password.value,
        'image' : null
      }

      const data = editedField(inputStatus, inputValues)
      const formData = new FormData()
      formData.append('fields', JSON.stringify(data))
      formData.append('image', avatar.value)

      try {
        const submitRequest = await axios.post('http://localhost/api/update-profile', formData, {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        const response = await submitRequest.data
        if (response.status_code === 1) {
            csvc.updateUser(response.data)
            location.reload()
            return
        }
        errorMessage.value = response.data
      } catch(e) {
      }
    }
    
    return { user, inputsState, editPassword, full_name, editInfo, email_address, password, avatar, c_password, new_password, pickImage, editInputs, updateInfo, errorMessage, buttonState }
  }
}
</script>

<style scoped>
.card.shadow.login-card {
  width: 40rem;
}
</style>