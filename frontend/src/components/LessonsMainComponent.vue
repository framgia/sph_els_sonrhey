<template>
  <div class="mt-4">
    <div class="card shadow lesson-card">
      <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list">
          <LessonsListComponent />
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
import LessonsListComponent from '../components/LessonsListComponent.vue'
export default {
  name: 'LessonsMainComponent',
  components: {
    LessonsListComponent
  }
}
</script>

<style scoped>
.lesson-card {
  padding: 2em;
  width: 50rem;
  margin: auto;
  background: #2d3748;
}
.lesson-list {
  color: white;
  vertical-align: middle;
}
</style>