<script setup>
import { ref, defineEmits } from 'vue'
import api from '../api'

const name = ref('')
const category = ref('')
const image = ref(null)
const emit = defineEmits(['itemAdded'])

const addItem = async () => {
  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('category', category.value)
  if (image.value) {
    formData.append('image', image.value)
  }

  try {
    await api.post('/clothing-items', formData)
    name.value = ''
    category.value = ''
    image.value = null
    emit('itemAdded')
  } catch (error) {
    console.error(error)
  }
}
</script>

<template>
  <form @submit.prevent="addItem">
    <input v-model="name" placeholder="Clothing Name" required />
    <input v-model="category" placeholder="Category" required />
    <input type="file" @change="(e) => (image = e.target.files[0])" />
    <button type="submit">Add Item</button>
  </form>
</template>
