<script setup lang="ts">
import { computed, inject, ref, watch } from 'vue'
import { useApiStore } from '@/stores/apiStore'
import UserAgeEnum from '@/enums/users/UserAgeEnum'
import UserGenderEnum from '@/enums/users/UserGenderEnum'
import useValidators from '@/composables/Validators'
import { type Emitter } from 'mitt'

const $api = useApiStore()
const emitter = inject<Emitter<any>>('emitter')!
const validators = useValidators()

const form = ref()
const formState = ref(null)
const isRequestActive = ref(false)

const name = ref('')
const nameErrors = ref<string[]>([])
const nameRules = [
  (value: string) => {
    if (value?.length < 3) return 'The name field must be at least 3 characters.'
    if (value?.length > 60) return 'The name field must not be greater than 60 characters.'
    return validators.isNameValid(value)
  },
]

/* 
  we can move all the UI validation rules in Validators composable
  not only regexp, but once again this depends on the system
  I would say for scalability of the project composables would be better
*/
const email = ref('')
const emailErrors = ref<string[]>([])
const emailRules = [
  (value: string) => {
    if (value) return true
    return 'The email field is required.'
  },
  (value: string) => {
    if (validators.isEmailValid(value)) return true
    return 'The email field must be a valid email address.'
  },
]

const age = ref(null)
const ageErrors = ref<string[]>([])
const ageRules = [
  (value: string) => {
    if (value != null) return true
    return 'The age field is required.'
  },
]

const gender = ref(UserGenderEnum.Male)
const subscribe = ref(false)

const genderEnum = UserGenderEnum

/*
  age options list can be moved to separate file
  as well to be able to re use it in other forms
  but for now there is no reason to do this
*/
const ageOptions = [
  {
    value: UserAgeEnum.LT_20,
    label: '<20'
  },
  {
    value: UserAgeEnum.BTW_20_60,
    label: '20 - 60'
  },
  {
    value: UserAgeEnum.GT_60,
    label: '>61'
  },
]

watch(name, () => clearErrors([nameErrors.value]) )
watch(email, () => clearErrors([emailErrors.value]) )
watch(age, () => clearErrors([ageErrors.value]) )

const isSubmitDisabled = computed(() => {
  return !isFormValid.value || isRequestActive.value
})

const isFormValid = computed(() => {
  return !!formState.value && !nameErrors.value.length && !emailErrors.value.length
})

const save = async (): Promise<any> => {
  clearErrors()
  isRequestActive.value = true

  await $api.users
    .create(name.value, email.value, age.value!, !!gender.value, subscribe.value)
    .then(data => {
      clearForm()
      emitter.emit('user-created', data)
    })
    .catch(ex => {
      mapApiErrors(ex.data.errors)
    })
    .finally(() => isRequestActive.value = false)
}

const clearErrors = (errorProps?: string[][]): void => {
  if (errorProps) {
    errorProps.forEach(e => e = [])
    return
  }

  [nameErrors.value, emailErrors.value, ageErrors.value].forEach(e => e = [])
}

const clearForm = (): void => {
  form.value.reset()
  gender.value = UserGenderEnum.Male // we do not want reset gender radio button
  subscribe.value = false // we do not want to set boolean value to null
  form.value.resetValidation()
}

/*
  API validation error matching on UI is far more complex
  task, and require deep discussion of product requirements.
  If backend is a service for multiple UI systems (web, mobile, desctop...)
  Then API should be build in mind with error codes system
  by which it would be easier to build validation properties resolver.
  But for test task Infuse Media, on which I already spent quite a bit of time
  I will stay with most stupid way of matching property names
  even without toLowerCase =)
*/
const mapApiErrors = (validationErrors: any): void => {
  const keys = Object.keys(validationErrors)
  keys.forEach(key => {
    if (key.toString() === 'name') {
      nameErrors.value = validationErrors[key]
    }

    if (key.toString() === 'email') {
      emailErrors.value = validationErrors[key]
    }

    if (key.toString() === 'age') {
      ageErrors.value = validationErrors[key]
    }
  })
}
</script>

<template>
  <div class="add-form-component">
    <h2>Complete the form:</h2>
    <v-card>
      <v-card-text>
        <v-form
          ref="form"
          v-model="formState"
          validate-on="blur"
          @submit.prevent
        >
          <!-- Name -->
          <v-text-field
            v-model="name"
            label="Full name"
            variant="solo"
            required
            :rules="nameRules"
            :error-messages="nameErrors"
          />
          <!-- Email -->
          <v-text-field
            v-model="email"
            label="Email"
            variant="solo"
            type="email"
            required
            :rules="emailRules"
            :error-messages="emailErrors"
          />
            <!-- Age -->
          <v-select
            v-model="age"
            label="Age"
            :items="ageOptions"
            item-title="label"
            item-value="value"
            variant="solo"
            required
            :rules="ageRules"
          />
          <!-- Gender -->
          <v-radio-group v-model="gender" inline>
            <template v-slot:label>
              <div>Gender</div>
            </template>
            <v-radio :value="genderEnum.Male" label="Male" />
            <v-radio :value="genderEnum.Female" label="Female" />
          </v-radio-group>
          <!-- Subscribe -->
          <v-checkbox label="Subscribe me" v-model="subscribe"></v-checkbox>
          <v-btn
            :loading="isRequestActive"
            elevated
            color="primary"
            width="100%"
            @click="save"
            :disabled="isSubmitDisabled"
            type="submit"
          >
            Submit
          </v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </div>
</template>
