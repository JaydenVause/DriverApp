<template>
  <div class="flex flex-wrap justify-center gap-6 my-16">
    <div class="bg-white shadow-xl p-6 max-w-sm flex-grow-0">
      <h2 class="text-2xl font-bold text-center mb-4">{{ title1 }}</h2>
      <p class="text-lg text-center">{{ content1 }}</p>
    </div>

    <div class="bg-white shadow-xl p-6 max-w-sm flex-grow-0">
      <h2 class="text-2xl font-bold text-center mb-4">{{ title2 }}</h2>
      <p class="text-lg text-center">{{ content2 }}</p>
    </div>

    <div class="bg-white shadow-xl p-6 max-w-sm flex-grow-0">
      <h2 class="text-2xl font-bold text-center mb-4">{{ title3 }}</h2>
      <p class="text-lg text-center">{{ content3 }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title1: {
      type: String,
      required: true
    },
    content1: {
      type: String,
      required: true
    },
    title2: {
      type: String,
      required: true
    },
    content2: {
      type: String,
      required: true
    },
    title3: {
      type: String,
      required: true
    },
    content3: {
      type: String,
      required: true
    }
  }
}
</script>
