<template>
    <div class="flex justify-center">
        <button @click="sesion_destroy()" class="fixed right-4 top-4">
            Cerrar sesion
        </button>
        <div class="min-h-screen flex overflow-x-scroll max-w-4xl w-full py-12">
            <div
                v-for="data in datas"
                :key="data.name"
                class="bg-gray-100 rounded-lg px-3 py-3 max-w-lg w-full rounded mr-4"
            >
                <div class="flex justify-between">
                    <p class="text-gray-700 font-semibold font-sans tracking-wide text-sm">
                        {{data.name}}
                        <span class="ml-4 text-gray-500">
                            {{Object.keys(data.cards).length}}
                        </span>
                    </p>
                    <button class="px-3 py-1" @click="openModalAddTask(data.id)">
                        Add
                    </button>
                </div>
                <draggable :list="data.cards" :animation="200" ghost-class="ghost-card" group="tasks">
                    <div  v-for="(card) in data.cards" :key="card.id" @dblclick="EditTask(card)">
                        <task-card
                            :task="card"
                            class="mt-3 cursor-move"
                        />
                    </div>
                </draggable>
            </div>
        </div>
        <ModalAddTask :open="openModalAdd" title="Agregar tareas" @addTask="storeTask()" buttonTitle="Agregar tarea">
            <div class="">
                <div class="mb-4">
                    <LabelVue value="Nombre"/>
                    <InputVue class="w-full" type="text" v-model="formAddTask.name" placeholder="Nombre de la tarea"/>
                </div>

                <div class="mb-4">
                    <LabelVue value="Fecha de entrega"/>
                    <InputVue class="w-full" v-model="formAddTask.date_delivery" type="date"/>
                </div>
            </div>
            <template #buttons>
                <div class="flex items-center justify-end mt-4">
                    <button @click="openModalAdd=false" class="px-3 py-2 rounded-md mr-3">
                        Cancelar
                    </button>
                    <button @click="storeTask()" class="px-3 py-2 rounded-md bg-blue-500 text-white">
                        Agregar
                    </button>
                </div>
            </template>
        </ModalAddTask>

        <ModalAddTask :open="openModalEdit" title="Editar tareas" @addTask="updateTask()" buttonTitle="Editar tarea">
            <div class="">
                <div class="mb-4">
                    <LabelVue value="Nombre"/>
                    <InputVue class="w-full" type="text" v-model="formEditTask.name" placeholder="Nombre de la tarea"/>
                </div>

                <div class="mb-4">
                    <LabelVue value="Fecha de entrega"/>
                    <InputVue class="w-full"  v-model="formEditTask.date_delivery" type="date"/>
                </div>
            </div>
            <template #buttons>
                <div class="flex items-center justify-end mt-4">
                    <button @click="openModalEdit=false" class="px-3 py-2 rounded-md mr-3">
                        Cancelar
                    </button>
                    <button @click="updateTask()" class="px-3 py-2 rounded-md bg-blue-500 text-white">
                        Editar
                    </button>
                </div>
            </template>
        </ModalAddTask>

    </div>
</template>

<script>
import draggable from "vuedraggable";
import TaskCard from '../components/TaskCard.vue';
import ModalAddTask from '../components/ModalAddTask.vue';
import LabelVue from '../components/Label.vue';
import InputVue from '../components/Input.vue';
import {CardsServices} from '../Services/CardsServices'
export default {
    components: {
        TaskCard,
        draggable,
        ModalAddTask,
        LabelVue,
        InputVue
    },
    data(){
        return{
            openModalAdd:false,
            openModalEdit:false,
            formAddTask:{
                name:'',
                date_delivery:'',
                user_id:this.$store.state.AuthenticationStore.datas.datas.id,
                status_card_id:''
            },
            formEditTask:{
                id:'',
                name:'',
                date_delivery:'',
            }

        }
    },
    mounted(){
       this.get_cards()
    },
    methods:{
        get_cards(){
            this.$store.dispatch('set_cards')
        },
        openModalAddTask(id){
            this.openModalAdd=true
            this.formAddTask.status_card_id=id
        },
        storeTask(){
            CardsServices.addCard(this.formAddTask)
            .then(()=>{
                this.get_cards()
                this.$toastr.s("Card agregada exitosamente.");
                this.openModalAdd=false
            })
        },
        updateTask(){
            CardsServices.editCard(this.formEditTask.id, this.formEditTask)
            .then(()=>{
                this.get_cards()
                this.$toastr.s("Card editada exitosamente.");
                this.openModalEdit=false
            })
        },
        EditTask(datas){
            this.formEditTask=datas
            this.openModalEdit=true
        },
        sesion_destroy(){
            this.$store.dispatch('clear_authentication')
        },
    },
    computed:{
        datas(){
            return this.$store.state.CardsStore.cards
        }
    }
};
</script>

