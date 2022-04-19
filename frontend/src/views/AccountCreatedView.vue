<template>
  <div class="main-wrapper">
    <div class="sub-wrapper">
      <div class="card shadow success-card">
        <div class="card-body" style="padding: 1.5rem;">
          <h1 class="fw-bold mb-4">Congratulations!</h1>
          <h3>Your account has been succesfully created.</h3> 
          <h4>Click <a href="/dashboard">continue</a> to proceed to your dashboard.</h4>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AccountCreatedView'
}
</script>

<style scoped>
.card.shadow.success-card {
  margin: auto;
  background: #2d3748 !important;
  text-align: center;
  padding: 6em;
}
</style>