// So it's Sat 5 Aug 18:04 and I'm continue quest on
// test task for InfuseMedia
// this is my second out of three repository pattern implementations
// all of them has pros and cons
// so I would stay for case of Vue 3 CompositionApi with Pinia store
// which gives me best typisation results across the app

import { defineStore } from 'pinia'
import UsersModule from '@/repository/modules/users'
import AxiosClient from '@/repository/axiosClient'

const api: AxiosClient = new AxiosClient()

export const useApiStore = defineStore({
  id: 'apiStore',
  getters: {
    users(): UsersModule {
      return api.users
    }
  }
})
