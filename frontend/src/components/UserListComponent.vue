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
                  <button class="btn btn-primary" @click="follow_user(user.user_id)" :disabled=is_follow>
                    <span v-if="!is_follow">Follow</span>
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

export default {
  name: 'UserListComponent',
  props: {
    user : {
      required: true
    }
  },
  setup(props, context) {
    const csvc = commonService()
    const is_follow = ref(false)
    const is_show = ref('')
    
    const follow_user = async (user_id) => {
      is_follow.value = !is_follow.value
      try {
        const follow_in = {
          "following_id" : user_id
        }
        const follow = await axios.post('http://localhost/api/follow', follow_in ,{
        headers: {
            Authorization: `Bearer ${csvc.getUserAndToken('token')}`
        }
        })
        const response = await follow.data.data
        context.emit('show', response)
        console.log(response)
      } catch(e) {
        console.log(e)
      }
    }
    return { follow_user, is_follow } 
  }
}
</script>

<style>

</style>