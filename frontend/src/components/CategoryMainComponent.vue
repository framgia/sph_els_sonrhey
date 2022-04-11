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
                <th>Action</th>
              </thead>
              <tbody>
                <CategoryListComponent />
              </tbody>
            </table>
          </div>
        </div>
      </div> 
    </div>
  </div>
  <CreateCategoryModal />
</template>

<script>
import CategoryListComponent from '../components/CategoryListComponent.vue'
import CreateCategoryModal from '../components/Modals/CreateCategoryModal.vue'

export default {
  name: 'CategoryMainComponent',
  components: {
    CategoryListComponent,
    CreateCategoryModal
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
  height: 15rem;
  color: white;
  vertical-align: middle;
}
.border-style {
  height: 3rem;
  vertical-align: middle;
  border: 1px solid;
}
</style>