<template>
   <div class="modal" tabindex="-1" ref="res" id="questionsModal" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Questions</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered text-center">
            <thead>
              <th>Questions</th>
            </thead>
            <tbody>
              <tr v-for="question in questions" :key="question.question_id">
                <td>{{ question.description }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, watchEffect } from 'vue'
import store from '@/store';

export default {
  name: 'QuestionModal',
  setup(props) {
    const questions = ref();
    watchEffect(() => {
      const quest = store.state.question
      if (quest.length) {
        questions.value = quest
      }
    })
    return { questions }
  }
}
</script>

<style>

</style>