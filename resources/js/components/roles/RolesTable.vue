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
            <p>Are you sure you want to delete this role?</p>
          </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-primary mr-2" @click="deleteRole">Yes</button>
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
            <b> Oops - </b> {{ errorMessage }}</span>
    </div>
    <table class="table tablesorter" id="">
      <thead class=" text-primary">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="role in roles">
        <td>{{ role.name }}</td>
        <td>{{ role.description }}</td>
        <td class="text-right">
          <a :href="'/roles/update/' + role.id" class="btn btn-sm btn-primary">
            <i class="tim-icons icon-pencil"></i>
          </a>
          <button class="btn btn-sm btn-primary" @click="confirmDelete(role.id)">
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
  name: 'RoleTable',
  data () {
    return {
      roles: [],
      toDelete: null,
      isForbidden: false,
      errorMessage: ''
    }
  },
  mounted () {
    window.axios.get('/roles/list')
      .then((res) => {
        if (res.status === 200) {
          this.roles = res.data
        }
      })
  },
  methods: {
    confirmDelete (id) {
      this.toDelete = id
      $(this.$refs.confirmationModal).modal('show')
    },
    deleteRole() {
      this.isForbidden = false
      this.errorMessage = ''
      window.axios.post('/roles/delete', {
        '_method': 'delete',
        'id': this.toDelete
      }).then((res) => {
        location.reload()
      }).catch((error) => {
        $(this.$refs.confirmationModal).modal('hide')
        if (error.response.status === 403) {
          this.isForbidden = true
          this.errorMessage = error.response.data.error
        }
      })
    }
  }
}
</script>
