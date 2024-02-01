<script setup lang="ts">
  const cards = [
    {
      title: 'Vue 3',
      description: 'An approachable, performant and versatile framework for building web user interfaces.',
      url: 'https://vuejs.org'
    },
    {
      title: 'Pinia',
      description: 'Type Safe, Extensible, and Modular by design. Forget you are even using a store.',
      url: 'https://pinia.vuejs.org'
    },
    {
      title: 'Vue Router',
      description: 'Expressive, configurable and convenient routing for Vue.js',
      url: 'https://router.vuejs.org'
    },
    {
      title: 'VueUse',
      description: 'Collection of Essential Vue Composition Utilities.',
      url: 'https://vueuse.org'
    }
  ]
</script>

<template>
  <div class="grid gap-12 grid-cols-2">
    <div class="p-4 hover:outline hover:outline-1 hover:outline-offset-2" v-for="card in cards">
      <h3 class="text-lg mb-4">{{ card.title }}</h3>
      <p>{{ card.description }}</p>
      <a class="block text-right transition-colors duration-700 hover:text-orange-700 hover:text-underline" :href="card.url" target="_blank">View more</a>
    </div>
  </div>
</template>
