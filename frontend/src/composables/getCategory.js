import store from '@/store'
import axios from 'axios'
import { ref, computed } from 'vue'
import commonService from './commonService'
import config from './config'

const getCategory = () => {
  const csvc = commonService()
  const { link } = config()
  const categoriesList = ref()
  const categoriesWithQuestion = ref([])

  const fetchCategory = async () => {
    const categories = await axios.get(`${link}/api/get-category`, {
      headers: {
        Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })
  
    const response = await categories.data.data
    categoriesList.value = response
  }

  const selectedCategory = (categories) => {
    const question = store.state.question
    const category = categories
    if (question.length == undefined && category != undefined) {
      const newCat = category.map(q => {
        return q.category_id ==  question.category.category_id ? {...q, selected: true} : q 
      })
      return newCat
    }
  }

  const getCategoryWithQuestions = async () => {
    const categories = await axios.get(`${link}/api/get-category-with-questions`, {
      headers: {
        Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })
  
    const response = await categories.data.data
    categoriesWithQuestion.value = response
  }

  return { fetchCategory, categoriesList, selectedCategory, getCategoryWithQuestions, categoriesWithQuestion }
}

export default getCategory