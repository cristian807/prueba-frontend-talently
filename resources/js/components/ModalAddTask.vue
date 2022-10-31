<template>
    <div v-if="open" class="relative z-10">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex">
                            <span class=" font-medium text-xl mb-5">
                                {{title}}
                            </span>
                        </div>
                        <div class="">
                            <slot/>
                        </div>
                        <slot name="buttons"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{

        emits:['addTask'],
        props:{
            open:Boolean,
            title:String,
            buttonTitle:String
        },
        methods: {
            emitEvent(){
                this.$emit('addTask')
            },
        },
    }
</script>
