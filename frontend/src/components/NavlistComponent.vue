<template>
<div class="container-fluid">
  <a class="navbar-brand" href="#">E - Learning</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="navbar-nav me-auto mb-2 mb-lg-0"></div>
      <div class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Users</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu" aria-labelledby="accountDropdown">
              <li><a class="dropdown-item" href="#" @click="logout">Settings</a></li>
              <li><a class="dropdown-item" href="#" @click="logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'Navlist'
}
</script>

<style scoped>
.container-fluid {
  width: 90%;
}
</style>