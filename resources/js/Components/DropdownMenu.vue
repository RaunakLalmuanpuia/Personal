<template>
  <div class="relative" @mouseenter="openDropdown" @mouseleave="closeDropdown">
    <button
      class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 transition duration-150 ease-in-out border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300"
    >
      <slot name="trigger">Dropdown</slot>
    </button>

    <ul
      v-if="isOpen"
      class="absolute z-10 w-48 py-1 mt-2 bg-white border border-gray-300 rounded-lg shadow-lg"
      @mouseenter="openDropdown"
      @mouseleave="closeDropdown"
    >
      <slot name="items"></slot>
    </ul>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isOpen = ref(false);

const openDropdown = () => {
  isOpen.value = true;
};

const closeDropdown = () => {
  isOpen.value = false;
};
</script>
