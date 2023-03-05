<template>
  <div class="max-w-5xl mx-auto px-6 md:px-12 py-12">
    <h1 class="text-4xl font-bold mb-6">Contact Us</h1>
    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="name">
          Name
        </label>
        <input
          v-model="form.name"
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          type="text"
          id="name"
          placeholder="Enter your name"
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="email">
          Email
        </label>
        <input
          v-model="form.email"
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          type="email"
          id="email"
          placeholder="Enter your email address"
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="message">
          Message
        </label>
        <textarea
          v-model="form.message"
          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
          rows="5"
          id="message"
          placeholder="Enter your message"
        ></textarea>
      </div>
      <div class="mb-4">
        <button
          type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :disabled="isSubmitting"
        >
          {{ isSubmitting ? 'Submitting...' : 'Submit' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        message: '',
      },
      isSubmitting: false,
    };
  },
  methods: {
    async submitForm() {
      this.isSubmitting = true;
      try {
        // Send form data to the server
        await this.$axios.post('/contact-us', this.form);
        alert('Message sent successfully!');
        // Clear the form
        this.form = {
          name: '',
          email: '',
          message: '',
        };
      } catch (error) {
        alert('An error occurred while submitting the form.');
        console.error(error);
      } finally {
        this.isSubmitting = false;
      }
    },
  },
};
</script>
