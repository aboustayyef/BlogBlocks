<template>

    <div :class="{'column':true, 'is-10':settings.sidebar_on, 'is-12':!settings.sidebar_on}">
        <div id="posts" > 
            <post-group 
                :settings="settings"
                size="large" 
                title="Hot Posts"
                :apisource= "hotPostsApiSource"
            ></post-group>
            
            <post-group 
                :settings="settings"
                size="small" 
                title="Latest Posts"
                apisource="/api/posts/12"
            ></post-group>
        </div>
    </div>

</template>
<script>
    export default {
        props:['settings','tag'],
        computed: {
            hotPostsApiSource: function(){
                if (this.tag) {
                  return '/api/hot/4/' + this.tag;  
                }
                return '/api/hot/4';
            },
            latestPostsApiSource: function(){
                if (this.tag) {
                    return '/api/posts/12'
                }
                return '/api/posts/12';
            },    
        }
    }
</script>