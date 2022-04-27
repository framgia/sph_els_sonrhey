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
  const categoriesUsed = ref([])
  const isLoaded = ref(false)
  const pages = ref([])

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
    isLoaded.value = true
  }

  const nextCategoryWithQuestionsAnswer = async (url) => {
    const categories = await axios.get(`${link}/api/get-category-with-questions-answer${url}`, {
      headers: {
        Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })
  
    const response = await categories.data.data
    pages.value = response.links
    categoriesWithQuestion.value = response.data
  }

  const getCategoriesUsed = async (userId) => {
    const categories = await axios.get(`${link}/api/get-categories-used/${userId}`, {
      headers: {
        Authorization: `Bearer ${csvc.getUserAndToken('token')}`
      }
    })
  
    const response = await categories.data.data
    categoriesUsed.value = response
    isLoaded.value = true
  }

  const filterUsedCategory = (arr, categoryList) => {
    const filter = arr.filter(q => categoryList.map((t) => { 
      return t.category_id
    }).includes(q.category_id))

    const obj = Object.assign({}, filter)
    return obj
  }

  const filterUnusedCategory = (arr, categoryList) => {
    const filter = arr.filter(q => !categoryList.map((t) => { 
      return t.category_id
    }).includes(q.category_id))

    const obj = Object.assign({}, filter)
    return obj
  }

  return { fetchCategory, categoriesList, selectedCategory, getCategoryWithQuestions, categoriesWithQuestion, getCategoriesUsed, categoriesUsed, isLoaded, filterUsedCategory, filterUnusedCategory, nextCategoryWithQuestionsAnswer, pages }
}

export default getCategory