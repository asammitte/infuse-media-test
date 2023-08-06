import "@mdi/font/css/materialdesignicons.css"
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import {
  VBtn,
  VCard,
  VCardActions,
  VCardText,
  VCheckbox,
  VCol,
  VContainer,
  VDialog,
  VForm,
  VIcon,
  VMain,
  VRadio,
  VRadioGroup,
  VRow,
  VSelect,
  VSheet,
  VSpacer,
  VTable,
  VTextField,
} from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetifyPlugin = createVuetify({
  components: {
    VBtn,
    VCard,
    VCardActions,
    VCardText,
    VCheckbox,
    VCol,
    VContainer,
    VDialog,
    VForm,
    VIcon,
    VMain,
    VRadio,
    VRadioGroup,
    VRow,
    VSelect,
    VSheet,
    VSpacer,
    VTable,
    VTextField,
  },
  directives,
  icons: {
    defaultSet: 'mdi',
  },
})

export default vuetifyPlugin

// import { inject } from 'vue'
// import { type IApi } from '@/interfaces/common/IApi'
// const api = inject<IApi>('api')!