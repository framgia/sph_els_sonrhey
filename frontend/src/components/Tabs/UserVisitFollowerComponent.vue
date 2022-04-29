<template>
  <div class="card shadow mb-3" style="background: #1a202c">
    <div class="card-body">
      <div class="user-wrapper-container">
        <div class="user-wrapper">
          <table>
            <tbody>
              <tr>
                <td>
                  <img :src="`http://${follow.followed_back.avatar}`" onerror="this.onerror=null;this.src='https://dummyimage.com/70';" width="70">
                </td>
                <td style="width: 3em">
                </td>
                <td style="text-align: left; width: 30em">
                  <h4>{{ follow.followed_back.full_name }}</h4>
                  <h5>{{ follow.followed_back.email_address }}</h5>
                </td>
                <td>
                  <!-- <button type="button" class="btn btn-danger" @click="unfollow_user(follow.following.user_id)" :disabled=isFollow>
                  <span v-if="!isFollow">Unfollow</span>
                  <span v-else>Unfollowing</span>  
                  </button> -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserVisitFollowerComponent',
  props: ['follow']
}
</script>

<style>

</style>