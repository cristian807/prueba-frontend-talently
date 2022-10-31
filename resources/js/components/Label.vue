<template>
    <label class="block mt-2 font-semibold text-sm text-gray-600 dark:text-gray-200">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot/></span>
    </label>
</template>

<script>
export default {
    props: ['value']
}
</script>
