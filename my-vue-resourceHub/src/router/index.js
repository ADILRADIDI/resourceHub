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
import TagsDetailView from '../views/TagsDetailView.vue'
import UserProfile from '../views/UserProfile.vue'
import DashboardAdmin from '../views/Admin/DashboardAdmin.vue'
import statistics from '../views/Admin/statistics.vue'
import dashboard from '../views/Admin/dashboard.vue'
import Roadmap from '@/components/Roadmap.vue'
import Mpost from '@/components/AdminComponents/ManagePost.vue'
import Mresource from '@/components/AdminComponents/Mresource.vue'
import Mtags from '@/components/AdminComponents/Mtags.vue'
import Mpodcasts from '@/components/AdminComponents/Mpodcasts.vue'
import Mevents from '@/components/AdminComponents/Mevents.vue'
import Musers from '@/components/AdminComponents/manageUsers.vue/Musers.vue'
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
      path: '/Mpost',
      name: 'Mpost',
      component: Mpost
    },
    {
      path: '/Musers',
      name: 'Musers',
      component: Musers
    },
    {
      path: '/Mpodcasts',
      name: 'Mpodcasts',
      component: Mpodcasts
    },
    {
      path: '/Mtags',
      name: 'Mtags',
      component: Mtags
    },
    {
      path: '/Mevents',
      name: 'Mevents',
      component: Mevents
    },
    {
      path: '/Mresource',
      name: 'Mresource',
      component: Mresource
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
      path: '/roadmaps/front',
      name: 'FrontEnd',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/frontend' } // Pass the URL as a prop
    },
    {
      path: '/roadmaps/fullstack',
      name: 'FullStack',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/full-stack' }
    },
    {
      path: '/roadmaps/backend',
      name: 'BackEnd',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/backend' }
    },
    {
      path: '/roadmaps/mobile',
      name: 'Mobile',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/mobile' }
    },
    {
      path: '/roadmaps/devops',
      name: 'DevOps',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/devops' }
    },
    {
      path: '/roadmaps/docker',
      name: 'Docker',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/docker' }
    },
    {
      path: '/roadmaps/python',
      name: 'Python',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/python' }
    },
    {
      path: '/roadmaps/java',
      name: 'Java',
      component: Roadmap,
      props: { roadmapUrl: 'https://roadmap.sh/java' }
    },
    {
      path: '/t/:tag',
      name: 'TagsDetail',
      component: TagsDetailView

      
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
