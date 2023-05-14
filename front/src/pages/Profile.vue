<template>
  <div class="profile">
    <div class="container">
      <div class="profile__user">
        <ul class="profile__user-stats">
          <li class="profile__user-stat">
            <b>ID:</b> {{ authStore.user.id }}
          </li>
          <li class="profile__user-stat">
            <b>Имя:</b> {{ authStore.user.name }}
          </li>
          <li class="profile__user-stat">
            <b>Фамилия:</b> {{ authStore.user.last_name }}
          </li>
          <li class="profile__user-stat">
            <b>Email:</b> {{ authStore.user.email }}
          </li>
          <li class="profile__user-stat">
            <b>Created_at:</b> {{ authStore.user.created_at }}
          </li>
          <li class="profile__user-stat">
            <b>Updated_at:</b> {{ authStore.user.updated_at }}
          </li>
        </ul>
      </div>
      <div class="profile__logs">
        <table class="profile__logs-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Type</th>
              <th>IP</th>
              <th>Data</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="line in logs" :key="line.id">
              <td>{{ line.id }}</td>
              <td>{{ line.type }}</td>
              <td>{{ line.client_ip }}</td>
              <td>{{ line.data }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import {useAuthStore} from "@stores/authStore.js";
import {inject, onMounted, ref} from "vue";

const authStore = useAuthStore()
const $axios = inject('$axios')

const logs = ref([])

onMounted(async () => {
  try {
    const response = await $axios.get('/logs')
    logs.value = response.data
  } catch (e) {
    console.error(e)
  }
})

</script>

<style scoped>
.profile__user {
  margin-bottom: 20px;
}

.profile__user-stats {
  margin: 0;
  padding: 0;
  list-style: none;
}

.profile__user-stat {
  margin-bottom: 5px;
}
</style>
