<template>
  <div class="card shadow mb-2 activity">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6><a href="/profile-visit" class="fw-bold">Chris Doe</a> completed the category <span class="fw-bold">All about Bisaya</span></h6>
                <p class="text-muted">3 days ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card shadow mb-2 activity">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6><a href="#" class="fw-bold">Chris Doe</a> completed the category <span class="fw-bold">All about English</span></h6>
                <p class="text-muted">3 days ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card shadow mb-2 activity">
    <div class="card-body">
      <div class="container">
        <div class="d-inline-flex p-2 bd-highlight">
          <div class="me-3">
            <div class="main-wrapper">
              <div class="sub-wrapper">
                <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="70">
              </div>
            </div>
          </div>
          <div class="user-activity">
            <div class="main-wrapper">   
              <div class="sub-wrapper">
                <h6><a href="#" class="fw-bold">Chris Doe</a> is now following you.</h6>
                <p class="text-muted">3 days ago</p>
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
  name: 'DashboardActivityListComponent'
}
</script>

<style scoped>
.activity {
  background: #1a202c;
}
h6, p {
  margin: 0;
}
</style>