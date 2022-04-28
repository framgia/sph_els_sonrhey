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
import AccountCreatedView from '../views/AccountCreatedView.vue'
import CategoryViewQuestions from '../views/CategoryViewQuestions.vue'
import ProfileVisitView from '../views/ProfileVisitView.vue'
import MyActivityLogView from '../views/MyActivityLogView.vue'
import commonService from '../composables/commonService'

const { getUserAndToken } = commonService()

const checkAuth = () => {
  if(getUserAndToken('token') == null){
    return { path: '/' }
  }
}

const redirectIfAuthenticated = (to, from) => {
  if(getUserAndToken('token')){
    return { path: '/dashboard' }
  }
}

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView,
    beforeEnter: [ redirectIfAuthenticated ]
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: SignupView,
    beforeEnter: [ redirectIfAuthenticated ]
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/profile',
    name: 'Profile',
    component: ProfileView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/users',
    name: 'Users',
    component: UsersView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/category',
    name: 'Category',
    component: CategoryView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/questions',
    name: 'Questions',
    component: QuestionsView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/lessons',
    name: 'Lessons',
    component: LessonsView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/answer',
    name: 'Answer',
    component: AnswersView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/account-created',
    name: 'AccountCreated',
    component: AccountCreatedView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/category/:name',
    name: 'CategoryViewQuestions',
    component: CategoryViewQuestions,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/profile-visit',
    name: 'ProfileVisit',
    component: ProfileVisitView,
    beforeEnter: [ checkAuth ]
  },
  {
    path: '/my-activity-log',
    name: 'MyActivityLog',
    component: MyActivityLogView,
    beforeEnter: [ checkAuth ]
  },
  { 
    path: '/:pathMatch(.*)*', 
    name: 'NotFound', 
    beforeEnter: [ checkAuth, redirectIfAuthenticated ]
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
