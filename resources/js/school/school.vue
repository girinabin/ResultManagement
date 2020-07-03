<template>

<div class="col-md-6 offset-3">
        <div class="form-group">
            <label for="">Select School</label>
            <select name="school" id="school" class="form-control" @change="findSclass($event)">
                <option value="" disabled selected>Choose School</option>
                
                <option v-for="(item,index) in items" :key="index" v-bind:value="item.school_name" >{{item.school_name}} </option>
               
                
            </select>
        </div>
    <sclass-component :item="school" :classes="classes"></sclass-component>

    </div>
    
    
</div>
    
</template>
<script>
import Sclass from "../sclass/sclass.vue";
import axios from "axios";

export default {
    props:['items'],
    components:{
        "sclass-component":Sclass
    },
    data:function(){
        return {
            school:"",
            classes:""
        }
        
    },
    methods:{
        findSclass:function(event){
            this.school = event.target.value;
            axios.post('/api/school/class',{school:this.school})
            .then(res=>{
                this.classes = res.data[0]
            });

        }
    }

};
</script>
