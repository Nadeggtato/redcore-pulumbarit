<template>
  <div class="card-body" :style="[ isSubmitting === true ? 'cursor: progress' : 'cursor: default']">
    <div class="alert alert-danger" v-if="hasOtherError">
      <span>
            <b> Oops - </b> An error has been encountered. Please try again in a few minutes</span>
    </div>
    <div class="form-group">
      <label for="name">Role Name*</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="name"
             :disabled="isSubmitting">
      <small class="text-danger" v-if="validationErrors['name']">{{ validationErrors['name'][0] }}</small>
    </div>

    <div class="form-group">
      <label for="description">Role description*</label>
      <textarea name="description" id="description" rows="4" v-model="description" class="form-control"></textarea>
      <small class="text-danger" v-if="validationErrors['description']">{{ validationErrors['description'][0] }}</small>
    </div>

    <div class="card-footer text-right">
      <button type="submit" class="btn btn-fill btn-primary" @click="submit" :disabled="isSubmitting">
        Create Role
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'RoleCreateForm',
  data () {
    return {
      name: '',
      description: '',
      validationErrors: {
        name: '',
        description: ''
      },
      isSubmitting: false,
      hasOtherError: false
    }
  },
  methods: {
    submit () {
      this.initErrors()
      this.isSubmitting = true
      this.hasOtherError = false
      this.description = this.description.trim()
      window.axios.post('/roles/create', {
        'name': this.name,
        'description': this.description,
      }).then((res) => {
        this.isSubmitting = false
        window.location = '/roles'
      }).catch((error) => {
        this.isSubmitting = false
        if (error.response.status === 422) {
          Object.entries(error.response.data.errors).forEach((err) => {
            const [key, value] = err;
            this.validationErrors[key] = value
          })
        } else {
          this.hasOtherError = true
        }
      })
    },
    initErrors () {
      this.validationErrors = {
        name: '',
        description: '',
      }
    }
  },
}
</script>
