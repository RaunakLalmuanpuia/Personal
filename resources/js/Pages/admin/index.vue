<template>
<app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   Admin Contents
                </div>
            </div>
        </div>

        <Link :href="route('admin.roles.index')" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">Roles</Link>

        <Link :href="route('admin.permissions.index')" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">Permissions</Link>
        
        <Link :href="route('admin.users.index')" class="px-4 py-2 bg-green-700 hover:bg-green-500 rounded-md">Users</Link>
    </div>
</app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import JetButton from '@/Components/PrimaryButton.vue'
import { Link } from '@inertiajs/vue3'
export default {
    components: {
        AppLayout,
        JetButton,
        Link,
       
    },
    props: {
         
    },
    data(){
        return {
            acting:null,
            method:null,
            action:null,
            
        }
    }
    
}
</script>