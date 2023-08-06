// I decided to save this implementation for future
// So I'll leave this plugin as is
// in general it's not a bad thing with provide/inject, but still
// forced typisation of my repository is not what I want
// so I decided to leave global store Pinia solution



// import axios, { AxiosError, type CreateAxiosDefaults } from 'axios'
// import type { App, Plugin } from 'vue'
// import type { IApi } from '@/interfaces/common/IApi'
// import { ApiKey } from '@/types/symbols';
// import UsersModule from '@/repository/modules/users'

// const apiPlugin: Plugin = {
//   install: (app: App): void => {
//     const fetchOptions: CreateAxiosDefaults = {}
//     const apiFetcher = axios.create(fetchOptions)

//     apiFetcher.interceptors.request.use(config => {
//       const token = localStorage.getItem('authtoken')
//       if (token) {
//         config.headers['Authorization'] = `Bearer ${token}`;
//       }

//       return config
//     })

//     apiFetcher.interceptors.response.use(
//       response => response,
//       (error: AxiosError) => {
//         const retVal = {
//           message: error.response?.statusText,
//           code: error.response?.status,
//           data: error.response?.data
//         }
//         return Promise.reject(retVal)
//       })

//       const modules: IApi = {
//         users: new UsersModule(apiFetcher)
//       }


//     app.provide(ApiKey, modules)
//   }
// }

// export default apiPlugin

// import { inject } from 'vue'
// import { type IApi } from '@/interfaces/common/IApi'
// const api = inject<IApi>('api')!