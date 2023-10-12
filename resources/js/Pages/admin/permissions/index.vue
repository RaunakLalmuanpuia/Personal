<template>
    <div class="py-12 w-full">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
          <div class="flex justify-end p-2">
            <Link :href="route('admin.permissions.create')" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">Create Permission</Link>
            
          </div>
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <template v-for="(permission, index) in permissions" :key="index">
                        <tr>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">{{ permission.name }}</div>
                          </td>
                          <td>
                            <div class="flex justify-end">
                              <div class="flex space-x-2">
                                <Link :href="route('admin.permissions.edit', permission.id)" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">Edit</Link>
                                
                               
                                <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" @submit.prevent="confirmDelete(permission.id)"  :action="route('admin.permissions.destroy', permission.id)" method="post">
                                  <!-- @csrf
                                  @method('DELETE') -->
                                  <button type="submit">Delete</button>
                                </form>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </template>
                    </tbody>
                  </table>
                </div>
              </div>
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
    props: {
      permissions: Array,
    },
    methods: {
      confirmDelete(permissionId) {
        if (confirm('Are you sure you want to delete this permission?')) {
          this.$inertia.delete(route('admin.permissions.destroy', permissionId));
        }
      },
    },
  };
  </script>
  