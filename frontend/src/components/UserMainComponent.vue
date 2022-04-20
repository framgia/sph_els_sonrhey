<template>
  <div class="mt-4">
    <div class="card shadow login-card">
      <div class="card-body" style="padding: 1.5rem;">
        <div class="card-title mb-4 text-center">
          <div class="mb-3"></div>
          <div class="mb-4"></div>
          <div class="form-group mb-4">
            <input type="text" class="form-control search-user" placeholder="Search User">
          </div>
          <div class="alert alert-success alert-dismissible fade show" :class="{'d-none' : !alertButton}" role="alert">
            <strong>Success!</strong> User {{ alertMessage }}
            <button type="button" class="btn-close" :data-bs-dismiss="{'alert' : !hideAlert}" @click="close_alert" aria-label="Close"></button>
          </div>
          <div class="user-list">
              <UserListComponent v-for="user in userList" :user="user" :key="user.user_id" @show="show"/>
          </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue';
import UserListComponent from '../components/UserListComponent.vue'
import commonService from '../composables/commonService'
import config from '../composables/config'

export default {
  name: 'UserMainComponent',
  components: {
    UserListComponent
  },
  setup() {
    const csvc = commonService()
    const { link } = config()
    const userList = ref()
    const alertButton = ref(false)
    const hideAlert = ref(false)
    const alertMessage = ref('')

    const close_alert = () => {
      hideAlert.value = !hideAlert.value
      alertButton.value = !alertButton.value
    }

    const show = (response) => {
      alertMessage.value = response
      alertButton.value = true
      get_users()
    }

    const get_users = async () => {
      try {
        const getUserList = await axios.get(`${link}/api/user-list`, {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        const response = await getUserList.data.data
        userList.value = response
      } catch(e) {
        console.error(e)
      }
    }

    get_users()

    return { userList, show, alertButton, close_alert, hideAlert, alertMessage }
  }
}
</script>

<style scoped>
.login-card {
  width: 35rem !important;
}
.user-list {
  color:white;
}
.search-user {
  background: #1a202c;
  padding: 10px;
  border: 2px solid #56c2ff;
  color: white;
}
</style>