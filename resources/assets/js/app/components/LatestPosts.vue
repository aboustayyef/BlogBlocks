<template>
    <div>
        <h3 class="pop">Recent Posts</h3>
        <div class="columns is-mobile is-multiline" v-if="loaded">
            <div v-for="post in posts" class="column is-2-desktop is-2-tablet is-6-mobile">
              <post-card :post="post" small="true"></post-card>
            </div>
        </div>
        <div v-else>
            Loading ...
        </div>
    </div>

</template>

<script>
    export default {
        data(){
            return {
                posts:[],
                loaded:false
            }
        },
        mounted() {
            axios.get('/api/posts').then((res)=>{
                this.posts = res.data;
                this.loaded = true;
            });
        }
    }
</script>
