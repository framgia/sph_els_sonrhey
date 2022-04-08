import { ref } from "vue"

const editedFields = (inputStatus, inputValues) => {
  const formData = ref([])
  const insertValue = (value, field) => {
    if (field == "password") {
      formData.value.push({
        'is_edited' : true,
        'name' : 'password',
        'old_password' : value.password,
        'new_password' : value.new_password
      })
      return
    }

    formData.value.push({
      'is_edited' : true,
      'name' : field,
       [field] : value
    })
  }
  
  if (inputStatus.full_name) {
    insertValue(inputValues.full_name, 'full_name')
  }
  if (inputStatus.email_address) {
    insertValue(inputValues.email_address, 'email_address')
  }
  if (inputStatus.image) {
    insertValue(inputValues.image, 'image')
  }
  if (inputStatus.password) {
    insertValue(inputValues, 'password')
  }

  return formData.value
}

export default editedFields