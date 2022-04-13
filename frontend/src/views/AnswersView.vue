<template>
  <NavbarComponent />
  <AnswerMainComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import AnswerMainComponent from '../components/AnswerMainComponent.vue'

export default {
  name: 'AnswersView',
  components: {
    NavbarComponent,
    AnswerMainComponent
  }
}
</script>

<style>

</style>