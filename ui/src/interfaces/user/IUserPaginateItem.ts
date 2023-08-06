import type UserAgeEnum from "@/enums/users/UserAgeEnum"

export interface IUserPaginateItem {
  id: number
  name: string
  email: string
  age: UserAgeEnum
  gender: boolean
  isSubscribed: boolean
}
