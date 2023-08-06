export interface IPaginatedModel<T> {
  data: T[],
  pagination: IPagination
}

export interface IPagination {
  pageIndex: number
  pageSize: number
  totalItems: number
  totalPages: number
  hasPrevious: boolean
  hasNext: boolean
}
