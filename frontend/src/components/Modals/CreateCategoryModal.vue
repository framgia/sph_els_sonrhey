<template>
  <div class="modal" tabindex="-1" id="category">
    <div class="modal-dialog">
      <div class="modal-content">
        <form @submit.prevent="create_category">
          <div class="modal-header">
            <h5 class="modal-title">Create Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control form-control-lg" id="title" placeholder="Category Title" v-model="title" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <input type="text" class="form-control form-control-lg" id="description" placeholder="Description" v-model="description" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue';
import commonService from '../../composables/commonService'
import config from '../../composables/config'

export default {
  name: 'CreateCategoryModal',
  setup(props, context) {
    const csvc = commonService()
    const { link } = config()
    const title = ref('')
    const description = ref('')

    const create_category = async () => {
      context.emit('actionLoader', true)

      const categoryIn = {
        "title" : title.value,
        "name" : description.value
      }

      try {
        const create = await axios.post(`${link}/api/create-category`, categoryIn , {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })

        const response = await create.data.data
        context.emit('actionLoader', false)
        csvc.message({
          title: "Success!",
          text: "Category Created Successfuly.",
          icon: 'success'
        })
      } catch(e) {
        console.error(e)
      }
    }

    return { title, description, create_category }

  }
}
</script>

<style scoped>
.modal {
  color: black
}
</style>