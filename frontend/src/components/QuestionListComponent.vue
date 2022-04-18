<template>
  <tr>
    <td>{{ question.question_id }}</td>
    <td>{{ question.category.title }}</td>
    <td>{{ question.description }}</td>
    <td>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-warning" @click="editQuestion(question)" data-bs-toggle="modal" data-bs-target="#editQuestion"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger" @click="deleteQuestion(question)"><i class="fa fa-trash"></i></button>
      </div>
    </td>
  </tr>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue'
import commonService from '../composables/commonService'
import config from '../composables/config'
import store from '@/store'

export default {
  name: 'QuestionListComponent',
  props: ['question'],
  setup() {
    const csvc = commonService()
    const { link } = config()

    const editQuestion = (question) => {
      store.commit('setQuestion', question)
    }
    
    const deleteQuestion = async (question) => {
      const questionIn = {
        "question_id" : question.question_id,
      }

      try {
        const deleteQ = await axios.post(`${link}/api/delete-question`, questionIn , {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })

        const response = await deleteQ.data.data
        location.reload()
        
      } catch(e) {
        console.error(e)
      }
    }

    return { deleteQuestion, editQuestion }
  }
}
</script>

<style>

</style>