<template>
  <div class="mt-4">
    <div class="card shadow answer-card">
      <div class="card-body">
        <div class="question-name border-bottom">
          <h3>{{ question.description }}</h3>
        </div>
        <div class="question-choices mt-4">
          <div class="choice mb-3" v-for="choice in question.choices" :key="choice.choice_id">
            <h5 @click="selectChoice(choice)" :class="{'clicked' : choice.choice_id == clickValue}">{{ choice.letter }} . {{ choice.description }}</h5>
          </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'

export default {
  name: 'AnswerListComponent',
  props: ['question'],
  setup(props, context) {
    const categoryId = props.question.category_id
    const clickValue = ref('')
    const selectChoice = (choice) => {
      clickValue.value = choice.choice_id
      const answer = {
        choice : choice,
        category_id : categoryId
      }
      context.emit('answer', answer)
    }

    return { selectChoice, clickValue }
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