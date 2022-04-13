<template>
  <div class="modal" tabindex="-1" id="edit_category">
    <div class="modal-dialog">
      <div class="modal-content">
        <form @submit.prevent="editCategory">
          <div class="modal-header">
            <h5 class="modal-title">Edit Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control form-control-lg" id="title" @change="title_changed" placeholder="Category Title" v-model="category.title">
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <input type="text" class="form-control form-control-lg" id="description" @change="name" placeholder="Description" v-model="category.name" required>
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
import { ref, computed } from 'vue';
import commonService from '../../composables/commonService'
import store from '@/store';
import { useStore } from 'vuex';
import config from '../../composables/config'

export default {
  name: 'CreateCategoryModal',
  setup() {
    const csvc = commonService()
    const { link } = config()
    const category = ref(computed(() => store.state.category))

    const editCategory = async () => {
      const categoryIn = {
        "category_id" : category.value.category_id,
        "title" : category.value.title,
        "name" : category.value.name
      }

      try {
        const edit = await axios.post(`${link}/api/edit-category`, categoryIn , {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })

        const response = await edit.data.data
        location.reload()
        
      } catch(e) {
        console.error(e)
      }
    }

    return { editCategory, category }

  }
}
</script>

<style scoped>
.modal {
  color: black
}
</style>