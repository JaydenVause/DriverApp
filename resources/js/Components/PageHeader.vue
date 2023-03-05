<template>
  <header class="text-center my-16">
    <h1 class="text-4xl font-bold mb-4">{{ title }}</h1>
    <p class="text-lg">{{ content }}</p>
  </header>
  <slot />
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
      content: String
    },
    content: {
      type: String,
      required: true
    }
  }
}
</script>
