<template>
  <div class="modal" tabindex="-1" ref="res" id="followsModal" data-backdrop="static">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
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
              <table style="color: black" class="table table-striped mt-4">
                <tbody>
                  <tr v-for="follow in following" :key="follow.user_relationship_id">
                    <td>{{ follow.following.full_name }}</td>
                    <td><a href="#">Unfollow</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="followers-tab">
              <table style="color: black" class="table table-striped mt-4">
                <tbody>
                  <tr v-for="follow in followers" :key="follow.user_relationship_id">
                    <td>{{ follow.followed_back.full_name }}</td>
                    <td><a href="#">Unfollow</a></td>
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
  setup() {
    const following = ref()
    const followers = ref()

    watchEffect(() => {
      following.value = store.state.following
      followers.value = store.state.followers
    })

    return { following, followers }
  }
}
</script>

<style>

</style>