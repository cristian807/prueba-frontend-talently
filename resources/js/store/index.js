import Vue from 'vue'
import Vuex from 'vuex'
import VerifiteStatusCode from './Errors/VerifiteStatusCode'
import AuthenticationStore from './AuthenticationStore'
import CardsStore from './CardsStore'
Vue.use(Vuex)

const store =new Vuex.Store({
    modules: {
      VerifiteStatusCode,
      AuthenticationStore,
      CardsStore,
    }
})


export default store
