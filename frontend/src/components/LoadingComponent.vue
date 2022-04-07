<template>
<div class="loader">
  <div class="main-wrapper">
    <div class="sub-wrapper">
      <div class="d-flex justify-content-center">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  name: 'Loader'
}
</script>

<style scoped>
.loader {
  position: absolute;
  background: #0000005e;
  height: 100%;
  width: 100%;
  z-index: 9999999;
}
</style>