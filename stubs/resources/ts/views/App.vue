<script setup lang="ts">
import {RouterLink, RouterView} from 'vue-router'
</script>

<template>
  <header class="pb-8">
    <div class="container mx-auto flex flex-row gap-x-8 items-center justify-center">
      <div class="w-20">
        <RouterLink to="/">
          <img alt="Laravel Jumpstart Logo" class="w-full h-auto" src="@/assets/logo.png"/>
        </RouterLink>
      </div>
      <div class="flex flex-row gap-x-8 items-center">
        <RouterLink class="px-4" to="/">Home</RouterLink>
        <RouterLink class="px-4" to="/hello-world">Hello World</RouterLink>
        <RouterLink class="px-4" to="/about">About</RouterLink>
      </div>
    </div>
  </header>

  <div class="container mx-auto flex justify-center">
    <RouterView/>
  </div>
</template>
