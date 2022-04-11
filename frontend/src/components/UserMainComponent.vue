<template>
  <div class="mt-4">
    <div class="card shadow login-card">
      <div class="card-body" style="padding: 1.5rem;">
        <div class="card-title mb-4 text-center">
          <div class="mb-3"></div>
          <div class="mb-4"></div>
          <div class="form-group mb-4">
            <input type="text" class="form-control search-user" placeholder="Search User">
          </div>
          <div class="user-list">
            <div class="card shadow mb-3" style="background: #1a202c">
              <div class="card-body">
                <div class="user-wrapper-container">
                  <div class="user-wrapper">
                    <table>
                      <tbody>
                        <tr>
                          <td>
                            <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="70">
                          </td>
                          <td style="width: 3em">
                          </td>
                          <td style="text-align: left; width: 30em">
                            <h4>John Doe</h4>
                            <h5>john@gmail.com</h5>
                          </td>
                          <td>
                            <button class="btn btn-primary">Follow</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow mb-3" style="background: #1a202c">
              <div class="card-body">
                <div class="user-wrapper-container">
                  <div class="user-wrapper">
                    <table>
                      <tbody>
                        <tr>
                          <td>
                            <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="70">
                          </td>
                          <td style="width: 3em">
                          </td>
                          <td style="text-align: left; width: 30em">
                            <h4>Jon Doe</h4>
                            <h5>john@gmail.com</h5>
                          </td>
                          <td>
                            <button class="btn btn-primary">Follow</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card shadow mb-3" style="background: #1a202c">
              <div class="card-body">
                <div class="user-wrapper-container">
                  <div class="user-wrapper">
                    <table>
                      <tbody>
                        <tr>
                          <td>
                            <img src="https://avataaars.io/?avatarStyle=Circle&topType=LongHairDreads&accessoriesType=Kurt&hairColor=Auburn&facialHairType=BeardMedium&facialHairColor=Red&clotheType=BlazerShirt&clotheColor=Blue01&eyeType=Wink&eyebrowType=FlatNatural&mouthType=Twinkle&skinColor=Brown" width="70">
                          </td>
                          <td style="width: 3em">
                          </td>
                          <td style="text-align: left; width: 30em">
                            <h4>John De</h4>
                            <h5>john@gmail.com</h5>
                          </td>
                          <td>
                            <button class="btn btn-primary">Follow</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
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
  name: 'UserMainComponent'
}
</script>

<style scoped>
.login-card {
  width: 35rem !important;
}
.user-list {
  color:white;
}
.search-user {
  background: #1a202c;
  padding: 10px;
  border: 2px solid #56c2ff;
  color: white;
}
</style>