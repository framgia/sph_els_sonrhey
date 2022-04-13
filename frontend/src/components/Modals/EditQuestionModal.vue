<template>
  <div class="modal" tabindex="-1" id="editQuestion">
    <div class="modal-dialog">
      <div class="modal-content">
        <form @submit.prevent="submitQuestion">
          <div class="modal-header">
            <h5 class="modal-title">Edit Question</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Category</label>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" @change="selectCategory">
                <option selected>Select Category</option>
                <option :selected="category.selected" v-for="category in selectedCat" :key="category.category_id" :value="category.category_id">{{ category.title }}</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Question</label>
              <input type="text" class="form-control form-control-lg" id="description" placeholder="Question" v-model="question.description" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Choices</label>
              <div class="mb-3" v-for="choice in question.choices" :key="choice.choice_id" >
                <input type="text" class="form-control form-control-lg" placeholder="Choice 1" v-model="choice.description">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Answer</label>
              <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" @change="selectAnswer">
                <option selected>Select Answer</option>
                <option v-for="choices in selectedAns" :selected="choices.selected" :key="choices" :value="choices.choice_id">{{ choices.description }}</option>
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
import axios from 'axios'
import commonService from '../../composables/commonService'
import getCategory from '../../composables/getCategory'
import getAnswer from '../../composables/getAnswer'
import store from '@/store'
import { ref, computed } from 'vue';

export default {
  name: 'EditQuestionModal',
  setup() {
    const csvc = commonService()
    const { answer } = getAnswer()
    const { categoriesList, fetchCategory, selectedCategory } = getCategory()
    let newCategoryId = ref()
    let newChoiceId = ref()
    const question = ref(computed(() => store.state.question))
    const selectedCat = ref(computed(() => selectedCategory(categoriesList.value)))
    const selectedAns = ref(computed(() => answer(question.value)))

    const fetch = fetchCategory()
    
    const selectCategory = (e) => {
      newCategoryId.value = e.target.value
    }

    const selectAnswer = (e) => {
      newChoiceId.value =  e.target.value
    }

    const submitQuestion = async () => {
      const questionsIn = {
        "question_id" : question.value.question_id,
        "category_id" : newCategoryId.value == undefined ? question.value.category.category_id : newCategoryId.value,
        "description" : question.value.description,
        "answer" : {
          "answer_id" : question.value.answer.answer_id,
          "choice_id" : newChoiceId.value == undefined ? question.value.answer.choice_id : newChoiceId.value
        },  
        "choices" : question.value.choices
      }

      try {
        const create = await axios.post('http://localhost/api/edit-question', questionsIn , {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })

        const response = await create.data.data
        location.reload()
        
      } catch(e) {
        console.error(e)
      }
    }

    return { submitQuestion, selectAnswer, categoriesList, selectCategory, question, selectedCat, selectedAns }
  }
}
</script>

<style scoped>
.modal {
  color: black
}
</style>