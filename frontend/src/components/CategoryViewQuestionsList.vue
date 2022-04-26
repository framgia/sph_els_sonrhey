<template>
  <div class="mt-4">
    <div class="card shadow category-view-card">
      <div class="card-body">
        <div class="category-view-list-main">
            <div class="container mt-3">
              <div class="category-view-list" v-for="question in questions" :key="question.question_id">
                <div class="card shadow mb-2 cat-view">
                  <div class="card-body">
                    <div class="container">
                      <div class="d-inline-flex p-2 bd-highlight">
                        <div class="category-view">
                          <div class="main-wrapper">   
                            <div class="sub-wrapper">
                              <p class=" mb-3"><span class="question">Question:</span> {{ question.description }}</p>
                              <p class=" mb-3" style="margin: 0 !important"><span class="answer">Answer:</span> {{ question.answer.choice.description }}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div> 
    </div>
  </div>
</template>

<script>
export default {
  name: 'CategoryViewQuestionsList',
  props: ['questions']
}
</script>

<style scoped>
.category-view-card {
  margin: auto;
  background: #2d3748;
}
.category-view-list {
  color: white;
  vertical-align: middle;
}
.cat-view {
  background: #1a202c;
}
h6, p {
  margin: 0;
}
.question, .answer {
  padding: 5px;
  background: #2d3748;
  border-radius: 5px;
}
</style>