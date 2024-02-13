<template lang="">
    <form class="py-3 px-4 flex items-center">
    <label class="sr-only">Search</label>
    <div class="relative w-full">
        <input type="text" @input="search" placeholder="Search" class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-900 rounded-md placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
    </div>
</form>

</template>

<script setup>

const emit = defineEmits(['search'])

const search = (e) => {
    emit("search", e.target.value)
}
</script>

