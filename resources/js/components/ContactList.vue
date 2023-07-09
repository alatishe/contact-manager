<template>
  <div class="container mt-5">
      <h2>Contact List</h2>
      <p><a href="/create">Create a Contact</a></p>
      <table id="contactsTable" class="display">
          <thead>
          <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Telephone</th>
              <th></th>
          </tr>
          </thead>
      </table>
  </div>
</template>
<style>
  @import url("https://unpkg.com/bootstrap@5.3.0/dist/css/bootstrap.min.css");
</style>
<script>
import $ from 'jquery';
import 'datatables.net';
import 'datatables.net-dt';

export default {

  data() {
    return {
      searchQuery: '',
    };
  },
  mounted() {
    this.initializeDataTable();
  },
  methods: {
    initializeDataTable(){
      const table = $(this.$el.querySelector('#contactsTable'));
      table.DataTable({
        ajax: {
          url: '/contacts',
          dataSrc: '',
        },
        columns: [
          { data: 'first_name' },
          { data: 'last_name' },
          { data: 'email' },
          { data: 'phone' },
          { data: null,
            render: function (data, type, row) {
              return `<button class="delete-btn" data-id="${data.id}">Delete</button>`;
            }, 
          },
        ],
        searching: true,
        filter: true,
        paging: true,
        processing: true,
        lengthMenu: [10, 25, 50],
        pageLength: 10,
      });
      // Handle delete button click event
      table.on('click', '.delete-btn', (event) => {
        const id = $(event.target).data('id');
        this.deleteContact(id);
      });
    },
    destroyed() {
      $(this.$el).DataTable().destroy();
    },
    reloadDataTable() {
      const table = $(this.$el.querySelector('#contactsTable')).DataTable();
      table.ajax.reload();
    },
    deleteContact(contactId) {
      axios.delete(`/contacts/${contactId}`)
          .then(() => {
          this.reloadDataTable();
          })
          .catch(error => {
           console.error(error);
          });
    }
  },
};
</script>  
<style>
@import 'datatables.net-dt/css/jquery.dataTables.css';
</style>