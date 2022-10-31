<template>
    <router-view></router-view>
</template>
<script>
import store from '../store'

export default{
    created(){
        const userString=localStorage.getItem('Authentication')

        if (userString) {
            const userData=JSON.parse(userString)
            store.dispatch('set_authentication',userData)
        }
    }
}
</script>
