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
          <a :href="'mailto:' + user.email">user.email</a>
        </td>
        <td>
          <span v-if="user.roles.length > 0">{{ user.roles[0].name }}</span>
          <span v-else>-</span>
        </td>
        <td>{{ user.created_at }}</td>
        <td class="text-right">
          <div class="dropdown">
            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"
                 x-placement="bottom-end"
                 style="position: absolute; transform: translate3d(-111px, 27px, 0px); top: 0px; left: 0px; will-change: transform;">
              <a class="dropdown-item" href="#">Edit</a>
            </div>
          </div>
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
