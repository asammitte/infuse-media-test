import type { IPaginatedModel } from '@/interfaces/common/IPaginatedModel'
import type { IUserPaginateItem } from '@/interfaces/user/IUserPaginateItem'
import HttpFactory from '@/repository/factory'

class UsersModule extends HttpFactory {
  private RESOURCE = '/api/users'

  async getAll(pageIndex?: number): Promise<IPaginatedModel<IUserPaginateItem>> {
    return await this.call<IPaginatedModel<IUserPaginateItem>>('GET', `${this.RESOURCE}/`, { pageIndex: pageIndex })
  }

  async create(name: string, email: string, age: number, gender: boolean, subscribe: boolean): Promise<IUserPaginateItem> {
    return await this.call<IUserPaginateItem>(
      'POST',
      `${this.RESOURCE}/`,
      undefined,
      {
        name: name,
        email: email,
        age: age,
        gender: gender,
        subscribe: subscribe
      }
    )
  }

  async delete(id: number): Promise<boolean> {
    return await this.call<boolean>('DELETE', `${this.RESOURCE}/${id}`)
  }
}

export default UsersModule
