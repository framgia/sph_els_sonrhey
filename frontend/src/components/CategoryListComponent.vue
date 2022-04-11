<template>
  <tr>
    <td>{{ category.category_id }}</td>
    <td>{{ category.title }}</td>
    <td>{{ category.name }}</td>
    <td>N/A</td>
    <td>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-warning" @click="edit_category(category)" data-bs-toggle="modal" data-bs-target="#edit_category"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-danger" @click="delete_category(category)"><i class="fa fa-trash"></i></button>
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

    const edit_category = (category) => {
      store.commit('set_category', category)
    }
    
    const delete_category = async (category) => {
      const category_in = {
        "category_id" : category.category_id,
      }

      try {
        const delete_cat = await axios.post('http://localhost/api/delete-category', category_in , {
        headers: {
            Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
        })

        const response = await delete_cat.data.data
        location.reload()
        
      } catch(e) {
        console.log(e)
      }
    }

    return { edit_category, delete_category }
  }
}
</script>

<style>

</style>