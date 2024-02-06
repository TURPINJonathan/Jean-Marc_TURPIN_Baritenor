import { createRouter, createWebHistory } from 'vue-router'

import BiographyView from '@views/BiographyView.vue';
import BlogView from '@views/BlogView.vue';
import ContactView from '@views/ContactView.vue';
import HomeView from '@views/HomeView.vue';
import LinkView from '@views/LinkView.vue';
import MediaView from '@views/MediaView.vue';
import MetroView from '@views/MetroView.vue';
import ProjectView from '@views/ProjectView.vue';
import ShopView from '@views/ShopView.vue';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Jean-Marc TURPIN',
      component: HomeView,
    },
    {
      path: '/biographie',
      name: 'Biographie',
      component: BiographyView
    },
    {
      path: '/blog',
      name: 'Blog',
      component: BlogView
    },
    {
      path: '/contact',
      name: 'Contact',
      component: ContactView
    },
    {
      path: '/liens',
      name: 'Liens',
      component: LinkView
    },
    {
      path: '/media',
      name: 'Médias',
      component: MediaView
    },
    {
      path: '/metropolitain',
      name: 'Métro',
      component: MetroView
    },
    {
      path: '/a-venir',
      name: 'A venir',
      component: ProjectView
    },
    {
      path: '/boutique',
      name: 'Boutique',
      component: ShopView
    },
  ]
})

export default router
