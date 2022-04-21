const getResults = () => {
  const progress = (categoriesUsed, category, isLoaded) => {
    if (isLoaded) {
      if (categoriesUsed.length) {
        const catUsed = categoriesUsed.find(q => q.category_id === category.category_id)
        if (catUsed != undefined) {
          const currentQuestionId = catUsed.question_id
          const getIndex = category.questions.findIndex(q => q.question_id === currentQuestionId)
          return getIndex + 1
        }
      }
      return 0
    }
  }

  const quizProgressStatus = (categoriesUsed, category, isLoaded) => {
    if (isLoaded) {
      if (categoriesUsed.length) {
        const catUsed = categoriesUsed.find(q => q.category_id === category.category_id)
        if (catUsed != undefined) {
          if (catUsed.status.code === 'CMP') {
            return 'CMP'
          } else if (catUsed.status.code === 'INP') {
            return 'INP'
          }
        }
      }
      return 'DEF'
    }  
  }

  return { progress, quizProgressStatus }
}

export default getResults