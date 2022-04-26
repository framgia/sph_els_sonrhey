<template>
  <tr>
    <td>{{ category.category_id }}</td>
    <td>{{ category.title }}</td>
    <td>{{ category.name }}</td>
    <td>N/A</td>
    <td>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-warning" @click="editCategory(category)" data-bs-toggle="modal" data-bs-target="#edit_category"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-primary" @click="viewCategory(category)"><i class="fa fa-eye"></i></button>
        <button type="button" class="btn btn-danger" @click="deleteCategory(category)"><i class="fa fa-trash"></i></button>
      </div>
    </td>
  </tr>
  <QuestionModal/>
</template>

<script>
import axios from 'axios'
import store from '@/store'
import commonService from '../composables/commonService'
import config from '../composables/config'
import QuestionModal from '../components/Modals/QuestionsModal.vue'
import { ref } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

export default {
  name: 'CategoryListComponent',
  props: ['category'],
  emits: ['actionLoader'],
  components: {
    QuestionModal
  },
  setup(props, context) {
    const csvc = commonService()
    const store = useStore()
    const router = useRouter()
    const { link } = config()
    const questions = ref()

    const viewCategory = (category) => {
      csvc.setCategorySelected(category)
      const text = category.title.toLowerCase()
      const finalText = text.replace(/\s+/g, '-').toLowerCase()
      router.push({ path: `/category/${finalText}` })
    }

    const editCategory = (category) => {
      store.commit('setCategory', category)
    }
    
    const deleteCategory = async (category) => {
      context.emit('actionLoader', true)
      const categoryIn = {
        "category_id" : category.category_id,
      }

      try {
        const deleteCat = await axios.post(`${link}/api/delete-category`, categoryIn , {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })

        const response = await deleteCat.data.data
        context.emit('actionLoader', false)
        
        csvc.message({
          title: "Success!",
          text: "Category Deleted Successfuly.",
          icon: 'success'
        })
      } catch(e) {
        console.error(e)
      }
    }

    return { editCategory, deleteCategory, questions, viewCategory }
  }
}
</script>

<style>

</style>