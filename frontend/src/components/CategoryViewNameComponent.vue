<template>
  <div class="mt-4">
    <div class="card shadow category-view-card">
      <div class="card-body">
        <div class="category-view-list">
          <div class="main-wrapper">
            <div class="sub-wrapper p-3">
              <h3>{{ category.title }}</h3>
              <h6 class="text-muted">{{ category.name }}</h6>
            </div>
          </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
export default {
  name: 'CategoryViewNameComponent',
  props: ['category']
}
</script>

<style scoped>
.category-view-card {
  margin: auto;
  background: #2d3748;
}
.dashboard-list {
  color: white;
  vertical-align: middle;
}
</style>