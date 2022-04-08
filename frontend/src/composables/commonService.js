const setterAndGetter = () => {
  const setUserAndToken = (user, token) => {
    localStorage.setItem('user', JSON.stringify(user))
    localStorage.setItem('token', token)
    localStorage.setItem('isAuthenticated', true)
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

  return { setUserAndToken, getUserAndToken, removeUserAndToken, updateUser }
}

export default setterAndGetter