<template>

    <div :class="{'column':true, 'is-10':sidebarExists, 'is-12':!sidebarExists}">
        <div id="posts" > 
            <post-group 
                :settings="settings"
                size="large" 
                title="Hot Posts"
                apisource="/api/hot/4"
            ></post-group>
            
            <post-group 
                :settings="settings"
                size="small" 
                title="Latest Posts"
                apisource="/api/posts/18"
            ></post-group>
        </div>
    </div>

</template>
<script>
    export default {
        props:['settings'],
        computed: {
            sidebarExists: function(){
                if (this.settings.sidebar == "left" || this.settings.sidebar == "right") {
                    return true;
                }
                return false;
            }
        }

    }
</script>