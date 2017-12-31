<template>
    <div>
        <h3 class="title is-4">Recent Posts</h3>
        <div class="columns is-multiline" v-if="loaded">
            <div v-for="post in posts" class="column is-one-fifth">
              <post-card :post="post"></post-card>
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
