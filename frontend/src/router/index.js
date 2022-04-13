import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignupView from '../views/SignupView.vue'
import DashboardView from '../views/DashboardView.vue'
import ProfileView from '../views/ProfileView.vue'
import UsersView from '../views/UsersView.vue'
import CategoryView from '../views/CategoryView.vue'
import QuestionsView from '../views/QuestionsView.vue'
import LessonsView from '../views/LessonsView.vue'
import AnswersView from '../views/AnswersView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignupView
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardView
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfileView
  },
  {
    path: '/users',
    name: 'Users',
    component: UsersView
  },
  {
    path: '/category',
    name: 'Category',
    component: CategoryView
  },
  {
    path: '/questions',
    name: 'Questions',
    component: QuestionsView
  },
  {
    path: '/lessons',
    name: 'Lessons',
    component: LessonsView
  },
  {
    path: '/answer',
    name: 'Answer',
    component: AnswersView
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
