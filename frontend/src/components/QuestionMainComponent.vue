<template>
  <div class="mt-4">
    <div class="card shadow questions-card">
      <div class="card-body" style="padding: 1.5rem;">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#question">Create new Question</button>
        <div class="mb-4"></div>
        <div class="card-title mb-4 text-center">
          <div class="mb-3"></div>
          <div class="mb-4"></div>
          <div class="form-group mb-4">
            <table class="table table-bordered question-list">
              <thead class="border-style">
                <th>No</th>
                <th>Category</th>
                <th>Question</th>
                <th>Action</th>
              </thead>
              <tbody>
                <QuestionListComponent v-for="question in questionList" :key="question.question_id" :question="question" @actionLoader="actionLoader" />
                <tr v-if="!questionList.length">
                  <td colspan="4">{{ checkQuestions }}</td>
                </tr>
              </tbody>
            </table>
            <nav>
              <ul class="pagination" :class="{'d-none' : total <= paginationTotal}">
                <li class="page-item" :class="{'disabled' : page.active || page.url == null}" v-for="page in pages" :key="page.label"><a class="page-link" href="#" @click="nextQuestion(page.url)" v-html="page.label"></a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <CreateQuestionModal @actionLoader="actionLoader" />
  <EditQuestionModal @actionLoader="actionLoader" />
  <Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import CreateQuestionModal from '../components/Modals/CreateQuestionModal.vue'
import QuestionListComponent from '../components/QuestionListComponent.vue'
import getQuestions from '../composables/getQuestions'
import EditQuestionModal from '../components/Modals/EditQuestionModal.vue'
import Loader from '../components/LoadingComponent.vue'
import { ref, computed } from 'vue'
import commonService from '../composables/commonService'

export default {
  name: 'QuestionsMainComponent',
  components: {
    CreateQuestionModal,
    QuestionListComponent,
    EditQuestionModal,
    Loader
  },
  setup() {
    const isShowLoading = ref(false)
    const { paginationTotal } = commonService()
    const { fetchQuestions, questionList, isLoaded, pages, getNextQuestion, total } = getQuestions()

    const actionLoader = () => {
      isShowLoading.value = !isShowLoading.value
      if (!isShowLoading.value) {
        fetchQuestions()
        return
      }
    }

    const nextQuestion = async (url) => {
      isShowLoading.value = !isShowLoading.value
      const getNext = await getNextQuestion(url)
      if (isLoaded.value) {
        isShowLoading.value = !isShowLoading.value
      }
    }

    const fetch = fetchQuestions()

    const checkQuestions = computed(() => {
      if (isLoaded.value && !questionList.value.length) {
        return 'No questions yet.'
      }
      return 'Data still loading.'
    })
    
    return { questionList, isShowLoading, actionLoader, isLoaded, pages, nextQuestion, total, checkQuestions, paginationTotal } 
  }
}
</script>

<style scoped>
.questions-card {
  padding: 2em;
  width: 50rem;
  margin: auto;
  background: #2d3748;
}
.question-list {
  color: white;
  vertical-align: middle;
}
.border-style {
  height: 3rem;
  vertical-align: middle;
  border: 1px solid;
}
</style>