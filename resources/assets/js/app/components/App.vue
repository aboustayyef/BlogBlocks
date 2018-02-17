<template>
    <div>
        <post-group 
            size="large" 
            title="Hot Posts"
            apisource="/api/hot/4"
        ></post-group>
        
        <post-group 
            size="small" 
            title="Latest Posts"
            apisource="/api/posts/18"
        ></post-group>
    </div>
</template>
<script>
    export default {
        data: function(){
            return {
                settings: {}
            }
        }
    }
</script>