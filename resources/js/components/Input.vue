<template>
    <input class="h-11 border-none bg-gray-100 focus:ring-2 focus:border-transparent focus:ring-green-400 text-md placeholder-gray-500 text-gray-600 rounded-md shadow-md"
        :value="value"
        @input="$emit('input', $event.target.value)"
    >
</template>

<script>
export default {
    props: ['value'],
    emits: ['input'],
}
</script>
