<template>
  <div class="">
    <div class="modal" tabindex="-1" role="dialog" ref="confirmationModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm Deletion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this user?</p>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-primary mr-2" @click="deleteUser">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <div class="alert alert-danger" v-if="isForbidden">
      <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
      <span>
            <b> Oops - </b> Unable to delete the last user.</span>
    </div>
    <table class="table tablesorter" id="">
      <thead class=" text-primary">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Date Created</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users">
        <td>{{ user.name }}</td>
        <td>
          <a :href="'mailto:' + user.email">{{ user.email }}</a>
        </td>
        <td>
          <span v-if="user.roles.length > 0">{{ user.roles[0].name }}</span>
          <span v-else>-</span>
        </td>
        <td>{{ user.created_at }}</td>
        <td class="text-right">
          <a :href="'/users/update/' + user.id" class="btn btn-sm btn-primary">
            <i class="tim-icons icon-pencil"></i>
          </a>
          <button class="btn btn-sm btn-primary" @click="confirmDelete(user.id)">
            <i class="tim-icons icon-trash-simple"></i>
          </button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
  export default {
    name: 'UsersTable',
    data () {
      return {
        users: [],
        toDelete: null,
        isForbidden: false
      }
    },
    mounted () {
      window.axios.get('/users/list')
        .then((res) => {
          if (res.status === 200) {
            this.users = res.data
          }
        })
    },
    methods: {
      confirmDelete (id) {
        this.toDelete = id
        $(this.$refs.confirmationModal).modal('show')
      },
      deleteUser() {
        this.isForbidden = false
        window.axios.post('/users/delete', {
          '_method': 'delete',
          'id': this.toDelete
        }).then((res) => {
          location.reload()
        }).catch((error) => {
          $(this.$refs.confirmationModal).modal('hide')
          if (error.response.status === 403) {
            this.isForbidden = true
          }
        })
      }
    }
  }
</script>
