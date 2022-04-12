<template>
  <div class="modal" tabindex="-1" id="question">
    <div class="modal-dialog">
      <div class="modal-content">
        <form @submit.prevent="submitQuestion">
          <div class="modal-header">
            <h5 class="modal-title">Create Question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Category</label>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected>Select Category</option>
                <option>Bisaya</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Question</label>
              <input type="text" class="form-control form-control-lg" id="description" placeholder="Question" v-model="questionFields.question" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Choices</label>
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" class="form-control form-control-lg" placeholder="Choice 1" v-model="questionFields.choices[0].choiceDescription">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control form-control-lg" placeholder="Choice 2" v-model="questionFields.choices[1].choiceDescription">
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <input type="text" class="form-control form-control-lg" placeholder="Choice 3" v-model="questionFields.choices[2].choiceDescription">
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control form-control-lg" placeholder="Choice 4" v-model="questionFields.choices[3].choiceDescription">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Answer</label>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" @change="selectAnswer">
                <option selected>Select Answer</option>
                <option v-for="choices in filteredChoices" :key="choices" :value="choices.letter">{{ choices.choiceDescription }}</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from '@vue/reactivity'
export default {
  name: 'CreateQuestionModal',
  computed: {
    filteredChoices(){
      const choices = this.questionFields.choices.filter(q => q.choiceDescription !== '')
      return choices
    }
  },
  setup() {
    const categoryList = ref()
    const answerList = ref()
    const questionFields = ref({
      question : '',
      choices: [
        {
          letter : "A",
          choiceDescription : ""
        },
        {
          letter : "B",
          choiceDescription : ""
        },
        {
          letter : "C",
          choiceDescription : ""
        },
        {
          letter : "D",
          choiceDescription : ""
        }
      ],
      answer: ''
    })

    const selectAnswer = (e) => {
      questionFields.value.answer = e.target.value
    }

    const submitQuestion = async () => {
      const questionsIn = {
        "category_id" : categoryList.category_id,
        "question" : questionFields.value.question,
        "choices" : questionFields.value.choices,
        "answer" : questionFields.value.answer
      }
    }

    return { questionFields, submitQuestion, selectAnswer }
  }
}
</script>

<style scoped>
.modal {
  color: black
}
</style>