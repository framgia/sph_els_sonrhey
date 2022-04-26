<template>
  <div class="mt-4">
    <div class="card shadow category-card">
      <div class="card-body" style="padding: 1.5rem;">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#category">Create new Category</button>
        <div class="mb-4"></div>
        <div class="card-title mb-4 text-center">
          <div class="mb-3"></div>
          <div class="mb-4"></div>
          <div class="form-group mb-4">
            <table class="table table-bordered category-list">
              <thead class="border-style">
                <th>No</th>
                <th>Category Title</th>
                <th>Category Description</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody>
                <CategoryListComponent v-for="category in categoryList" :category="category" :key="category.category_id" @actionLoader="actionLoader"/>
                <tr v-if="!categoryList.length">
                  <td colspan="5">Data still loading ...</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <CreateCategoryModal @actionLoader="actionLoader"/>
  <EditCategoryModal @actionLoader="actionLoader"/>
  <Loader :class="{'d-none' : !isShowLoading}"/>
</template>

<script>
import axios from 'axios'
import { ref } from 'vue';
import commonService from '../composables/commonService'
import CategoryListComponent from '../components/CategoryListComponent.vue'
import CreateCategoryModal from '../components/Modals/CreateCategoryModal.vue'
import EditCategoryModal from '../components/Modals/EditCategoryModal.vue'
import config from '../composables/config'
import Loader from '../components/LoadingComponent.vue'

export default {
  name: 'CategoryMainComponent',
  components: {
    CategoryListComponent,
    CreateCategoryModal,
    EditCategoryModal,
    Loader
  },
  setup() {
    const isShowLoading = ref(false)
    const csvc = commonService()
    const categoryList = ref([])
    const { link } = config()
    
    const actionLoader = () => {
      isShowLoading.value = !isShowLoading.value
      if (!isShowLoading.value) {
        getCategories()
        return
      }
    }

    const getCategories = async () => {
      try {
        const categories = await axios.get(`${link}/api/get-category-with-questions`, {
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        const response = await categories.data.data
        categoryList.value = response
      } catch(e) {
        console.error(e)
      }
    }

    getCategories()

    return { categoryList, isShowLoading, actionLoader }
  }
}
</script>

<style scoped>
.category-card {
  padding: 2em;
  width: 60rem;
  margin: auto;
  background: #2d3748;
}
.category-list {
  color: white;
  vertical-align: middle;
}
.border-style {
  height: 3rem;
  vertical-align: middle;
  border: 1px solid;
}
</style>