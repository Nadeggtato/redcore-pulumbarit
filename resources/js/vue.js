import Vue from 'vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('users-table', require('./components/users/UsersTable').default)
Vue.component('user-create-form', require('./components/users/UserCreateForm').default)
Vue.component('user-update-form', require('./components/users/UserUpdateForm').default)

Vue.component('roles-table', require('./components/roles/RolesTable').default)
Vue.component('role-create-form', require('./components/roles/RoleCreateForm').default)
Vue.component('role-update-form', require('./components/roles/RoleUpdateForm').default)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.vue = new Vue({
    el: '#app',
})
