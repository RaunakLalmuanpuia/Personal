<template>
    <app-layout>
        <div class="w-full py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-2 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="flex p-2">
                        <Link
                            :href="route('admin.roles.index')"
                            class="px-4 py-2 bg-green-700 rounded-md hover:bg-green-500 text-slate-100"
                            >Role Index</Link
                        >
                    </div>
                    <div class="flex flex-col p-2 bg-slate-100">
                        <div
                            class="w-1/2 mt-10 space-y-8 divide-y divide-gray-200"
                        >
                            <form @submit.prevent="updateRole">
                                <div class="sm:col-span-6">
                                    <label
                                        for="name"
                                        class="block text-sm font-medium text-gray-700"
                                        >Role name</label
                                    >
                                    <div class="mt-1">
                                        <input
                                            v-model="form.name"
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5"
                                        />
                                    </div>
                                    <div
                                        v-if="errors.name"
                                        class="text-sm text-red-400"
                                    >
                                        {{ errors.name }}
                                    </div>
                                </div>
                                <div class="pt-5 sm:col-span-6">
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-green-500 rounded-md hover:bg-green-700"
                                    >
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="p-2 mt-6 bg-slate-100">
                        <h2 class="text-2xl font-semibold">Role Permissions</h2>
                        <div class="flex p-2 mt-4 space-x-2">
                            <template
                                v-if="
                                    role.permissions &&
                                    role.permissions.length > 0
                                "
                            >
                                <form
                                    v-for="(
                                        rolePermission, index
                                    ) in role.permissions"
                                    :key="index"
                                    @submit.prevent="
                                        revokePermission(rolePermission.id)
                                    "
                                    class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-700"
                                    :action="
                                        route(
                                            'admin.roles.permissions.revoke',
                                            [role.id, rolePermission.id]
                                        )
                                    "
                                    method="post"
                                    @submit="
                                        confirmRevoke(
                                            rolePermission.name,
                                            rolePermission.id
                                        )
                                    "
                                >
                                    <button type="submit">
                                        {{ rolePermission.name }}
                                    </button>
                                </form>
                            </template>
                        </div>
                        <div class="max-w-xl mt-6">
                            <form @submit.prevent="assignPermission">
                                <div class="sm:col-span-6">
                                    <label
                                        for="permission"
                                        class="block text-sm font-medium text-gray-700"
                                        >Permission</label
                                    >
                                    <select
                                        v-model="form.permission"
                                        id="permission"
                                        name="permission"
                                        autocomplete="permission-name"
                                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus-outline-none focus-ring-indigo-500 focus-border-indigo-500 sm-text-sm"
                                    >
                                        <option value="" disabled>
                                            Select a permission
                                        </option>
                                        <option
                                            v-for="permission in permissions"
                                            :key="permission.name"
                                            :value="permission.name"
                                        >
                                            {{ permission.name }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="errors.permission"
                                        class="text-sm text-red-400"
                                    >
                                        {{ errors.permission }}
                                    </div>
                                </div>
                                <div class="pt-5 sm:col-span-6">
                                    <button
                                        type="submit"
                                        class="px-4 py-2 bg-green-500 rounded-md hover:bg-green-700"
                                    >
                                        Assign
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        AppLayout,
        Link,
    },

    props: {
        role: Object,
        permissions: Array,
        rolePermission: Array,
    },
    data() {
        return {
            form: {
                name: this.role.name,
                permission: "",
            },
            errors: {},
        };
    },
    methods: {
        updateRole() {
            this.$inertia.put(
                route("admin.roles.update", this.role.id),
                this.form,
                {
                    onSuccess: () => {
                        // Handle success, e.g., show a success message
                    },
                    onError: (errors) => {
                        this.errors = errors;
                    },
                }
            );
        },
        assignPermission() {
            this.$inertia.post(
                route("admin.roles.permissions", this.role.id),
                this.form,
                {
                    onSuccess: () => {
                        // Handle success
                        this.form.permission = ""; // Clear the form
                    },
                    onError: (errors) => {
                        this.errors = errors;
                    },
                }
            );
        },
        revokePermission(permissionId) {
            this.$inertia.delete(
                route("admin.roles.permissions.revoke", [
                    this.role.id,
                    permissionId,
                ]),
                {
                    onSuccess: () => {
                        // Handle success
                    },
                    onError: (errors) => {
                        // Handle errors, if any
                    },
                }
            );
        },
        confirmRevoke(permissionName, permissionId) {
            if (
                !confirm(
                    `Are you sure you want to revoke permission: ${permissionName}?`
                )
            ) {
                return false;
            }
        },
    },
};
</script>
