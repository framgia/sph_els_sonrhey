<template>
  <form @submit.prevent="submit">
    <div class="row">
      <div class="col-md-6">
        <div class="mt-2 mb-3">
          <label class="mb-3">Full Name</label>
          <input type="text" class="form-control form-control-lg" placeholder="John Doe">
        </div>
      </div>
      <div class="col-md-6">
        <div class="mt-2 mb-3">
          <label class="mb-3">Email Address</label>
          <input type="text" class="form-control form-control-lg" placeholder="your@email.com">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="mb-4">
          <label class="mb-3">Password</label>
          <input type="password" class="form-control form-control-lg" placeholder="Enter your Password">
        </div>
      </div>
      <div class="col-md-6">
        <div class="mb-4">
          <label class="mb-3">Confirm Password</label>
          <input type="password" class="form-control form-control-lg" placeholder="Confirm Password">
        </div>
      </div>
    </div>
    <div class="mb-4">
      <label for="formFile" class="form-label">Upload Avatar</label>
      <input class="form-control" type="file" id="formFile">
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
export default {
  name: 'SignupComponent'
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