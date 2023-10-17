<script setup>
const { userRole, userPermissions } = defineProps(['userRole', 'userPermissions']);
</script>

<template>
    <div v-if="userRole === 'teacher'">
        Hello
    </div>
    <div v-if="$page.props.role==='teacher'">
        Hello
    </div>
</template>
