<template>
    <div class="bg-white shadow rounded px-3 pt-3 pb-5 border border-white">
        <div class="flex justify-between">
            <p :class="{'text-red-400': verifiteCurrenDate}" class="text-gray-700 font-semibold font-sans tracking-wide text-sm">{{task.name}}</p>
            <img
                class="w-6 h-6 rounded-full ml-3"
                src="https://pickaface.net/gallery/avatar/unr_sample_161118_2054_ynlrg.png"
                alt="Avatar"
            >
        </div>
        <div class="flex mt-4 justify-between items-center">
            <span class="text-sm text-gray-600">{{task.date_delivery}}</span>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        task: {
            type: Object,
            default: () => ({})
        }
    },
    data(){
        return{
            current_date:new Date().toLocaleDateString(),
            dataCard:this.task.date_delivery
        }
    },
    computed:{
        verifiteCurrenDate(date){
            let dateCard=new Date(this.dateCard)
            let current_date=new Date(this.current_date)

            return (dateCard<current_date)
        }
    }
};
</script>
