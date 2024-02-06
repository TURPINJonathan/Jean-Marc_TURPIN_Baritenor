import { ref } from 'vue'
import { defineStore } from 'pinia'

import MetropolitainButton from '@assets/pictures/navigationButtons/metropolitain_resize.jpg'
import ContactButton from '@assets/pictures/navigationButtons/contact_resize.jpg'
import ComingSoon from '@assets/pictures/navigationButtons/coming-soon_resize.jpg'
import DefaultButton from '@assets/pictures/metro_logo.png'

import type { NavigationModule } from '@/types/navigationType'

export const useNavStore = defineStore('navigation', () => ({
  modules: ref<NavigationModule[]>([
    {
      label: 'bio',
      path: '/biographie',
      pictureURL: DefaultButton
    },
    {
      label: 'métropolitain',
      path: '/metropolitain',
      pictureURL: MetropolitainButton
    },
    {
      label: 'média',
      path: '/media',
      pictureURL: DefaultButton
    },
    {
      label: 'à venir',
      path: '/a-venir',
      pictureURL: ComingSoon
    },
    {
      label: 'liens',
      path: '/liens',
      pictureURL: DefaultButton
    },
    {
      label: 'blog',
      path: '/blog',
      pictureURL: DefaultButton
    },
    {
      label: 'boutique',
      path: '/boutique',
      pictureURL: DefaultButton
    },
    {
      label: 'contact',
      path: '/contact',
      pictureURL: ContactButton
    }  
  ])
}))
