
/*
 * I would set values natively to prevent cases
 * when newly added enum values will break our
 * consistence with backend enum
 */
export enum UserAgeEnum {
  LT_20 = 0,
  BTW_20_60 = 1,
  GT_60 = 2,
}

export default UserAgeEnum
