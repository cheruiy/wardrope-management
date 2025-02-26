<script setup>
import { onMounted } from 'vue'
import { useWardrobeStore } from '../store/wardrobe'

const wardrobeStore = useWardrobeStore()

onMounted(() => {
  wardrobeStore.fetchItems()
})
</script>

<template>
  <div>
    <h2>My Wardrobe</h2>
    <ul>
      <li v-for="item in wardrobeStore.items" :key="item.id">{{ item.name }}</li>
    </ul>
  </div>
</template>
