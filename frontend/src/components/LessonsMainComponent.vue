<template>
  <div class="mt-4">
    <div class="card shadow lesson-card">
      <div class="card-body" style="padding: 1.5rem;">   
        <div class="col-md-4 mb-3" v-if="categories.length">
          <h5>Filter by Status</h5>
          <select class="form-select" aria-label="Default select example" @change="selectStatus">
            <option :value="completed">Completed</option>
            <option :value="inProgress">In Progress</option>
            <option :value="defaultStatus">Unused</option>
            <option :value="displayAll" selected>All</option>
          </select>
        </div>
        <div class="lesson-list">
          <LessonsListComponent v-for="category in categories" :key="category.category_id" :category="category" />
        </div>
        <div class="m4-3 text-center" v-if="!categories.length">
          {{ checkLessons }}
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import LessonsListComponent from '../components/LessonsListComponent.vue'
import getCategory from '../composables/getCategory'
import commonService from '../composables/commonService'
import quizStatuses from '../composables/quizStatuses'
import { ref, watchEffect, computed } from 'vue'

export default {
  name: 'LessonsMainComponent',
  components: {
    LessonsListComponent
  },
  setup() {
    const { getUserAndToken } = commonService()
    const { getCategoryWithQuestions, categoriesWithQuestion, getCategoriesUsed, categoriesUsed, isLoaded, filterUsedCategory, filterUnusedCategory } = getCategory()
    const { defaultStatus, inProgress, completed, displayAll } = quizStatuses()
    const userId = JSON.parse(getUserAndToken('user')).user_id
    const getCategories = getCategoryWithQuestions()
    const getCatUsed = getCategoriesUsed(userId)
    const categories = ref([])

    watchEffect(() => {
      if (isLoaded.value) {
        categories.value = categoriesWithQuestion.value
      }
    })

    const selectStatus = (e) => {
      if (e.target.value === defaultStatus) {
        const categoryList = categoriesUsed.value
        categories.value = filterUnusedCategory(categoriesWithQuestion.value, categoryList)
      } else if (e.target.value === displayAll) {
        categories.value = categoriesWithQuestion.value
      } else {
        const categoryList = categoriesUsed.value.filter(q => q.status.code === e.target.value)
        categories.value = filterUsedCategory(categoriesWithQuestion.value, categoryList)
      }
    }

    const checkLessons = computed(() => {
      if (isLoaded.value && !categories.value.length) {
        return 'No lessons available.'
      }
      return 'Data still loading.'
    })

    return { categories, defaultStatus, inProgress, completed, selectStatus, displayAll, checkLessons }
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