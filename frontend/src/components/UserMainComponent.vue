<template>
  <div class="mt-4">
    <div class="card shadow login-card">
      <div class="card-body" style="padding: 1.5rem;">
        <div class="card-title mb-4 text-center">
          <div class="mb-3"></div>
          <div class="mb-4"></div>
          <div class="form-group mb-4">
            <input type="text" class="form-control search-user" placeholder="Search User" @keyup="search">
          </div>
          <div class="alert alert-success alert-dismissible fade show" :class="{'d-none' : !alertButton}" role="alert">
            <strong>Success!</strong> User {{ alertMessage }}
            <button type="button" class="btn-close" :data-bs-dismiss="{'alert' : !hideAlert}" @click="close_alert" aria-label="Close"></button>
          </div>
          <div class="user-list">
            <UserListComponent v-for="user in userList" :user="user" :key="user.user_id" @show="show"/>
            <div v-if="!userList.length" class="mb-3">
              {{ checkUsers }}
            </div>
          </div>
          <nav>
            <ul class="pagination" :class="{'d-none' : total <= paginationTotal, 'd-none' : !userList.length}">
              <li class="page-item" :class="{'disabled' : page.active || page.url == null}" v-for="page in pages" :key="page.label"><a class="page-link" href="#" @click="next_users(page.url)" v-html="page.label"></a></li>
            </ul>
          </nav>
        </div>
      </div> 
    </div>
  </div>
  <Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import axios from 'axios'
import { ref, computed } from 'vue';
import UserListComponent from '../components/UserListComponent.vue'
import commonService from '../composables/commonService'
import config from '../composables/config'
import Loader from '../components/LoadingComponent.vue'

export default {
  name: 'UserMainComponent',
  components: {
    UserListComponent,
    Loader
  },
  setup() {
    const isShowLoading = ref(false)
    const csvc = commonService()
    const paginationTotal = csvc.paginationTotal
    const { link } = config()
    const userList = ref([])
    const alertButton = ref(false)
    const hideAlert = ref(false)
    const alertMessage = ref('')
    const oldUser = ref([])
    const pages = ref([])
    const isLoaded = ref(false)
    const total = ref(0)

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
        pages.value = response.links
        total.value = response.total
        oldUser.value = response.data
        userList.value = oldUser.value
        isLoaded.value = true
      } catch(e) {
        console.error(e)
      }
    }

    const next_users = async (url) => {
      isShowLoading.value = !isShowLoading.value
      try {
        const getUserList = await axios.get(`${link}/api/user-list${url}`, {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        const response = await getUserList.data.data
        pages.value = response.links
        oldUser.value = response.data
        userList.value = oldUser.value
        isShowLoading.value = !isShowLoading.value
      } catch(e) {
        console.error(e)
      }
    }

    get_users()

    const search = (e) => {
      userList.value = oldUser.value.filter(q => q.full_name.toLowerCase().includes(e.target.value.toLowerCase()))
    }

    const checkUsers = computed(() => {
      if (isLoaded.value && !userList.value.length) {
        return 'No users available.'
      }
      return 'Data still Loading.'
    })

    return { userList, show, alertButton, close_alert, hideAlert, alertMessage, search, pages, next_users, isShowLoading, paginationTotal, checkUsers, total }
  }
}
</script>

<style scoped>
.login-card {
  width: 45rem !important;
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