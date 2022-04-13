const getAnswer = () => {
  const answer = (question) => {
    if (question.length == undefined) {
      const selAnswer = question.choices.map(q => {
        return q.choice_id ==  question.answer.choice_id ? {...q, selected: true} : q 
      })
      return selAnswer
    }
  }

  return { answer }
}

export default getAnswer