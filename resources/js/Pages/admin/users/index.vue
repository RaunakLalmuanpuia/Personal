<template>
    <AppLayout>
    <div class="w-full py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                          Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                          Email
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="user in users" :key="user.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            {{ user.name }}
                          </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="flex items-center">
                            {{ user.email }}
                          </div>
                        </td>
                        <td>
                          <div class="flex justify-end">
                            <div class="flex space-x-2">
                                <Link :href="route('admin.users.show', user.id)" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">Roles</Link>
                              <!-- <inertia-link :href="route('admin.users.show', user.id)" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-700">Roles</inertia-link> -->
                              <form id="submit"
    class="px-4 py-2 text-white bg-red-500 rounded-md hover-bg-red-700"
    @submit.prevent="deleteUser(user.id)"
  >
                            
                                <button type="submit">Delete</button>
                              </form>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
  </template>
  
  <script>
  import { Link } from '@inertiajs/vue3'
  import AppLayout from '@/Layouts/AppLayout.vue';
  export default {
    components: {
        Link,
        AppLayout
    },

    props: {
      users: Array,
    },
    methods: {
      deleteUser(userId) {
        this.$inertia.delete(route('admin.users.destroy', userId));
      },
    },
  };
  </script>
  