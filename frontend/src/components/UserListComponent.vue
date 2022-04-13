<template>
  <div class="card shadow mb-3" style="background: #1a202c">
    <div class="card-body">
      <div class="user-wrapper-container">
        <div class="user-wrapper">
          <table>
            <tbody>
              <tr>
                <td>
                  <img :src="`http://${user.avatar}`" width="70">
                </td>
                <td style="width: 3em">
                </td>
                <td style="text-align: left; width: 30em">
                  <h4>{{ user.full_name }}</h4>
                  <h5>{{ user.email_address }}</h5>
                </td>
                <td>
                  <button class="btn btn-primary" @click="follow_user(user.user_id)" :disabled=isFollow>
                    <span v-if="!isFollow">Follow</span>
                    <span v-else>Following</span>
                  </button>
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
import { ref } from 'vue'
import axios from 'axios'
import commonService from '../composables/commonService'
import config from '../composables/config'

export default {
  name: 'UserListComponent',
  props: {
    user : {
      required: true
    }
  },
  setup(props, context) {
    const csvc = commonService()
    const { link } = config()
    const isFollow = ref(false)
    
    const follow_user = async (user_id) => {
      isFollow.value = !isFollow.value
      try {
        const followIn = {
          "following_id" : user_id
        }
        const follow = await axios.post(`${link}/api/follow`, followIn ,{
          headers: {
              Authorization: `Bearer ${csvc.getUserAndToken('token')}`
          }
        })
        const response = await follow.data.data
        context.emit('show', response)
      } catch(e) {
        console.error(e)
      }
    }
    return { follow_user, isFollow } 
  }
}
</script>

<style>

</style>