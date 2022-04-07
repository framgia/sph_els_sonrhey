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
              <label class="mb-3">Full Name</label>
              <input type="email" class="form-control form-control-lg" placeholder="your@email.com" disabled :value=user.full_name>
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-4">
              <label class="mb-3">Email Address</label>
              <input type="email" class="form-control form-control-lg" placeholder="your@email.com" disabled :value=user.email_address>
            </div>
          </div>
        </div>
        <div class="mb-4">
          <label class="mb-3">Password</label>
          <input type="password" class="form-control form-control-lg" placeholder="your@email.com" disabled value="*********">
        </div>
        <div class="mb-4">
          <label for="formFile" class="form-label">Update Avatar</label>
          <input class="form-control" type="file" id="formFile" :onChange="pickImage" disabled>
        </div>
        <div class="d-grid mb-4">
          <button type="submit" class="btn btn-danger btn-lg">Edit Info</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import commonService from '../composables/commonService'

export default {
  name: 'ProfileComponent',
  setup() {
    const csvc = commonService();
    const user = JSON.parse(csvc.getUserAndToken('user'));
    
    return { user }
  }
}
</script>

<style scoped>
.card.shadow.login-card {
  width: 40rem;
}
</style>