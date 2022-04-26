<template>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <category-view-name-component :category="category" />
      </div>
      <div class="col-md-7">
        <category-view-questions-list :questions="questions"/>
      </div>
    </div>
  </div>
</template>

<script>
import CategoryViewNameComponent from './CategoryViewNameComponent.vue'
import CategoryViewQuestionsList from './CategoryViewQuestionsList.vue'
import commonService from '../composables/commonService'

export default {
  name: 'CategoryViewMainComponent',
  components: { 
    CategoryViewNameComponent,
    CategoryViewQuestionsList
  },
  setup() {
    const { getCategorySelected } = commonService()
    const categorySelected = getCategorySelected()
    const category = categorySelected
    const questions = category.questions

    return { category, questions }
  }
}
</script>

<style>

</style>