// This composable will help us to use common validators
// across the system. Whenever we want to change user name or email
// or create different form component, we always can rely on
// common rules described in our useValidators composable

export interface IValidators {
  isEmailValid: (email: string) => boolean
  isNameValid: (name: string) => boolean
}

export default function useValidators(): IValidators {
  // so there is a lot of discussions about email validation
  // best practive always make email confirmation
  // because even official standarts does not cover all the cases
  // The Official Standard: RFC 5322 https://www.regular-expressions.info/email.html
  const validateEmail = (email: string): boolean => {
    return /.+@.+\..+/.test(email)
  }

  const validateName = (name: string): boolean => {
    name
    return true // whatever requirements for name
  }

  const validators = {
    isEmailValid: validateEmail,
    isNameValid: validateName
  }

  return validators
}
