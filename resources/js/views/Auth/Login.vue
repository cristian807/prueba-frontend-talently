<template>
    <GuestLayoutVue>
        <form @submit.prevent="login">
            <div class="mb-4 text-center">
                <Label value="Login" class="text-lg"/>
            </div>
            <div class="mb-2 w-full">
                <Label value="Email"/>
                <InputVue type="text" v-model="form.email" class="mt-1 block w-full" placeholder="Email"/>
                <VerifiteErrorsValidations file="email"/>
            </div>

            <div class="mb-4 w-full">
                <Label value="Pssword"/>
                <InputVue type="password" v-model="form.password" class="mt-1 block w-full" placeholder="Contraseña"/>
                <VerifiteErrorsValidations file="password"/>
            </div>
            <div class="mb-4">
                <router-link :to="{name:'register'}" class="hover:underline">¿No estas registrado?</router-link>
            </div>

            <ButtonDefault>
                Ingresar
            </ButtonDefault>
        </form>
    </GuestLayoutVue>
</template>
<script>
import routes from '../../routes';
import store from '../../store/index'
import Label from '../../components/Label.vue'
import InputVue from '../../components/Input.vue';
import GuestLayoutVue from '../../Layouts/GuestLayout.vue';
import { LoginService } from '../../Services/LoginServices'
import ButtonDefault from '../../components/ButtonDefault.vue';
import VerifiteErrorsValidations from '../../components/VerifiteErrorsValidations.vue';

export default{
    components:{
        Label,
        InputVue,
        GuestLayoutVue,
        VerifiteErrorsValidations,
        ButtonDefault
    },
    data(){
        return{
            form:{
                email:'developer.cristian.m@gmail.com',
                password:'123456789'
            }
        }
    },
    methods:{
        login(){
            LoginService.csrf()
            .then(()=>{
                LoginService.login(this.form)
                .then(response=>{
                    store.dispatch('set_authentication',response.data)
                    routes.push({name:'dashboard'})
                })
                .catch(error=>{
                    store.dispatch('setResponseHttp',error)
                })
            })
        }
    }
}
</script>
