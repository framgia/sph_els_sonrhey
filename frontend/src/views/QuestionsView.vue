<template>
  <NavbarComponent />
  <QuestionsMainComponent />
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue'
import QuestionsMainComponent from '../components/QuestionMainComponent.vue'

export default {
  name: 'QuestionsView',
  components: {
    NavbarComponent,
    QuestionsMainComponent
  }
}
</script>

<style>

</style>