<template>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-2 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="flex p-2">
                    <Link
                        :href="route('admin.permissions.index')"
                        class="px-4 py-2 bg-green-700 rounded-md hover-bg-green-500 text-slate-100"
                        >Permission Index</Link
                    >
                </div>
                <div class="flex flex-col p-2 bg-slate-100">
                    <div class="w-1/2 mt-10 space-y-8 divide-y divide-gray-200">
                        <form @submit.prevent="submitForm" method="POST">
                            <div class="sm:col-span-6">
                                <label
                                    for="name"
                                    class="block text-sm font-medium text-gray-700"
                                >
                                    Permission name
                                </label>
                                <div class="mt-1">
                                    <input
                                        v-model="form.name"
                                        type="text"
                                        id="name"
                                        name="name"
                                        :placeholder="permission.name"
                                        class="block w-full px-3 py-2 text-base leading-normal transition duration-150 ease-in-out bg-white border border-gray-400 rounded-md appearance-none sm:text-sm sm:leading-5"
                                    />
                                </div>
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-400"
                                    >{{ form.errors.name[0] }}</span
                                >
                            </div>
                            <div class="pt-5 sm:col-span-6">
                                <button
                                    type="submit"
                                    class="px-4 py-2 bg-green-500 rounded-md hover-bg-green-700"
                                >
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="p-2 mt-6 bg-slate-100">
                    <h2 class="text-2xl font-semibold">Roles</h2>
                    <div class="flex p-2 mt-4 space-x-2">
                        <template v-if="rolesWithPermission">
                            <form
                                v-for="role in rolesWithPermission"
                                :key="role.id"
                                class="px-4 py-2 text-white bg-red-500 rounded-md hover-bg-red-700"
                                @submit.prevent="removeRole(role.id)"
                            >
                                <button type="submit">{{ role.name }}</button>
                            </form>
                        </template>
                    </div>
                    <div class="max-w-xl mt-6">
                        <form @submit.prevent="assignRole" method="POST">
                            <div class="sm:col-span-6">
                                <label
                                    for="role"
                                    class="block text-sm font-medium text-gray-700"
                                    >Roles</label
                                >
                                <select
                                    v-model="selectedRole"
                                    id="role"
                                    name="role"
                                    autocomplete="role-name"
                                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus-outline-none focus-ring-indigo-500 focus-border-indigo-500 sm-text-sm"
                                >
                                    <option
                                        v-for="role in roles"
                                        :key="role.id"
                                        :value="role.name"
                                    >
                                        {{ role.name }}
                                    </option>
                                </select>
                            </div>
                        </form>
                        <span
                            v-if="form.errors.role"
                            class="text-sm text-red-400"
                            >{{ form.errors.role[0] }}</span
                        >
                    </div>
                    <div class="pt-5 sm:col-span-6">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-green-500 rounded-md hover-bg-green-700"
                        >
                            Assign
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },

    data() {
        return {
            form: {
                name: this.permission.name,
                roles: [],
                errors: {},
            },
            selectedRole: "",
        };
    },
    props: {
        permission: {
            type: Object,
            required: true,
        },
        roles: {
            type: Array,
            required: true,
        },
        rolesWithPermission: {
            type: Object,
            required: true,
        },
    },
    methods: {
        submitForm() {
            this.$inertia.put(
                route(
                    "admin.permissions.update",
                    this.$page.props.permission.id
                ),
                this.form,
                {
                    onSuccess: () => {
                        this.$inertia.visit(route("admin.permissions.index"));
                    },
                    onError: (errors) => {
                        this.form.errors = errors;
                    },
                }
            );
        },
        assignRole() {
            this.$inertia.post(
                route("admin.permissions.roles", this.permission.id),
                { role: this.selectedRole },
                {
                    onSuccess: () => {
                        this.form.permission = ""; // Clear the form
                        // this.$inertia.visit(route("admin.permissions.index"));
                    },
                    onError: (errors) => {
                        this.form.errors = errors;
                    },
                }
            );
        },
        removeRole(roleId) {
            if (confirm("Are you sure?")) {
                this.$inertia.delete(
                    route("admin.permissions.roles.remove", [
                        this.$page.props.permission.id,
                        roleId,
                    ]),
                    {
                        onSuccess: () => {
                            this.$inertia.visit(
                                route("admin.permissions.index")
                            );
                        },
                    }
                );
            }
        },
    },
};
</script>
