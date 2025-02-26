<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/store/auth'
import axios from 'axios'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()
const router = useRouter()

const email = ref('')
const password = ref('')
const errorMessage = ref('')

const login = async () => {
  try {
    const response = await axios.post('http://127.0.0.1:8000/api/login', {
      email: email.value,
      password: password.value,
    })

    authStore.setUser(response.data.user, response.data.token)
    router.push('/dashboard') // Redirect to dashboard
  } catch (error) {
    errorMessage.value = 'Invalid login credentials'
  }
}
</script>

<template>
  <div>
    <h2>Login</h2>
    <form @submit.prevent="login">
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    <p v-if="errorMessage">{{ errorMessage }}</p>
  </div>
</template>
