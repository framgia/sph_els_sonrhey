import Swal from 'sweetalert2'

const setterAndGetter = () => {
  const setUserAndToken = (user, token) => {
    localStorage.setItem('user', JSON.stringify(user))
    localStorage.setItem('token', token)
    localStorage.setItem('isAuthenticated', true)
  }

  const settempStore = (itemName,itemValue) => {
    localStorage.setItem(itemName, JSON.stringify(itemValue))
  }

  const getTempStore = (itemName) => {
    return localStorage.getItem(itemName)
  }

  const updateUser = (user) => {
    localStorage.setItem('user', JSON.stringify(user))
  }

  const getUserAndToken = (option) => {
    return localStorage.getItem(option)
  }

  const removeUserAndToken = () => {
    return localStorage.clear()
  }

  const message = ({ title : title, text : text, icon : icon}) => {
    Swal.fire({
      title: title,
      text: text,
      icon: icon
    })
  }

  return { setUserAndToken, getUserAndToken, removeUserAndToken, updateUser, settempStore, getTempStore, message }
}

export default setterAndGetter