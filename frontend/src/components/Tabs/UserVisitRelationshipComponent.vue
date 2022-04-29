<template>
  <div class="modal" tabindex="-1" ref="res" id="followsModal" data-backdrop="static">
    <div class="modal-dialog modal-lg">
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
            <div class="mt-3">
              <div class="alert alert-success alert-dismissible fade show" :class="{'d-none' : !hideAlert}" role="alert">
                <strong>Success!</strong> User {{ alertMessage }}
                <button type="button" class="btn-close" :data-bs-dismiss="{'alert' : !hideAlert}" @click="close_alert" aria-label="Close"></button>
              </div>
            </div>
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="following-tab">
              <div class="following-list mt-3">
                <div v-if="!following.length" class="text-center">
                  User has no followings.
                </div>
                <UserVisitFollowingComponent v-for="follow in following" :key="follow.user_relationship_id" :follow="follow" @showMessage="showMessage"/>
              </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="followers-tab">
              <div class="followers-list mt-3">
                <div v-if="!followers.length" class="text-center">
                  User has no followers.
                </div>
                <UserVisitFollowerComponent v-for="follow in followers" :key="follow.user_relationship_id" :follow="follow" @showMessage="showMessage"/>
              </div>
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
import UserVisitFollowingComponent from './UserVisitFollowingComponent.vue'
import UserVisitFollowerComponent from './UserVisitFollowerComponent.vue'
export default {
  name: 'UserRelationshipComponent',
  components: {
    UserVisitFollowingComponent,
    UserVisitFollowerComponent
  },
  setup(props, context) {
    const following = ref([])
    const followers = ref([])
    const alertMessage = ref('')
    const hideAlert = ref(false)

    watchEffect(() => {
      if (store.state.following.length) {
        following.value = store.state.following
      }
      if (store.state.followers.length) {
        followers.value = store.state.followers
      }
    })

    const showMessage = (response) => {
      hideAlert.value = true
      alertMessage.value = response
      location.reload()
    }

    return { following, followers, showMessage, alertMessage, hideAlert }
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