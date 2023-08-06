import { type AxiosInstance, type Method } from 'axios'

class HttpFactory {
  private $fetch: AxiosInstance;

  constructor(fetcher: AxiosInstance) {
    this.$fetch = fetcher
  }

  async call<T>(method: Method, url: string, params?: object, payload?: object): Promise<T> {
    const { data } = await this.$fetch
      .request<T>({
        url: url,
        method: method,
        params: params,
        data: payload
      })
    return data
  }
}

export default HttpFactory




//
// Below is one of my interceptor implementations which I would like to save for myself for future
//
//
//
// export type FetcherErrorResponse<T> = {
//   data?: T;
//   code?: number;
//   message?: string;
// }
//
// async call<T>(method: Method, url: string, params?: object): Promise<T> {
//   return new Promise<T>((resolve, reject) => {
//     (async () => {
//       try {
//         const { data } = await this.$fetch.request<T>({
//           url: url,
//           method: method,
//           params: params
//         })

//         resolve(data)
//       } catch (error: any) {
//         if (error instanceof AxiosError) {
//           const retVal: FetcherErrorResponse<any> = {
//             message: error.response?.statusText,
//             code: error.response?.status,
//             data: error.response?.data
//           }

//           reject(retVal)
//         }

//         console.log('Unexpected error', error)
//         reject(undefined)
//       }
//     })()
//   })
// }
