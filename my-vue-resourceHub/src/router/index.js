import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue'
import Readinglist from '../views/Readinglist.vue'
import Register from '../views/Register.vue'
import Podcast from '../views/Podcast.vue'
import Tags from '../views/Tags.vue'
import CrashCourse from '../views/CrashCourse.vue'
import Ytchannels from '../views/YtChannels.vue'
import StachExchangeView from '../views/StachExchangeView.vue'
import SettingV from '../views/SettingV.vue'
import EventView from '../views/EventView.vue'
import Myprofil from '../views/Myprofil.vue'
import Mynotification from '../views/Mynotification.vue'
import PostDetail from '../views/PostDetail.vue'
import Resources from '../views/Resources.vue'
import NewPost from '../views/NewPost.vue'
import UserProfile from '../views/UserProfile.vue'
import DashboardAdmin from '../views/Admin/DashboardAdmin.vue'
import statistics from '../views/Admin/statistics.vue'
import dashboard from '../views/Admin/dashboard.vue'
import Roadmap from '@/components/Roadmap.vue'
// import managementUsers from '../views/Admin/'

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
    ,
    {
      path: '/EventView',
      name: 'EventView',
      component: EventView
    }
    ,
    {
      path: '/me',
      name: 'me',
      component: Myprofil
    }
    ,
    {
      path: '/Mynotification',
      name: 'Mynotification',
      component: Mynotification
    }
    ,
    {
      path: '/Pd/:id',
      name: 'Pd',
      component: PostDetail
    }
    ,
    {
      path: '/R/:idCategorie',
      name: 'R',
      component: Resources
    }
    ,
    {
      path: '/new',
      name: 'new',
      component: NewPost
    }
    ,
    {
      path: '/u/:userId',
      name: 'UserProfile',
      component: UserProfile
    }
    ,
    {
      path: '/DashboardAdmin',
      name: 'DashboardAdmin',
      component: DashboardAdmin
    }
    ,
    {
      path: '/statistics',
      name: 'statistics',
      component: statistics
    }
    ,
    { 
      path: '/dashboard',
      name: 'dashboard',
      component: dashboard
    }
    ,
    { 
      path: '/r/Front',
      name: 'Front',
      component: Roadmap
    }
    // ,
    // { 
    //   path: '/managementUsers',
    //   name: 'managementUsers',
    //   component: managementUsers
    // }
  ]
})

export default router
