<template>
  <loading v-model:active="isLoading" />
</template>

<script>
import Loading from 'vue-loading-overlay'
import 'vue-loading-overlay/dist/vue-loading.css'
import { ref } from 'vue'

export default {
  name: 'Loader',
  components: {
    Loading
  },
  setup() {
    const isLoading = ref(true)
    return { isLoading }
  }
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