<template>
    <div>
        <h3 class="title is-4">Hot Posts</h3>
        <div class="columns" v-if="loaded">
            <div v-for="score in scores" class="column is-one-quarter">
                <post-card :post="score.score.post"></post-card>
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
                scores:[],
                loaded:false
            }
        },
        mounted() {
            axios.get('/api/hot').then((res)=>{
                this.scores = res.data;
                console.log(this.scores);
                this.loaded = true;
            });
        }
    }
</script>
