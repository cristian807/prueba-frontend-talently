import router from "../routes"
import { instance } from "../Services/InstanceAxios"
import { LoginService } from "../Services/LoginServices"

const AuthenticationStore =({
    state:()=>({
        datas:{}
    }),

    mutations: {
        SET_AUTHENTICATION(state, response){
            state.datas= response
            instance.defaults.headers.common['Authorization'] ='Bearer '+ response?.token
            localStorage.setItem('Authentication',JSON.stringify(response))
        },

        CLEAR_AUTHENTICATION(state){
            state.datas= {}
            instance.defaults.headers.common['Authorization'] =null
            localStorage.removeItem('Authentication')
            router.push({name:'login'})
        },
    },
    actions: {
        set_authentication(context,datas){
            context.commit('SET_AUTHENTICATION', datas)
        },
        clear_authentication(context){
            LoginService.logout()
            .then(()=>{
                context.commit('CLEAR_AUTHENTICATION')
            })
            .catch((errors)=>{
                console.log(errors)
            })
        }

    }
})

export default AuthenticationStore
