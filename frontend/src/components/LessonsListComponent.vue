<template>
  <div class="card shadow lesson-wrapper mb-3">
    <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list-wrapper">
          <table class="lesson">
            <tr>
              <td>
                <h4>Bisaya Category</h4>
                <hr>
                <h6>A good way to learn bisaya words</h6>
                <div class="text-muted">Progress: (12 / 20)</div>
              </td>
              <td class="action">
                <router-link class="btn btn-warning" to="/answer">Continue Quiz</router-link>
              </td>
            </tr>
          </table>
        </div>
    </div> 
  </div>
  <div class="card shadow lesson-wrapper mb-3">
    <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list-wrapper">
          <table class="lesson">
            <tr>
              <td>
                <h4>English Category</h4>
                <hr>
                <h6>A good way to learn bisaya words</h6>
                <div class="text-muted">Progress: (20 / 20)</div>
              </td>
              <td class="action">
                <div class="lesson-status">
                  <h3 class="green">PASS</h3>
                </div>
              </td>
            </tr>
          </table>
        </div>
    </div> 
  </div>
  <div class="card shadow lesson-wrapper mb-3">
    <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list-wrapper">
          <table class="lesson">
            <tr>
              <td>
                <h4>Tagalog Category</h4>
                <hr>
                <h6>A good way to learn bisaya words</h6>
                <div class="text-muted">Progress: (20 / 20)</div>
              </td>
              <td class="action">
                <div class="lesson-status">
                  <h3 class="red">FAIL</h3>
                </div>
              </td>
            </tr>
          </table>
        </div>
    </div> 
  </div>
  <div class="card shadow lesson-wrapper mb-3">
    <div class="card-body" style="padding: 1.5rem;">
        <div class="lesson-list-wrapper">
          <table class="lesson">
            <tr>
              <td>
                <h4>TagLish Category</h4>
                <hr>
                <h6>A good way to learn bisaya words</h6>
                <div class="text-muted">Progress: (0 / 20)</div>
              </td>
              <td class="action">
                <router-link class="btn btn-primary" to="/answer">Take Quiz</router-link>
              </td>
            </tr>
          </table>
        </div>
    </div> 
  </div>
</template>

<script>
export default {
  name: 'LessonsListComponent'
}
</script>

<style scoped>
.border-style {
  height: 3rem;
  vertical-align: middle;
  border: 1px solid;
}
.lesson-wrapper {
  background: #1a202c;
}
.lesson {
  width: 100% !important;
}
.green {
  text-align: center;
  color: green;
}
.red {
  text-align: center;
  color: red;
}
.action {
  text-align: center;
  width: 10em;
}
</style>