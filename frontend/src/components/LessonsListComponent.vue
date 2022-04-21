<template>
  <div class="card shadow lesson-wrapper mb-3">
    <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list-wrapper">
          <table class="lesson">
            <tr>
              <td>
                <h4>{{ category.title }}</h4>
                <hr>
                <h6>{{ category.name }}</h6>
                <div class="text-muted">Progress: ({{ isUsed }} / {{ category.questions.length }})</div>
              </td>
              <td class="action">
                <button class="btn btn-success" v-if="quizStatus === 'CMP'"  data-bs-toggle="modal" data-bs-target="#resutsModal">View Result</button>
                <button class="btn btn-danger" @click="takeQuiz(category)" v-if="quizStatus === 'INP'">Continue Quiz</button>
                <button class="btn btn-primary" @click="takeQuiz(category)" v-if="quizStatus === 'DEF'">Take Quiz</button>
              </td>
            </tr>
          </table>
        </div>
    </div> 
  </div>
  <ResultsModal />
</template>

<script>
import commonService from '../composables/commonService'
import { useRouter } from 'vue-router'
import getCategory from '../composables/getCategory'
import { computed } from 'vue'
import ResultsModal from '../components/Modals/ResultModal.vue'
import getResults from '../composables/getResults'

export default {
  name: 'LessonsListComponent',
  props: ['category'],
  components: {
    ResultsModal
  },
  setup(props) {
    const router = useRouter()
    const { settempStore, getUserAndToken } = commonService()
    const { progress, quizProgressStatus } = getResults()
    const { getCategoriesUsed, categoriesUsed } = getCategory()
    
    const userId = JSON.parse(getUserAndToken('user')).user_id
    const getCategoryUsed = getCategoriesUsed(userId)
    
    const isUsed = computed (() => {
      const quizProgress = progress(categoriesUsed.value, props.category)
      return quizProgress
    })

    const quizStatus = computed(() => {
      const qStatus = quizProgressStatus(categoriesUsed.value, props.category)
      return qStatus
    })

    const takeQuiz = (category) => {
      settempStore('category',category)
      router.push({path : '/answer' })
    }

    return { takeQuiz, isUsed, quizStatus }
  }
}
</script>

<style scoped>
.border-style {
  height: 3rem;
  vertical-align: middle;
  border: 1px solid;
}
.lesson-wrapper {
  background: #1a202c;
}
.lesson {
  width: 100% !important;
}
.green {
  text-align: center;
  color: green;
}
.red {
  text-align: center;
  color: red;
}
.action {
  text-align: center;
  width: 10em;
}
</style>