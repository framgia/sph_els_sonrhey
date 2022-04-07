<template>
  <form @submit.prevent="submit">
    <div class="mt-2 mb-3">
      <label class="mb-3">Email Address</label>
      <input type="text" class="form-control form-control-lg" placeholder="your@email.com">
    </div>
    <div class="mb-4">
      <label class="mb-3">Password</label>
      <input type="password" class="form-control form-control-lg" placeholder="Enter your Password">
    </div>
    <div class="d-grid mb-4">
      <button type="submit" class="btn btn-primary btn-lg">Login</button>
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
export default {
  name: 'LoginComponent'
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