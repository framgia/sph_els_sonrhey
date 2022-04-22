<template>
<div class="container-fluid">
  <a class="navbar-brand" href="/dashboard">E - Learning</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="navbar-nav me-auto mb-2 mb-lg-0"></div>
      <div class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/lessons">Lessons</a>
          </li>
          <li class="nav-item" v-if="isAdmin">
            <a class="nav-link" aria-current="page" href="/category">Categories</a>
          </li>
          <li class="nav-item" v-if="isAdmin">
            <a class="nav-link" aria-current="page" href="/questions">Questions</a>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" aria-current="page" to="/users">Users</router-link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
              <li><router-link class="dropdown-item" to="/profile">Profile</router-link></li>
              <li><a class="dropdown-item" href="#" @click="logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
  </div>
</div>
</template>

<script>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router'
import commonService from '../composables/commonService'

export default {
  name: 'Navlist',
  setup() {
    const router = useRouter()
    const csvc = commonService()
    const user = JSON.parse(csvc.getUserAndToken('user'))
    const isAdmin = ref(computed(() => {
      if (user.role.code === 'SA') {
        return true
      }
      return false
    }))
    const logout = () => {
      csvc.removeUserAndToken()
      router.push('/')
    }

    return { logout, user, isAdmin }
  }
}
</script>

<style scoped>
.container-fluid {
  width: 90%;
}
</style>