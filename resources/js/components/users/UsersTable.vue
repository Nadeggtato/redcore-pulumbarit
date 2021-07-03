<template>
  <div class="">
    <table class="table tablesorter " id="">
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
          <a href="#" class="btn btn-sm btn-primary"><i class="tim-icons icon-trash-simple"></i></a>
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
        users: []
      }
    },
    mounted () {
      window.axios.get('/users/list')
        .then((res) => {
          if (res.status === 200) {
            this.users = res.data
          }
        })
    }
  }
</script>
