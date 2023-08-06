import axios, { AxiosError, type AxiosInstance, type CreateAxiosDefaults } from "axios"
import type { IHttpClient, IHttpErrorResponse } from "@/interfaces/common/IHttpClient"
import UsersModule from "./modules/users"

class AxiosClient implements IHttpClient {
  private apiFetcher: AxiosInstance
  private usersInstance?: UsersModule

  constructor() {
    const fetchOptions: CreateAxiosDefaults = {}
    this.apiFetcher = axios.create(fetchOptions)

    this.apiFetcher.interceptors.request.use(config => {
      const token = localStorage.getItem('authtoken')
      if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
      }

      return config
    })

    this.apiFetcher.interceptors.response.use(
      response => response,
      (error: AxiosError) => {
        const rejectResponse = this.convertToUnifiedError(error)
        return Promise.reject(rejectResponse)
      }
    )
  }

  get users(): UsersModule {
    if (this.usersInstance) {
      return this.usersInstance
    }

    this.usersInstance = new UsersModule(this.apiFetcher)
    return this.usersInstance
  }

  convertToUnifiedError(error: AxiosError): IHttpErrorResponse {
    const unifiedError = {
      message: error.response?.statusText,
      code: error.response?.status,
      data: error.response?.data
    }

    return unifiedError
  }
}

export default AxiosClient
