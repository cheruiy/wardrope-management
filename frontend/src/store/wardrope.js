import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'

export const useWardrobeStore = defineStore('wardrobe', () => {
  const items = ref([])

  const fetchItems = async () => {
    try {
      const response = await axios.get('http://127.0.0.1:8000/api/clothing-items')
      items.value = response.data
    } catch (error) {
      console.error('Error fetching wardrobe items:', error)
    }
  }

  return { items, fetchItems }
})
