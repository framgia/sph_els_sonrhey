<template>
  <div class="mt-4">
    <div class="card shadow answer-card">
      <div class="card-body">
        <div class="question-name border-bottom">
          <h3>{{ question.description }}</h3>
        </div>
        <div class="question-choices mt-4">
          <div class="choice mb-3" v-for="choice in question.choices" :key="choice.choice_id">
            <span v-if="!hasAnswer">
              {{ currentAns }}
            </span>
            <h5 @click="selectChoice(choice)" :class="{'clicked' : choice.choice_id == clickValue}">{{ choice.letter }} . {{ choice.description }}</h5>
          </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue'
import getAnswer from '../composables/getAnswer'
import commonService from '../composables/commonService'

export default {
  name: 'AnswerListComponent',
  props: ['question'],
  setup(props, context) {
    const categoryId = props.question.category_id
    const { getUserAndToken } = commonService()
    const { getUserAnswer, userAnswer } = getAnswer()
    const user_id = JSON.parse(getUserAndToken('user')).user_id
    const getCurrentAnswers = getUserAnswer(user_id)
    const clickValue = ref('')
    const hasAnswer = ref(false)
    const currentAns = computed(() => {
      if (userAnswer.value.length) {
        hasAnswer.value = true
        const currentQuestion = userAnswer.value.find(q => q.question_id === props.question.question_id)
        if (currentQuestion != undefined) {
          clickValue.value = currentQuestion.choice_id
          const currentChoice = props.question.choices.find(q => q.choice_id === currentQuestion.choice_id)
          const answer = {
            choice : currentChoice,
            category_id : categoryId
          }
          context.emit('answer', answer)
        }
      }
    })
    
    const selectChoice = (choice) => {
      clickValue.value = choice.choice_id
      const answer = {
        choice : choice,
        category_id : categoryId
      }
      context.emit('answer', answer)
    }

    return { selectChoice, clickValue, currentAns, hasAnswer }
  }
}
</script>

<style scoped>
.answer-card {
  padding: 1em;
  width: 50rem;
  margin: auto;
  background: #2d3748;
}
.choice.mb-3:hover {
  background: rgb(0 0 0 / 36%);
  cursor: pointer;
  transition: 1s;
}
.clicked {
  background: rgb(0 0 0 / 36%);
}
.choice.mb-3 > h5 {
  padding: 15px;
  margin: 0;
}
</style>