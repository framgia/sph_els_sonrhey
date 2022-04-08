const profileService = () => {

  const editInfo = (inputsState, errorMessage) => {
    inputsState.value = !inputsState.value
    errorMessage.value = ''
  }

  return { editInfo }
}

export default profileService