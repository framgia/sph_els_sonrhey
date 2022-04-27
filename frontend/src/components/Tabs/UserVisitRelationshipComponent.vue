<template>
  <div class="modal" tabindex="-1" ref="res" id="followsModal" data-backdrop="static">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background: #2d3748;">
        <div class="modal-body">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="following-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Following</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="followers-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Followers</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="following-tab">
              <table class="table mt-4">
                <tbody>
                  <tr v-for="follow in following" :key="follow.user_relationship_id">
                    <td>{{ follow.following.full_name }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="followers-tab">
              <table class="table mt-4">
                <tbody>
                  <tr v-for="follow in followers" :key="follow.user_relationship_id">
                    <td>{{ follow.followed_back.full_name }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '@/store'
import { ref, watchEffect } from 'vue'
export default {
  name: 'UserRelationshipComponent',
  setup(props, context) {
    const following = ref()
    const followers = ref()

    watchEffect(() => {
      if (store.state.following.length) {
        following.value = store.state.following
      }
      if (store.state.followers.length) {
        followers.value = store.state.followers
      }
    })

    return { following, followers }
  }
}
</script>

<style scoped>
.nav-tabs .nav-link.active {
  background: #1a202c !important;
  color: white !important;
}
.table {
  color: white;
}
</style>