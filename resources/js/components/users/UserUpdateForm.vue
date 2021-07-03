<template>
  <div class="card-body" :style="[ isSubmitting === true ? 'cursor: progress' : 'cursor: default']">
    <div class="alert alert-danger" v-if="hasOtherError">
      <span>
            <b> Oops - </b> An error has been encountered. Please try again in a few minutes</span>
    </div>
    <div class="form-group">
      <label for="name">Name*</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Name" v-model="name"
             :disabled="isSubmitting">
      <small class="text-danger" v-if="validationErrors['name']">{{ validationErrors['name'][0] }}</small>
    </div>

    <div class="form-group">
      <label for="email">Email Address*</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="Email Address" required
             v-model="email" :disabled="isSubmitting">
      <small class="text-danger" v-if="validationErrors['email']">{{ validationErrors['email'][0] }}</small>
    </div>

    <div class="form-group">
      <label for="role">Role*</label>
      <select name="role" id="role" class="form-control" required v-model="role" :disabled="isSubmitting">
        <option value="" disabled selected>Select a Role</option>
        <option v-for="role in roles" :value="role.id" :key="role.id">{{ role.name }}</option>
      </select>
      <small class="text-danger" v-if="validationErrors['role']">{{ validationErrors['role'][0] }}</small>
    </div>

    <div class="form-group">
      <label for="password">Password*</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Password"
             v-model="password" required :disabled="isSubmitting">
      <small class="text-danger" v-if="validationErrors['password']">{{ validationErrors['password'][0] }}</small>
    </div>

    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
             v-model="password_confirmation" placeholder="Confirm Password" required :disabled="isSubmitting">
      <small class="text-danger" v-if="validationErrors['password_confirmation']">{{ validationErrors['password_confirmation'][0] }}</small>
    </div>

    <div class="card-footer text-right">
      <button type="submit" class="btn btn-fill btn-primary" @click="submit" :disabled="isSubmitting">
        Create User
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserCreateForm',
  data () {
    return {
      roles: [],
      name: this.user.name,
      email: this.user.email,
      role: this.user.roles[0].id,
      password: '',
      password_confirmation: '',
      validationErrors: {
        name: '',
        email: '',
        role: '',
        password: '',
        password_confirmation: ''
      },
      isSubmitting: false,
      hasOtherError: false
    }
  },
  props: {
    user: {
      type: Object,
      required: true
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
    submit () {
      this.initErrors()
      this.isSubmitting = true
      this.hasOtherError = false
      window.axios.post('/users/create', {
        'name': this.name,
        'email': this.email,
        'role': this.role,
        'password': this.password,
        'password_confirmation': this.password_confirmation
      }).then((res) => {
        this.isSubmitting = false
        window.location = '/users'
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
        email: '',
        role: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
}
</script>
