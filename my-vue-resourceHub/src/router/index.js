import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue'
import Readinglist from '../views/readinglist.vue'
import Register from '../views/Register.vue'
import Podcast from '../views/Podcast.vue'
import Tags from '../views/Tags.vue'
import CrashCourse from '../views/CrashCourse.vue'
import Ytchannels from '../views/YtChannels.vue'
import StachExchangeView from '../views/StachExchangeView.vue'
import SettingV from '../views/SettingV.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/readinglist',
      name: 'readinglist',
      component: Readinglist
    },
    {
      path: '/Podcast',
      name: 'Podcast',
      component: Podcast
    }
    ,
    {
      path: '/Tags',
      name: 'Tags',
      component: Tags 
    }
    ,
    {
      path: '/CrashCourse',
      name: 'CrashCourse',
      component: CrashCourse

    }
    ,
    {
      path: '/Ytchannels',
      name: 'Ytchannels',
      component: Ytchannels
    },
    {
      path: '/StachExchangeView',
      name: 'StachExchangeView',
      component: StachExchangeView
    },
    {
      path: '/SettingV',
      name: 'SettingV',
      component: SettingV
    }
  ]
})

export default router
