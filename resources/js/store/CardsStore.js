import router from "../routes"
import { CardsServices } from "../Services/CardsServices"
import { instance } from "../Services/InstanceAxios"

const CardsStore =({
    state:()=>({
        cards:{}
    }),

    getters:{
        get_cards(state){
            return state.cards
        },
    },
    mutations: {
        SET_CARDS(state, response){
            state.cards= response
        },
    },
    actions: {
        set_cards(context){
            CardsServices.get_cards()
            .then(response=>{
                context.commit('SET_CARDS', response.data.datas)
            })
        },
    }
})

export default CardsStore
