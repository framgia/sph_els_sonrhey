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
          <div class="alert alert-success alert-dismissible fade show" :class="[ alert_button ? '' : 'd-none']" role="alert">
            <strong>Success!</strong> User is followed successfuly!
            <button type="button" class="btn-close" :data-bs-dismiss="[!hide_alert ? '' : 'alert']" @click="close_alert" aria-label="Close"></button>
          </div>
          <div class="user-list">
              <UserListComponent v-for="user in user_list" :user="user" :key="user.user_id" @show="show"/>
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

export default {
  name: 'UserMainComponent',
  components: {
    UserListComponent
  },
  setup() {
    const csvc = commonService()
    const user_list = ref()
    const alert_button = ref(false)
    const hide_alert = ref(false)

    const close_alert = () => {
      hide_alert.value = !hide_alert.value
      alert_button.value = !alert_button.value
    }

    const show = (response) => {
      alert_button.value = !alert_button.value
    }

    const get_users = async () => {
      try {
        const get_user_list = await axios.get('http://localhost/api/user-list', {
        headers: {
            Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
        })
        const response = await get_user_list.data.data
        user_list.value = response
      } catch(e) {
      }
    }

    get_users()

    return { user_list, show, alert_button, close_alert, hide_alert }
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