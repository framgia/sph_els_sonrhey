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
                <button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#resutsModal" @click="actionViewResult(category)" v-if="quizStatus === completed">View Result</button>
                <button class="btn btn-danger" @click="takeQuiz(category)" v-if="quizStatus === inProgress">Continue Quiz</button>
                <button class="btn btn-primary" @click="takeQuiz(category)" v-if="quizStatus === defaultStatus">Take Quiz</button>
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
import getAnswer from '../composables/getAnswer'
import { useStore } from 'vuex'
import store from '@/store'
import statuses from '../composables/quizStatuses'

export default {
  name: 'LessonsListComponent',
  props: ['category'],
  components: {
    ResultsModal
  },
  setup(props) {
    const router = useRouter()
    const stored = useStore()
    const { settempStore, getUserAndToken } = commonService()
    const { progress, quizProgressStatus } = getResults()
    const { getCategoriesUsed, categoriesUsed, isLoaded } = getCategory()
    const { viewResult, results } = getAnswer()
    const { completed, inProgress, defaultStatus } = statuses()
    
    const userId = JSON.parse(getUserAndToken('user')).user_id
    const getCategoryUsed = getCategoriesUsed(userId)

    const actionViewResult = (category) => {
      const request = {
        "user_id" : userId,
        "category_id" : category.category_id
      }
      viewResult(request)
      stored.commit('setResults', results)
    }
    
    const isUsed = computed (() => {
      const quizProgress = progress(categoriesUsed.value, props.category, isLoaded.value)
      return quizProgress
    })

    const quizStatus = computed(() => {
      const qStatus = quizProgressStatus(categoriesUsed.value, props.category, isLoaded.value)
      return qStatus
    })

    const takeQuiz = (category) => {
      settempStore('category',category)
      router.push({path : '/answer' })
    }

    return { takeQuiz, isUsed, quizStatus, actionViewResult, completed, inProgress, defaultStatus }
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