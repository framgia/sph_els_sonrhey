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
                  <td colspan="5">{{ checkCategories }}</td>
                </tr>
              </tbody>
            </table>
            <nav>
              <ul class="pagination" :class="{'d-none' : total <= paginationTotal}">
                <li class="page-item" :class="{'disabled' : page.active || page.url == null}" v-for="page in pages" :key="page.label"><a class="page-link" href="#" @click="nextCategory(page.url)" v-html="page.label"></a></li>
              </ul>
            </nav>
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
import { computed, ref } from 'vue';
import commonService from '../composables/commonService'
import CategoryListComponent from '../components/CategoryListComponent.vue'
import CreateCategoryModal from '../components/Modals/CreateCategoryModal.vue'
import EditCategoryModal from '../components/Modals/EditCategoryModal.vue'
import config from '../composables/config'
import Loader from '../components/LoadingComponent.vue'
import getCategory from '../composables/getCategory'

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
    const { nextCategoryWithQuestionsAnswer, pages, categoriesWithQuestion, isLoaded } = getCategory()
    const csvc = commonService()
    const categoryList = ref([])
    const { link } = config()
    const total = ref(0)
    const paginationTotal = csvc.paginationTotal
    
    const actionLoader = () => {
      isShowLoading.value = !isShowLoading.value
      if (!isShowLoading.value) {
        getCategories()
        return
      }
    }

    const getCategories = async () => {
      try {
        const categories = await axios.get(`${link}/api/get-category-with-questions-answer`, {
          headers: {
            Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        const response = await categories.data.data
        pages.value = response.links
        total.value = response.total
        categoryList.value = response.data
        isLoaded.value = true
      } catch(e) {
        console.error(e)
      }
    }

    const nextCategory = async (url) => {
      isShowLoading.value = !isShowLoading.value
      const getNextCat = await nextCategoryWithQuestionsAnswer(url)
      categoryList.value = categoriesWithQuestion.value
      isShowLoading.value = !isShowLoading.value
    }

    getCategories()

    const checkCategories = computed(() => {
      if (isLoaded.value && !categoryList.value.length) {
        return 'No categories yet.'
      }
      return 'Data still Loading.'
    })

    return { categoryList, isShowLoading, actionLoader, pages, nextCategory, checkCategories, total, paginationTotal }
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