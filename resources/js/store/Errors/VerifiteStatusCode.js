const VerifiteStatusCode =({
    state:{
        data:{},
        status:0,
        message:'',
    },
    getters:{
        getResponseHttp(store,getters){
            return store
        }
    },
    mutations: {
        SET_RESPONSE_HTTP(state, response){
            state.data=response.data?.errors ?? response.response?.data?.errors
            state.status=response.status ?? response.response?.status
            state.message=response.data?.message ?? response.response?.data?.message
        },
    },
    actions: {
        setResponseHttp(context,datas){
            context.commit('SET_RESPONSE_HTTP', datas)
        }
    }
})

export default VerifiteStatusCode
