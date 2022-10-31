import { instance } from "./InstanceAxios"

export const CardsServices={
    async get_cards(){
        return await instance.get('/api/cards')
    },

    async addCard(datas){
        return await instance.post('/api/cards',datas)
    },
    async editCard(id,datas){
        return await instance.put('/api/cards/'+id,datas)
    }
}
