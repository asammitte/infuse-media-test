<script setup lang="ts">
import { ref, watch } from 'vue'
import type { IUserPaginateItem } from '@/interfaces/user/IUserPaginateItem'
import { useApiStore } from '@/stores/apiStore'

export interface Props {
  user: Nullable<IUserPaginateItem>
}

const props = withDefaults(defineProps<Props>(), {
  user: null
})

const $api = useApiStore()
const emit = defineEmits(['deleted', 'canceled'])
const dialog = ref(false)

watch(
  () => props.user,
  () => {
    dialog.value = !!props.user
  }
)

const confirmAction = (async () => {
  if (!props.user) {
    return
  }

  await $api.users
    .delete(props.user.id)
    .then(() => {
      emit('deleted')
      dialog.value = false
    })
    .catch(() => {
      console.log('show some toast with error msg.')
    })
})

const cancelAction = (() => {
  emit('canceled')
})
</script>

<template>
  <v-dialog
      v-model="dialog"
      width="auto"
    >
    <v-card>
      <template v-slot:title>
        Are you sure you want to delete user?
      </template>
      <v-card-text>
        <div><b>id:</b> {{ props.user?.id }}</div>
        <div><b>email:</b> {{ props.user?.email }}</div>
        <div><b>name:</b> {{ props.user?.name }}</div>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="primary"
          variant="outlined"
          @click="cancelAction"
        >
          Cancel
        </v-btn>
        <v-btn
          color="primary"
          variant="elevated"
          @click="confirmAction"
        >
          Confirm
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
