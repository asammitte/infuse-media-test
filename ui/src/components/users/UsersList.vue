<script setup lang="ts">
import { onBeforeUnmount, inject, onMounted, ref } from 'vue'
import { useApiStore } from '@/stores/apiStore'
import type { IUserPaginateItem } from '@/interfaces/user/IUserPaginateItem'
import { type Emitter } from 'mitt'
import UserAgeEnum from '@/enums/users/UserAgeEnum'
import UserDeleteConfirmation from '@/components/users/UserDeleteConfirmation.vue'

/*
 * do not really like this hackish implementation
 * but after removing EventBus from Vue 2, we have to
 * find a better solution, then inject with forcing type
 */
const emitter = inject<Emitter<any>>('emitter')!

const api = useApiStore()
const users = ref<IUserPaginateItem[]>([])
const userToDelete = ref<Nullable<IUserPaginateItem>>(null)

emitter.on('user-created', (user: IUserPaginateItem) => {
  users.value.unshift(user)
})

onMounted((): void => {
  fetchUsers()
})

onBeforeUnmount((): void => {
  emitter.off('user-created')
})

const fetchUsers = async (): Promise<void> => {
  await api.users.getAll()
    .then(data => users.value = data.data)
    .catch(ex => console.log(ex.code))
}

/*
 * some EnumToLabel common static class can help us to
 * be consistent across the app, but for now, I'll leave it like this
 */
const getAgeLabel = (age: UserAgeEnum): string => {
  let ageLabel
  switch(age) {
    case UserAgeEnum.LT_20:
      ageLabel = '<20'
      break;
    case UserAgeEnum.BTW_20_60:
      ageLabel = '20-60'
      break;
    default:
      ageLabel = '>61'
  }

  return ageLabel
}

const getSubscriptionLabel = (isSubscribed: boolean): string => {
  return isSubscribed ? 'Yes' : 'No'
}

const getGenderLabel = (gender: boolean): string => {
  return gender ? 'female' : 'male'
}

/*
 * I'll do refetch users to not break pagination
 * because going to new page we can skip one user
 * while rendering new page
 * Ideally I also have to show loader, so if internet
 * is slow, same user for deletion would not be selected
 * again, while list is re-fetching
 */
const removeUserFromList = (() => {
  fetchUsers()
})
</script>

<template>
  <div class="add-form-component">
    <h2>Results: ({{ users.length }} records)</h2>
    <v-card>
      <v-card-text>
          <v-table>
            <thead>
              <tr>
                <th class="text-left"></th>
                <th class="text-left">Id</th>
                <th class="text-left">Full name</th>
                <th class="text-left">Email</th>
                <th class="text-left">Age</th>
                <th class="text-left">Gender</th>
                <th class="text-left">Subscribe</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="user in users" :key="user.id">
                <td>
                  <v-btn
                    icon="mdi-delete"
                    variant="text"
                    @click="userToDelete = user"
                  />
                </td>
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ getAgeLabel(user.age) }}</td>
                <td>{{ getGenderLabel(user.gender) }}</td>
                <td>{{ getSubscriptionLabel(user.isSubscribed) }}</td>
              </tr>
            </tbody>
          </v-table>
      </v-card-text>
    </v-card>

    <user-delete-confirmation
      :user="userToDelete"
      @deleted="removeUserFromList"
      @canceled="userToDelete = null"
    />
  </div>
</template>
