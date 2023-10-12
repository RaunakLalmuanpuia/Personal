<template>
    <div class="py-12 w-full">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
          <div class="flex p-2">
            <Link :href="route('admin.permissions.index')" class="px-4 py-2 bg-green-700 hover:bg-green-500 text-slate-100 rounded-md">Permission Index</Link>

          </div>
          <div class="flex flex-col">
            <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
              <form @submit.prevent="submitForm" method="POST">
            
                <div class="sm:col-span-6">
                  <label for="name" class="block text-sm font-medium text-gray-700"> Permission name </label>
                  <div class="mt-1">
                    <input v-model="form.name" type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                  </div>
                  <span v-if="form.errors.name" class="text-red-400 text-sm">{{ form.errors.name[0] }}</span>
                </div>
                <div class="sm:col-span-6 pt-5">
                  <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Create</button>
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
    
    data() {
      return {
        form: {
          name: '',
          errors: {},
        },
      };
    },
    methods: {
      submitForm() {
        this.$inertia.post(route('admin.permissions.store'), this.form, {
          onSuccess: () => {
            // Redirect to the index page or show a success message if needed
            this.$inertia.visit(route('admin.permissions.index'));
          },
          onError: (errors) => {
            // Handle validation errors
            this.form.errors = errors;
          },
        });
      },
    },
  };
  </script>
  