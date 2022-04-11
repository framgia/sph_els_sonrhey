<template>
  <tr>
    <td>{{ category.category_id }}</td>
    <td>{{ category.title }}</td>
    <td>{{ category.name }}</td>
    <td>N/A</td>
    <td>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-warning" @click="editCategory(category)" data-bs-toggle="modal" data-bs-target="#edit_category"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger" @click="deleteCategory(category)"><i class="fa fa-trash"></i></button>
      </div>
    </td>
  </tr>
</template>

<script>
import axios from 'axios'
import store from '@/store'
import commonService from '../composables/commonService'

export default {
  name: 'CategoryListComponent',
  props: ['category'],
  setup(props) {
    const csvc = commonService()

    const editCategory = (category) => {
      store.commit('set_category', category)
    }
    
    const deleteCategory = async (category) => {
      const categoryIn = {
        "category_id" : category.category_id,
      }

      try {
        const deleteCat = await axios.post('http://localhost/api/delete-category', categoryIn , {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })

        const response = await deleteCat.data.data
        location.reload()
        
      } catch(e) {
        console.error(e)
      }
    }

    return { editCategory, deleteCategory }
  }
}
</script>

<style>

</style>