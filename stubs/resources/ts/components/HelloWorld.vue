<script setup lang="ts">
defineProps<{
  message: string
}>()
</script>

<template>
  <div>
    <h1>{{ message }}</h1>
  </div>
</template>
