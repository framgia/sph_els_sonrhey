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
                <div class="text-muted">Progress: (0 / {{ category.questions.length }})</div>
              </td>
              <td class="action">
                <button class="btn btn-primary" @click="takeQuiz(category)">Take Quiz</button>
              </td>
            </tr>
          </table>
        </div>
    </div> 
  </div>
</template>

<script>
import commonService from '../composables/commonService'
import { useRouter } from 'vue-router'

export default {
  name: 'LessonsListComponent',
  props: ['category'],
  setup() {
    const router = useRouter()
    const { settempStore } = commonService()

    const takeQuiz = (category) => {
      settempStore('category',category)
      router.push({path : '/answer' })
    }

    return { takeQuiz }
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