<template>
  <div class="mt-4">
    <div class="card shadow lesson-card">
      <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list">
          <LessonsListComponent v-for="category in categories" :key="category.category_id" :category="category" />
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import LessonsListComponent from '../components/LessonsListComponent.vue'
import getCategory from '../composables/getCategory'
import commonService from '../composables/commonService'

export default {
  name: 'LessonsMainComponent',
  components: {
    LessonsListComponent
  },
  setup() {
    const { getCategoryWithQuestions, categoriesWithQuestion } = getCategory()
    const getCategories = getCategoryWithQuestions()
    const categories = categoriesWithQuestion
    
    return { categories }
  }
}
</script>

<style scoped>
.lesson-card {
  padding: 2em;
  width: 50rem;
  margin: auto;
  background: #2d3748;
}
.lesson-list {
  color: white;
  vertical-align: middle;
}
</style>