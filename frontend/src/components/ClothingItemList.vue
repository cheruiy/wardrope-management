<script setup>
import api from '../api'
import { defineProps, defineEmits } from 'vue'

const props = defineProps(['items'])
const emit = defineEmits(['itemDeleted'])

const deleteItem = async (id) => {
  try {
    await api.delete(`/clothing-items/${id}`)
    emit('itemDeleted')
  } catch (error) {
    console.error(error)
  }
}
</script>

<template>
  <ul>
    <li v-for="item in items" :key="item.id">
      <img
        v-if="item.image"
        :src="'http://127.0.0.1:8000/storage/' + item.image"
        alt="Clothing Item"
        width="100"
      />
      <span>{{ item.name }} - {{ item.category }}</span>
      <button @click="deleteItem(item.id)">Delete</button>
    </li>
  </ul>
</template>
