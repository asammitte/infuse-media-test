import type UsersModule from "@/repository/modules/users"

interface IHttpClient {
  readonly users: UsersModule
  convertToUnifiedError(error: any): IHttpErrorResponse
}

interface IHttpErrorResponse {
  message?: string
  code?: number
  data?: any
}

export type { IHttpClient, IHttpErrorResponse }
