<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Welcome from '@/Components/Welcome.vue';
import { defineProps } from 'vue';
import { ref, computed } from 'vue';
// Define props
const { userRole, userPermissions } = defineProps(['userRole', 'userPermissions']);



// Check if the user has a specific permission
const userHasPermission = (permission) => {
  return userPermissions.includes(permission);
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
            
        </template>
        

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <Welcome />
                      <!-- This div will only be shown if the user has the 'admin' role -->
                    <div v-if="userRole === 'admin'">
                        <p>Welcome, Admin!</p>
                        </div>
                <!-- This div will only be shown if the user has the 'player' role -->
                        <div v-if="userHasPermission('create course')">
                        <p>Welcome, asdasas!</p>
                        </div>

                        <div v-if="userRole === 'teacher'">
                        <p>Welcome, teacher!</p>
                        </div>

                        <div v-if="userRole === 'student'">
                        <p>Welcome, Student!</p>
                        </div>

                        <div v-if="userHasPermission('view lecture')">
                        <p>Welcome, asdasas!</p>
                        </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
