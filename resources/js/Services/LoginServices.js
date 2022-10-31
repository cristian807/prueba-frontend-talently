import { instance } from "./InstanceAxios"

export const LoginService={
    async login(datas){
        return await instance.post('/api/login',datas)
    },
    async register(datas){
        return await instance.post('/api/register',datas)
    },
    async logout(){
        return await instance.post('/api/logout')
    },
    async csrf(){
        return await instance.get('/sanctum/csrf-cookie')
    }
}
