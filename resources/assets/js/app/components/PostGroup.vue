<template>
    <div>
        <h3 class="pop">{{title}}</h3>
        <div class="columns is-mobile is-multiline" v-if="loaded">
            <div v-for="post in posts" :class="cardClassList">
                <post-card :post="post" :size="size"></post-card>
            </div>
        </div>
        <div v-else>
            Loading ...
        </div>
    </div>
</template>

<script>
    export default {
        props: ['title', 'size', 'apisource', 'count'],
        data(){
            return {
                posts:[],
                loaded:false
            }
        },
        computed: {
            cardClassList(){
                if (this.size == "large") {
                    return "column is-half-mobile is-one-quarter-desktop is-one-quarter-tablet"
                } else {
                    return "column is-2-desktop is-2-tablet is-6-mobile"
                }
            }
        },
        mounted() {
            axios.get(this.apisource).then((res)=>{
                this.posts = res.data;
                console.log(this.posts);
                this.loaded = true;
            });
        }
    }
</script>
