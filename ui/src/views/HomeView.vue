<script setup lang="ts">
import AddForm from '@/components/users/AddForm.vue'
import UsersList from '@/components/users/UsersList.vue'
</script>

<template>
  <!-- <div class="users-list-component"> -->
    <v-container>
      <v-row>
        <v-col cols="3">
          <v-sheet class="ma-2 pa-2">
            <AddForm />
          </v-sheet>
        </v-col>
        <v-col cols="9">
          <v-sheet class="ma-2 pa-2">
            <Suspense>
              <template #default>
                <UsersList />
              </template>
              <template #fallback>
                Loading Users...
              </template>
            </Suspense>
          </v-sheet>
        </v-col>
      </v-row>
    </v-container>
  <!-- </div> -->
</template>
