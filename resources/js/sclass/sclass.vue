<template>
    
        <div class="form-group">
            <label for="">Select Class</label>
            <select name="school" id="school" class="form-control">
                <option value="" disabled selected>Choose Class</option>
                
               
                <option v-for="(sclass,index) in classes" :key="index" value="">{{sclass.name}}</option>
                
            </select>
            {{ item }}
        </div>
   
</template>
<script>
export default {
    props:['item','classes']
};
</script>
