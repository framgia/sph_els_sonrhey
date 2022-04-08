const getToken = () => {
  const token = {
      headers: {
        "Content-Type": "multipart/form-data"
      }
  }
  return token
}

export default getToken