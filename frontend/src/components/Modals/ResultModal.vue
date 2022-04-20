<template>
  <div class="modal" tabindex="-1" id="resutsModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Results</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h3 style="color: black" class="mb-3 text-center"><span class="fw-bold">Congratulations!</span> you got <span class="fw-bold">2 / 2 </span>in this Quiz!</h3>
          <table class="table table-bordered text-center">
            <thead>
              <th>Questions</th>
              <th>Answer</th>
              <th>Your Answer</th>
              <th>Status</th>
            </thead>
            <tbody>
              <tr>
                <td> What is the English of baso?</td>
                <td>A. Glass</td>
                <td>B. Steel</td>
                <td><span style="color: red" class="fw-bold">Incorrect</span></td>
              </tr>
              <tr>
                <td> What is the English of baso?</td>
                <td>A. Glass</td>
                <td>B. Steel</td>
                <td><span style="color: green" class="fw-bold">Correct</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ResultsModal'
}
</script>

<style>

</style>