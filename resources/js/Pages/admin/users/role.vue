<template>
  <div class="py-12 w-full">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
        <div class="flex p-2">
          <Link :href="route('admin.users.index')" class="px-4 py-2 bg-green-700 hover:bg-green-500 text-slate-100 rounded-md">Users Index</Link>

        </div>
        <div class="flex flex-col p-2 bg-slate-100">
          <div>User Name: {{ user.name }}</div>
          <div>User Email: {{ user.email }}</div>
        </div>
        <div class="mt-6 p-2 bg-slate-100">
          <h2 class="text-2xl font-semibold">Roles</h2>
          <div class="flex space-x-2 mt-4 p-2">
            <template v-if="user.roles.length > 0">
              <form v-for="role in user.roles" :key="role.id" @submit.prevent="removeRole(role.id)" class="px-4 py-2 bg-red-500 hover-bg-red-700 text-white rounded-md">
                <button type="submit">{{ role.name }}</button>
              </form>
            </template>
          </div>
          <div class="max-w-xl mt-6">
            <form @submit.prevent="assignRole">
              
              <div class="sm:col-span-6">
                <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                <select v-model="selectedRole" id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="role in roles" :value="role.name">{{ role.name }}</option>
                </select>
              </div>
              <span v-if="errors.role" class="text-red-400 text-sm">{{ errors.role }}</span>
              <div class="sm:col-span-6 pt-5">
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
              </div>
            </form>
          </div>
        </div>
        <div class="mt-6 p-2 bg-slate-100">
          <h2 class="text-2xl font-semibold">Permissions</h2>
          <div class="flex space-x-2 mt-4 p-2">
            <template v-if="userPermissions.length > 0">
              <form v-for="permission in userPermissions" :key="permission.id" @submit.prevent="revokePermission(permission.id)" class="px-4 py-2 bg-red-500 hover-bg-red-700 text-white rounded-md">
                <button type="submit">{{ permission.name }}</button>
              </form>
            </template>
          </div>
          <div class="max-w-xl mt-6">
            <form @submit.prevent="givePermission">
             
              <div class="sm:col-span-6">
                <label for="permission" class="block text-sm font-medium text-gray-700">Permission</label>
                <select v-model="selectedPermission" id="permission" name="permission" autocomplete="permission-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="permission in permissions" :value="permission.name">{{ permission.name }}</option>
                </select>
              </div>
              <span v-if="errors.permission" class="text-red-400 text-sm">{{ errors.permission }}</span>
              <div class="sm:col-span-6 pt-5">
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
 import { Link } from '@inertiajs/vue3'
export default {
  components: {
        Link,
    },
  props: ['user', 'userRoles', 'userPermissions', 'roles', 'permissions'],
  data() {
    return {
      selectedRole: '',
      selectedPermission: '',
      errors: {},
    };
  },
  methods: {
    assignRole() {
      this.$inertia.post(route('admin.users.roles', this.user.id), {
        role: this.selectedRole,
      });
    },
    removeRole(roleId) {
      if (confirm('Are you sure you want to remove the role?')) {
        this.$inertia.delete(route('admin.users.roles.remove', { user: this.user.id, role: roleId }));
      }
    },
    givePermission() {
      this.$inertia.post(route('admin.users.permissions', this.user.id), {
        permission: this.selectedPermission,
      });
    },
    revokePermission(permissionId) {
      if (confirm('Are you sure?')) {
        this.$inertia.delete(route('admin.users.permissions.revoke', { user: this.user.id, permission: permissionId }));
      }
    },
  },
};
</script>
