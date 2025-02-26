import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useAuthStore = defineStore('auth', () => {
  const user = ref(null)
  const token = ref(localStorage.getItem('token') || '')

  const setUser = (userData, userToken) => {
    user.value = userData
    token.value = userToken
    localStorage.setItem('token', userToken)
  }

  const logout = () => {
    user.value = null
    token.value = ''
    localStorage.removeItem('token')
  }

  return { user, token, setUser, logout }
})
