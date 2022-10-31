<template>
    <div v-if="stateErrors.data?.[file]" class="text-red-400 font-medium text-sm mt-2">
        {{stateErrors.data?.[file][0]}}
    </div>
</template>
<script>

import store from '../store';

export default{
    data:()=>{
        const stateErrors=store.getters.getResponseHttp
        return{
            stateErrors
        }
    },
    props:{
         file:{
            type:String
        }
    },
}
</script>
