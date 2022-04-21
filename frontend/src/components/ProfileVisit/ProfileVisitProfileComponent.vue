<template>
  <div class="mt-4">
    <div class="card shadow dashboard-card">
      <div class="card-body">
        <div class="dashboard-list">
          <div class="main-wrapper">
            <div class="sub-wrapper text-center">
                <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="200">
                <hr>
              <div>
                <h3 class="fw-bold">Chris Doe</h3>
                <h6 class="text-muted">Student</h6>
                <div class="mb-4"></div>
                <span class="badge bg-warning me-2 p-learned">10 followers</span>
                <span class="badge bg-primary p-finished">20 following</span>
              </div>
              <div class="mt-3 d-grid">
                <button class="btn btn-danger">Unfollow</button>
              </div>
              <div class="mt-3 d-grid">
                <span class="f-lessons">Finished 20 Lessons</span>
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
  name: 'ProfileVisitProfileComponent'
}
</script>

<style scoped>
.dashboard-card {
  margin: auto;
  background: #2d3748;
}
.dashboard-list {
  color: white;
  vertical-align: middle;
}
</style>