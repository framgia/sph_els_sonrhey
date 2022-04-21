<template>
  <div class="modal" tabindex="-1" ref="res" id="resutsModal" data-backdrop="static">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Results</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h3 style="color: black" class="mb-3 text-center">{{ score }}</h3>
          <table class="table table-bordered text-center">
            <thead>
              <th>Questions</th>
              <th>Answer</th>
              <th>Your Answer</th>
              <th>Status</th>
            </thead>
            <tbody>
              <tr v-for="result in resultList" :key="result.u_answer_id">
                <td>{{ result.question.description }}</td>
                <td>{{ result.question.answer.choice.letter }}.) {{ result.question.answer.choice.description }}</td>
                <td>{{ result.choice.letter }}.) {{ result.choice.description }}</td>
                <td>
                  <span v-if="result.status.code === correct" style="color: red" class="fw-bold">{{ result.status.name }} <i class="fa fa-times"></i></span>
                  <span v-if="result.status.code === incorrect" style="color: green" class="fw-bold">{{ result.status.name }} <i class="fa fa-check"></i></span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" @click="close">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '@/store'
import { computed, ref, watch, watchEffect } from '@vue/runtime-core'
import statuses from '../../composables/answerStatuses'

export default {
  name: 'ResultsModal',
  methods: {
    close() {
      location.reload()
    }
  },
  setup(props) {
    const resultList = ref()
    const perfectScore = ref(0)
    const scoreGet = ref(0)
    const { correct, incorrect } = statuses()
    const score = computed(() => {
      if (resultList.value !== undefined) {
        perfectScore.value = resultList.value.length
        scoreGet.value = resultList.value.filter(q => q.status.code === correct)
        if (scoreGet.value.length === 0) {
          return `Sorry! You got ${scoreGet.value.length + " / " + perfectScore.value} in this Quiz!`
        }
        return `Congratulations! You got ${scoreGet.value.length + " / " + perfectScore.value} in this Quiz!`
      }
    })

    watchEffect(() => {
      const result = store.state.results
      if (result.length) {
        resultList.value = result
      } 
    })
    return { resultList, score, correct, incorrect }
  }
}
</script>

<style>

</style>