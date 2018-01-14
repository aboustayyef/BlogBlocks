<template>
    <div id="hotposts">
        <h3 class="title is-4">Hot Posts</h3>
        <div class="columns is-mobile is-multiline" v-if="loaded">
            <div v-for="post in posts" class="column is-half-mobile is-one-quarter-desktop is-one-quarter-tablet">
                <post-card :post="post.post"></post-card>
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
            axios.get('/api/hot').then((res)=>{
                this.posts = res.data;
                console.log(this.posts);
                this.loaded = true;
            });
        }
    }
</script>
