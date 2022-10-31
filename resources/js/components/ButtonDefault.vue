<template>
    <button class="w-full bg-blue-400 rounded-sm shadown-md text-gray-50 h-11">
        <span v-if="value">
            {{value}}
        </span>
        <slot v-else/>
    </button>
</template>
<script>
export default{
    props:{
        value:{
            type:String,
        }
    }
}
</script>
