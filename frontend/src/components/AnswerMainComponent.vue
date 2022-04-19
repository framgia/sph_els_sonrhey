<template>
  <AnswerListComponent v-for="question in questions" :key="question.question_id" :question="question" @answer="answer"/>
  <div class="mt-4 text-center position">
    <button class="btn btn-primary center-block btn-lg" type="button" @click="submitAnswer">Submit</button>
  </div>
  <Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import axios from 'axios'
import store from '@/store'
import { ref } from 'vue'
import AnswerListComponent from '../components/AnswerListComponent.vue'
import commonService from '../composables/commonService'
import config from '../composables/config'
import Loader from '../components/LoadingComponent.vue'
import { useRouter } from 'vue-router'

export default {
  name: 'AnswerMainComponent',
  components: {
    AnswerListComponent,
    Loader
  },
  setup() {
    const { getTempStore, getUserAndToken, message } = commonService()
    const { link } = config()
    const router = useRouter()
    const questions = ref(JSON.parse(getTempStore('category')).questions)
    const answerValues = ref([])
    const categoryId = ref()
    const questionId = ref()
    const isShowLoading = ref(false)

    const actionLoader = () => {
      isShowLoading.value = !isShowLoading.value
      if (!isShowLoading.value) {
        return
      }
    }

    const answer = (answer) => {
      categoryId.value = answer.category_id
      const choice = answer.choice
      questionId.value = choice.question_id

      const filter = answerValues.value.find(q => q.question_id === choice.question_id && q.choice_id === choice.choice_id)
      if (!filter) {
        const lastIndex = answerValues.value.findIndex(q => q.question_id === choice.question_id)

        if (lastIndex !== -1) {
          answerValues.value[lastIndex].choice_id = choice.choice_id
          return
        } 

        answerValues.value.push({
          category_id : answer.category_id,
          question_id : choice.question_id,
          choice_id : choice.choice_id
        })
      }
    }

    const submitAnswer = async () => {
      actionLoader()
      try {
        const submitRequest = {
            category_id : categoryId.value,
            current_question_id : questionId.value,
            progress : answerValues.value
        }

        const answerData = await axios.post(`${link}/api/create-answer`, submitRequest, {
          headers: {
              Authorization: `Bearer ${getUserAndToken('token')}`
          }
        })
        const response = await answerData.data.data
        actionLoader()
        message({
          title: "Success!",
          text: "Answer Submitted Successfuly.",
          icon: 'success'
        })
        router.push({ path: '/lessons' })
      } catch(e) {
        console.error(e)
      }
    }
    return { questions, submitAnswer, answer, isShowLoading, actionLoader }
  }
}
</script>

<style scoped>
.position {
  height: 5em;
}
</style>