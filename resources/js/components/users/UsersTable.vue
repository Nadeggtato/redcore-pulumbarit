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
    <div class="alert alert-danger" v-if="errorMessage !== ''">
      <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
        <i class="tim-icons icon-simple-remove"></i>
      </button>
      <span>
            <b> Oops - </b> {{ errorMessage }}</span>
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
          <a :href="'/users/update/' + user.id" class="btn btn-sm btn-primary" v-if="canEdit">
            <i class="tim-icons icon-pencil"></i>
          </a>
          <button class="btn btn-sm btn-primary" @click="confirmDelete(user.id)" v-if="canDelete">
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
        errorMessage: ''
      }
    },
    props: {
      canEdit: {
        type: Boolean,
        required: true
      },
      canDelete: {
        type: Boolean,
        required: true
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
        this.errorMessage = ''
        window.axios.post('/users/delete', {
          '_method': 'delete',
          'id': this.toDelete
        }).then((res) => {
          location.reload()
        }).catch((error) => {
          $(this.$refs.confirmationModal).modal('hide')
          if (error.response.status === 403) {
            if (error.response.error) {
              this.errorMessage = 'Unable to delete last user.'
            } else {
              this.errorMessage = 'You are not allowed to delete super admin.'
            }
          } else {
            this.errorMessage = 'There was an error processing your request. Please try again later.'
          }
        })
      }
    }
  }
</script>
