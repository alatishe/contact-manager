<template>
    <div class="container mt-5">
      <h2>Create New Contact</h2>
        
      <form @submit.prevent="createContact">
        <div class="alert alert-danger alert-dismissible fade show"  role="alert" v-if="errorMessage" id="errorDiv">
            {{ errorMessage }}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" @click="dismissAlert"></button>
        </div>
        <div v-else-if="successMessage" class="alert alert-success">
          {{ successMessage }}
          <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" @click="dismissAlert"></button>
        </div>
        <div class="mb-3">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" v-model="contact.first_name" required>
        </div>
        
        <div class="mb-3">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" v-model="contact.last_name" required>
        </div>

        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" v-model="contact.email" required>
        </div>

        <div class="mb-3">
          <label for="phone">Telephone</label>
          <input type="tel" class="form-control" id="phone" v-model="contact.phone">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
      </form>
      <p><a href="/">View all contacts</a></p>
    </div>
  </template>
  <style>
  @import url("https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css");
</style>
  <script>
  const $ = require('jquery');
  export default {
    data() {
      return {
        contact: {
          first_name: '',
          last_name: '',
          email: '',
          phone: '',
        },
        errorMessage: null,
        successMessage: null,
      };
    },
    mounted() {
        this.loadScripts();
    },
    methods: {
      dismissAlert() {
        this.errorMessage = null;
        this.successMessage = null;
      },
      createContact() {
        console.log('Creating contact:'+ this.contact);
        axios.post('/contacts', this.contact)
          .then(response => {
            // Clear form and update contact list
            this.contact = {
              first_name: '',
              last_name: '',
              email: '',
              phone: '',
            };
            this.errorMessage = null;
            this.successMessage = response.data.message;
          })
          .catch(error => {
            if (error.response.status === 500) {
              this.errorMessage = 'An internal server error occurred. Please try again later.';
            }else{
              this.errorMessage = error.response.data.message;
            }
          });
      },
      loadScripts() {
        const jqueryScript = document.createElement('script');
        jqueryScript.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js';
        document.head.appendChild(jqueryScript);

        const bootstrapScript = document.createElement('script');
        bootstrapScript.src = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js';
        document.head.appendChild(bootstrapScript);
      },
    },
  };
  </script>
  