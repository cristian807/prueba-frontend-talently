<template>
    <GuestLayoutVue>
        <form @submit.prevent="login">
            <div class="mb-4 text-center">
                <Label value="Registro" class="text-lg"/>
            </div>
            <div class="mb-2 w-full">
                <Label value="Nombre"/>
                <InputVue type="text" v-model="form.name" class="mt-1 block w-full" placeholder="Nombre completo"/>
                <VerifiteErrorsValidations file="name"/>
            </div>

            <div class="mb-2 w-full">
                <Label value="Email"/>
                <InputVue type="text" v-model="form.email" class="mt-1 block w-full" placeholder="Correo electronico"/>
                <VerifiteErrorsValidations file="email"/>
            </div>

            <div class="mb-4 w-full">
                <Label value="Password"/>
                <InputVue type="password" v-model="form.password" class="mt-1 block w-full" placeholder="Contraseña"/>
                <VerifiteErrorsValidations file="password"/>
            </div>

            <div class="mb-4 w-full">
                <Label value="Confirmar contraseña"/>
                <InputVue type="password" v-model="form.password_confirmation" class="mt-1 block w-full" placeholder="Contraseña"/>
                <VerifiteErrorsValidations file="password_confirmation"/>
            </div>

            <div class="mb-4">
                <router-link :to="{name:'login'}" class="hover:underline">Ya tengo una cuenta</router-link>
            </div>

            <ButtonDefault>
                Registrar
            </ButtonDefault>
        </form>
    </GuestLayoutVue>
</template>
<script>
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
                name:'',
                email:'',
                password:'',
                password_confirmation:'',
            }
        }
    },
    methods:{
        login(){
            LoginService.register(this.form)
            .then(response=>{
                this.resetForm()
            })
            .catch(error=>{
                store.dispatch('setResponseHttp',error)
            })
        },
        resetForm(){
            this.form.name=''
            this.form.email=''
            this.form.password=''
            this.form.password_confirmation=''
        }
    }
}
</script>
